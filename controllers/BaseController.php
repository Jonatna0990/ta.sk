<?php

class BaseController
{
    /**
     * Выход из учетной записи
     */
    public function actionLogout()
    {
        User::userLogout();
    }

    /**
     * Возвращает задачу из формы
     * @return null|Task
     */
    protected function getTaskFromSubmit()
    {
        $user_name = '';
        $email = '';
        $description = '';

        if(isset($_POST['submit'])){
            $user_name = $_POST['user_name'];
            $email = $_POST['email'];
            $description = $_POST['description'];
            $status = [];
            $status[] = Task::$STATUS_NEW;
            if(isset($_POST['status']))  {
                if($_POST['status'] == 'on')
                    $status[] = Task::$STATUS_FINISHED;
                else if (($key = array_search($status, Task::$STATUS_FINISHED)) !== false) {
                    unset($status[$key]);
                }

            }

            $errors = false;

            if(!User::checkLogin($user_name))
                Flash::setFlash("Имя пользователя не должно быть короче 2-х символов","danger", true);

            if(!User::checkEmail($email))
                Flash::setFlash( "Невалидный email адрес","danger", true);

            if(!Task::checkDescription($description))
                Flash::setFlash("Описание не должно быть короче 5-х символов", "danger", true);

            $task = new Task();
            $task->user_name = $user_name;
            $task->email = $email;
            $task->description = $description;
            $task->status = $status;


            return $task;
        }

        return false;

    }

    /**
     * Вход в админ панель
     * @return bool
     */
    public function actionLogin()
    {
        $login = '';
        $password = '';
        if(isset($_POST['submit']))
        {
            $login = $_POST['login'];
            $password = $_POST['password'];
            $errors = false;

            if(!User::checkLogin($login))
                Flash::setFlash("Логин не должен быть короче 2-х символов", "danger", true);

            if(!User::checkPassword($password))
                Flash::setFlash("Пароль не должен быть короче 2-х символов", "danger", true);

            if($errors == false){
                $checkUser = User::checkUser($login, $password);
                if($checkUser)
                {
                    User::userLogin($checkUser['id']);
                }
                else
                {
                    $password = '';
                    Flash::setFlash("Неверный логин или пароль", "danger", true);
                }

            }
        }
        require_once (ROOT.'/views/task/site/login.php');
        return true;
    }

}