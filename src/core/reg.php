<?php

use Model\XMLTableCipher;

$db = new XMLTableCipher();


if ($_POST['confirm_password'] === $_POST['password']) {
    $db
        ->readFile("bd.xml")
        ->addData(
            $_POST['login'],
            $_POST['password'],
            $_POST['email'],
            $_POST['name']
        );
    $error = $db->getErrors();
    if (empty($error)) {
        $db->saveFile("bd.xml");
    } else {
        echo "<div class='errors'>$error[0]</div>";
    }
} else{
    echo "<div class='errors'>Пароли не совпадают!</div>";
}
