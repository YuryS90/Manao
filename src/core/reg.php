<?php

use Model\XMLTableCipher;

$db = new XMLTableCipher();

// Проверяем правильно ли был введен пароль 2 раза
if ($_POST['confirm_password'] === $_POST['password']) {

// читаем базу данных и и добавляем нового пользователя в массив
    $db
        ->readFile("bd.xml")
        ->addData(
            $_POST['login'],
            $_POST['password'],
            $_POST['email'],
            $_POST['name']
        );
     // Получаем массив ошибок    
    $error = $db->getErrors();

    // если массив с ошибками пуст, то сохраняем нового пользователя в базу
    if (empty($error)) {
        $db->saveFile("bd.xml");

    // Иначе выводим эти ошибки    
    } else {
        echo "<div class='errors'>$error[0]</div>";
    }

  // Если пароли не совпадают, то выводим ошибку  
} else{
    echo "<div class='errors'>Пароли не совпадают!</div>";
}
