<?php

class User
{
    public $id;
    public $login;
    public $password;

    /**
     * Проверяет логин(не может быть меньше 2 символов)
     * @param $login Логин
     * @return bool Валидный ли логин
     */
    public static function checkLogin($login)
    {
        if(strlen($login) >= 2){
            return true;
        }
        return false;
    }
    /**
     * Проверяет пароль(не может быть меньше 3 символов)
     * @param $password Пароль
     * @return bool Валидный ли пароль
     */
    public static function checkPassword($password)
    {
        if(strlen($password) >= 3){
            return true;
        }
        return false;
    }

    /**
     * Проверяет email на валидность
     * @param $email Email
     * @return bool Валидный ли email
     */
    public static function checkEmail($email)
    {
        if(filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            return true;
        }
        return false;
    }



    /**
     * Проверка пользователя на логин и пароль
     * @param $login Логин пользователя
     * @param $password Пароль пользователя
     * @return bool Возвращает пользователя, если он найден или false в противном случае
     */
    public static function checkUser($login, $password)
    {
        $db = Db::getConnection();
        $sql = 'SELECT * from user where login= :login AND password= :password';

        $result = $db->prepare($sql);
        $result->bindParam(':login',$login,PDO::PARAM_STR);
        $result->bindParam(':password',$password,PDO::PARAM_STR);
        $result->execute();
        $row = $result->fetch();
        if($row)
        {
            $user['id'] = $row['id'];
            $user['login'] = $row['login'];
            $user['password'] = $row['password'];
            return $user;
        }
        return false;
    }
    /**
     * Возвращает задачу по id
     * @param integer $id
     * @return mixed Задача
     */
    public static function getUserById($id)
    {
        $id = intval($id);
        if($id)
        {
            $db = Db::getConnection();
            $sql = 'SELECT * from user where id= :id';

            $result = $db->prepare($sql);
            $result->bindParam(':id',$id,PDO::PARAM_INT);
            $result->execute();
            $row = $result->fetch();
            if($row)
            {
                $user['id'] = $row['id'];
                $user['login'] = $row['login'];
                $user['password'] = $row['password'];
                return $user;
            }
            return false;

        }
    }

    /**
     * Вход пользователя
     * @param $id
     */
    public static function userLogin($id)
    {
        $_SESSION['user'] = $id;
        header('Location: /admin');
    }

    /**
     * Выход пользователя
     */
    public static function userLogout()
    {
        unset($_SESSION['user']);
        header('Location: /');

    }

    /**
     * Пользователь уже залогинен
     * @return mixed Возвращает идентефикатор пользователя в случае усеха и показывает страницу входа в противном случае
     */
    public static function checkLogged()
    {
        if(isset($_SESSION['user']))
        {
            return $_SESSION['user'];
        }
        header('Location: /login');
    }

    /**
     * Является ли пользователь гостем
     */
    public static function isGuest()
    {

        return !isset($_SESSION['user']);
    }



}