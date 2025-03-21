<?php

function getUsersList() {
    $users = [];
    $lines = file('users.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        list($login, $hash, $birthday) = explode(':', trim($line));
        $users[$login] = ['hash' => $hash, 'birthday' => $birthday];
    }
    return $users;
}

function existsUser($login) {
    $users = getUsersList();
    return isset($users[$login]);
}

function checkPassword($login, $password) {
    $users = getUsersList();
    return isset($users[$login]) && password_verify($password, $users[$login]['hash']);
}

function getCurrentUser() {
    return $_SESSION['user'] ?? null;
}

function getUserBirthday($login) {
    $users = getUsersList();
    return $users[$login]['birthday'] ?? null;
}
?>