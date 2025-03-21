<?php

function hashPassword($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

function daysUntilBirthday($birthday) {
    $now = new DateTime();
    $nextBirthday = new DateTime($birthday);
    $nextBirthday->setDate($now->format("Y"), $nextBirthday->format("m"), $nextBirthday->format("d"));

    if ($nextBirthday < $now) {
        $nextBirthday->modify('+1 year');
    }

    return $now->diff($nextBirthday)->days;
}