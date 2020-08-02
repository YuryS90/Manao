<?php

namespace Model;

use Model\XMLTable;
use Config\Config;

class XMLTableCipher extends XMLTable
{
    /**
     * Шифруем пароль при добавлении в БД
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
     * Шифруем введенный пароль и сверяем его с паролем из БД
     */
    public function checkUser($login, $password)
    {
        return parent::checkUser(
            $login,
            md5($password . Config::SALT)
        );
    }
}