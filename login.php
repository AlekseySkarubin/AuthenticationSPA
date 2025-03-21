<?php
session_start();
require 'users.php';
require 'functions.php';

if (getCurrentUser()) {
    header('Location: index.html');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'];
    $password = $_POST['password'];

    if (checkPassword($login, $password)) {
        $_SESSION['user'] = $login;
        $_SESSION['login_time'] = time();
        $_SESSION['birthday'] = getUserBirthday($login); // Сохраняем дату рождения в сессии
        header('Location: index.html');
        exit;
    } else {
        $error = 'Неверный логин или пароль';
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Вход</title>
</head>
<body>
    <h1>Вход</h1>
    <form method="POST">
        <input type="text" name="login" placeholder="Логин" required>
        <input type="password" name="password" placeholder="Пароль" required>
        <button type="submit">Войти</button>
    </form>
    <?php if ($error): ?>
        <p style="color: red;"><?= $error ?></p>
    <?php endif; ?>
</body>
</html>