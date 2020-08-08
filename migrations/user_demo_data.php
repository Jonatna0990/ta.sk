<?php


include('../components/Db.php');
include('../models/Task.php');



function generateRandomStatus()
{
    $statuses = [ Task::$STATUS_NEW, Task::$STATUS_EDIT, Task::$STATUS_FINISHED ];
    return $statuses[rand(0, count($statuses) - 1)];
}

try {
    $table_name = 'user';

    $db = Db::getConnection(true);
    if ($db) {

        $result = $db->query("SELECT 1 FROM " . $table_name . " LIMIT 1");
        if ($result) {
            $rows = "('admin','123')";
            $a = $db->query("INSERT INTO " . $table_name . " (`login`, `password`) VALUES " . $rows);
            if ($a) {
                echo "Row added to table " . $table_name;
            }

        }


    }
} catch (PDOException $ex) {
    echo "Error " . $ex->getMessage();
}