<?php

/**
 * Класс для работы с БД
 */
class Db
{


    /**
     * Подключение к БД
     * @param bool $is_migration Необхоимо использовать миграции
     * @return null|PDO Возвращает подключение к БД
     */
    public static function getConnection($is_migration = false)
    {
        try{
            $paramsPath = $is_migration == false ? ROOT.'/config/db.php' : '../config/db.php';

            $params = include ($paramsPath);
            $dsn = "mysql:host={$params['host']};port={$params['port']};dbname={$params['dbname']}";
            $db = new PDO($dsn, $params['user'], $params['password'], array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            $db->exec('set names utf8');
            return $db;
        }
        catch(PDOException $ex){

            var_dump($ex->getMessage());
            die;
        }

    }



}