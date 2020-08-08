<?php

/**
 * Класс для работы с уведомлениями
 * Class Flash
 */
class Flash
{
    /**
     * Установливает уведомление
     * @param $message Сообщение
     * @param string $type Тип уведомления
     * @param bool $with_refresh Обновлять страницу
     * @param string $location Страница
     */
    public static function setFlash($message, $type = 'danger', $with_refresh = false, $location = '/add')
    {
        $_SESSION['flash'] = array(
            'message' => $message,
            'type'    => $type
        );
        if($with_refresh)
        {
            header("Location: ".$location);
            exit();
        }
    }

    /**
     * Получает уведомление
     * @return mixed Возвращает значение уведомления по ключу
     */
    public static function getFlash()
    {
        if(isset($_SESSION['flash']))
        {
            $value = array(
                'message' => $_SESSION['flash']['message'],
                'type'    => $_SESSION['flash']['type' ]
            );
            unset($_SESSION['flash']);
            return $value;
        }
        return null;

    }


}