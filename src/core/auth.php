<?php

use Model\XMLTableCipher;

$db = new XMLTableCipher();

// Проверяем нажата ли кнопка отправить
if (isset($_POST['auth'])) {

    // Проверяем пустые ли поля логин и пароль
    if (!empty($_POST['login']) && !empty($_POST['password'])) {
        
        //Проверяем есть ли такой пользователь в базе
        $db->readFile("bd.xml")->checkUser($_POST['login'], $_POST['password']);

        //Если пользователя нет в базе, то выводим ошибку
        $errors = $db->getErrors();
        if (!empty($errors)) {
            echo "<div class='errors'>$errors[0]</div>";
        }
    }
    
    //Если поля пустые, то выводим ошибку
    else {
        echo "<div class='errors'>Введите логин и пароль!</div>";
    }
} 
