<?php
require 'users.php';
require 'functions.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'];
    $password = $_POST['password'];
    $birthday = $_POST['birthday'];

    if (existsUser($login)) {
        $error = 'Пользователь с таким логином уже существует.';
    } else {
        $hashedPassword = hashPassword($password);
        $userData = $login . ':' . $hashedPassword . ':' . $birthday . PHP_EOL;
        file_put_contents('users.txt', $userData, FILE_APPEND);
        $success = 'Регистрация прошла успешно! Теперь вы можете <a href="login.php">войти</a>.';
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
</head>
<body>
    <h1>Регистрация</h1>
    <form method="POST">
        <input type="text" name="login" placeholder="Логин" required>
        <input type="password" name="password" placeholder="Пароль" required>
        <input type="date" name="birthday" placeholder="Дата рождения" required>
        <button type="submit">Зарегистрироваться</button>
    </form>
    <?php if ($error): ?>
        <p style="color: red;"><?= $error ?></p>
    <?php elseif ($success): ?>
        <p style="color: green;"><?= $success ?></p>
    <?php endif; ?>
</body>
</html>