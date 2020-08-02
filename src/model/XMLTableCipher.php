<?php

namespace Model;

use Model\XMLTable;
use Config\Config;

class XMLTableCipher extends XMLTable
{
    /**
     * Зашифровал пароль при добавлении
     */
    public function addData($login, $pass, $email, $name)
    {
        return parent::addData(
            $login,
            md5($pass . Config::SALT),
            $email,
            $name
        );
    }

    /**
     * Проверил, что такой зашифрованный пароль есть в базе
     */
    public function checkUser($login, $password)
    {
        return parent::checkUser(
            $login,
            md5($password . Config::SALT)
        );
    }
}