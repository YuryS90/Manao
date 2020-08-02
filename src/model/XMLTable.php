<?php

namespace Model;

use Model\XML;

class XMLTable extends XML
{
    protected $errors = [];

    /**
     * Добавление нового пользователя с проверкой на ошибки.
     * Если ошибок нет, то пользователь добавлен, иначе ошибки записываются в массив ошибок
     */
    public function addData($login, $pass, $email, $name)
    {
        if (!$this->existenceValue('login', $login)) {
            if (!$this->existenceValue('email', $email)) {
                if (!empty($login)) {
                    if (!empty($pass)) {
                        if (!empty($email)) {
                            if (!empty($name)) {
                                return parent::addData($login, $pass, $email, $name); // если не дойдём до неё, то вернём false
                            } else {
                                $this->errors[] = "Поле с именем не должно быть пустым!";
                            }
                        } else {
                            $this->errors[] = "Поле с email не должно быть пустым!";
                        }
                    } else {
                        $this->errors[] = "Поле с паролем не должно быть пустым!";
                    }
                } else {
                    $this->errors[] = "Поле с логином не должно быть пустым!!";
                }
            } else {
                $this->errors[] = "Такой email существует!";
            }
        } else {
            $this->errors[] = "Такой логин существует!";
        }
        return false;
    }

    /**
     * получение массива с ошибками
     */
    public function getErrors()
    {
        $errors = $this->errors;
        $this->errors = [];
        return $errors;
    }

    /**
     * Проверяем есть ли такой пользователь в базе данных.
     * Если есть, то авторизируем и перенаправляем на hello.php
     * Если такой пользователь не найден, то записываем ошибку в массив ошибок
     */
    public function checkUser($login, $password)
    {

        foreach ($this->data as $value) {
            if ($value['login'] == $login && $value['password'] == $password) {
                $_SESSION['logged_user'] = $login;
                $_SESSION['logged_password'] = $password;
                
                header("location: hello.php");
            }
            else {
                $this->errors[] = "Неверный логин либо пароль!";
            }
        }
    }
}