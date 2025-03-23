<?php
session_start(); // Запуск сессии
require 'users.php'; // Подключаем файл с функциями работы с пользователями
require 'functions.php'; // Подключаем файл с общими функциями

$user = getCurrentUser(); // Получаем текущего пользователя

if ($user) { // Если пользователь авторизован
    $login_time = $_SESSION['login_time']; // Получаем время входа пользователя
    $time_left = 86400 - (time() - $login_time); // Рассчитываем оставшееся время до истечения скидки (24 часа)

    $birthday_message = ''; // Инициализируем переменную для сообщения о дне рождения
    $birthday_discount = ''; // Инициализируем переменную для скидки на день рождения

    if (isset($_SESSION['birthday'])) { // Если дата рождения установлена
        $days_until_birthday = daysUntilBirthday($_SESSION['birthday']); // Вычисляем количество дней до дня рождения

        if ($days_until_birthday == 0) { // Если сегодня день рождения
            $birthday_message = 'С Днем Рождения! Мы дарим вам скидку 5% на все услуги!';
            $birthday_discount = 'Скидка 5%';
        } else { // Если день рождения впереди
            $birthday_message = "До вашего дня рождения осталось $days_until_birthday дней.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>SPA-салон</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .top-bar {
            display: flex;
            justify-content: flex-end;
            padding: 10px;
            background-color: #f0f0f0;
        }
        .top-bar a {
            text-decoration: none;
            color: #000;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border-radius: 5px;
            margin-left: 10px;
        }
        .register-button {
            display: inline-block;
            text-decoration: none;
            color: #000;
            padding: 10px 20px;
            background-color: #2196F3;
            color: white;
            border-radius: 5px;
            text-align: center;
            margin-left: 10px;
        }
        .logout-link {
            position: absolute;
            left: 10px;
            top: 10px;
            color: #000;
        }
        .logo {
            display: block;
            margin: 20px auto; /* Центрируем логотип */
            max-width: 200px; /* Максимальная ширина */
            max-height: 200px; /* Максимальная высота */
        }
        .center-content {
            text-align: center;
        }
        .menu {
            list-style-type: none;
            padding: 0;
            margin: 20px auto;
            display: flex;
            justify-content: center;
        }
        .menu li {
            margin: 0 15px;
            font-size: 18px;
        }
        .spa-image {
            display: block;
            margin: 20px auto; /* Центрируем изображение */
            max-width: 50%; /* Уменьшаем до 50% от первоначального размера */
        }
    </style>
</head>
<body>
    <?php if ($user): ?>
        
        <p class="logout-link"><a href="logout.php">Выйти</a></p>
    <?php endif; ?>
    <div class="top-bar">
        
        <a href="login.php">Войти</a>
        <a href="register.php" class="register-button">Зарегистрироваться</a>
    </div>
    <div class="center-content">
        
        <img src="https://img.freepik.com/free-vector/lotus-spa-design-logo-vector_53876-43524.jpg?t=st=1742419412~exp=1742423012~hmac=75ccc3747295603736252f1b26ec50a489acc68369b2f2aac73d23f3ac2a54af&w=1380" alt="Fitness & SPA" class="logo">
        <h1>Fitness & SPA</h1>
        <h2>Программы здоровья и восстановления</h2>
        <h3>Добро пожаловать<?= $user ? ', ' . htmlspecialchars($user) : '' ?>!</h3>
        
        <p><?= $birthday_message ?></p>
    </div>

    
    <ul class="menu">
        <li>Массаж</li>
        <li>Маникюр</li>
        <li>Педикюр</li>
        <li>Фитнес программы</li>
    </ul>

    
    <h3 class="center-content">Акции:</h3>
    <p class="center-content">🔔 Скидка 20% на первое посещение!</p>
    
    <?php if ($user): ?>
        
        <p class="center-content">До истечения персональной скидки осталось: <?= gmdate("H:i:s", $time_left) ?></p>
    <?php endif; ?>

    
    <img src="https://gifs.obs.ru-moscow-1.hc.sbercloud.ru/8bd55efe99d0599f7410f412f0ce9bee113cb65472f9d2ecb0af109e7a51584f.gif" alt="Фото салона" class="spa-image">
</body>
</html>
