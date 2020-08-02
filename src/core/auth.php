<?php

use Model\XMLTableCipher;

$db = new XMLTableCipher();

if (isset($_POST['auth'])) {

    if (!empty($_POST['login']) && !empty($_POST['password'])) {
        
        $db->readFile("bd.xml")->checkUser($_POST['login'], $_POST['password']);

        //проверяем ошибки
        $errors = $db->getErrors();
        if (!empty($errors)) {
            echo "<div class='errors'>$errors[0]</div>";
        }
    }

    else {
        echo "<div class='errors'>Введите логин и пароль!</div>";
    }
} 
