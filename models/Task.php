<?php

/**
 * Класс для работы с задачами
 */
class Task
{
    public $id;
    public $user_name;
    public $email;
    public $description;
    public $status;

    public static $STATUS_FINISHED = 'finished';
    public static $STATUS_EDIT = 'edit';
    public static $STATUS_NEW = 'new';

    const SORT_BY_ID = 'id';
    const SORT_BY_NAME = 'user_name';
    const SORT_BY_EMAIL = 'email';
    const SORT_BY_STATUS = 'status';

    const SORT_ASC = 'ASC';
    const SORT_DESC = 'DESC';


    const SHOW_BY_DEFAULT = 3;


    /**
     * Возращает общее количество задач
     */
    public static function getTotalTaskList()
    {
        $db = Db::getConnection();
        $result = $db->query('SELECT COUNT(id) as count from task');
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();
        return $row['count'];

    }

    /**
     * Возвращает список задач
     * @param int $page Номер страницы
     * @param int $limit Количество элементов на странице
     * @param string $sort_column Колонка для сортировки
     * @param string $sort_by Направление сортировки
     * @return array Возвращает массив задач
     */
    public static function getTaskList($page = 1, $limit = self::SHOW_BY_DEFAULT, $sort_column = self::SORT_BY_EMAIL, $sort_by = self::SORT_ASC)
    {
        if($page <= 0) $page = 1;
        $offset = ($page - 1) * $limit;

        $db = Db::getConnection();
        $sql = 'SELECT * from task ORDER BY  '.$sort_column.' '.$sort_by.' LIMIT :limit OFFSET :offset';
        $result = $db->prepare($sql);
        $result->bindParam(':limit',$limit,PDO::PARAM_INT);
        $result->bindParam(':offset',$offset,PDO::PARAM_INT);
        $result->execute();

        $taskList = array();
        $i = 0;
        while ($row = $result->fetch())
        {
            $task = new Task();
            $task->id = $row['id'];
            $task->user_name = $row['user_name'];
            $task->email = $row['email'];
            $task->description = $row['description'];
            $task->status = preg_split ("/\,/",  $row['status']);


            $taskList[$i] = $task;
            $i++;
        }
        return $taskList;

    }


    /**
     * Возвращает задачу по id
     * @param integer $id
     * @return mixed Задача
     */
    public static function getTaskById($id)
    {
        $id = intval($id);
        if($id)
        {
            $db = Db::getConnection();
            $sql = 'SELECT * from task where id= :id';

            $result = $db->prepare($sql);
            $result->bindParam(':id',$id,PDO::PARAM_INT);
            $result->execute();
            $row = $result->fetch();
            if($row)
            {
                $task = new Task();
                $task->id = $row['id'];
                $task->user_name = $row['user_name'];
                $task->email = $row['email'];
                $task->description = $row['description'];
                $task->status = preg_split ("/\,/",  $row['status']);
                return $task;
            }
            return false;



        }

    }


    /**
     * Добавляет задачу в БД
     * @param Task $task Задача
     * @return bool Успешно ли выполнена операция
     */
    public static function addTask(Task $task)
    {
        $db = Db::getConnection();
        $sql = 'INSERT INTO task (`user_name`, `email`,`description`, `status`) VALUES (:user_name, :email, :description, :status)';

        $result = $db->prepare($sql);
        $result->bindParam(':user_name',$task->user_name,PDO::PARAM_STR);
        $result->bindParam(':email',$task->email,PDO::PARAM_STR);
        $result->bindParam(':description',$task->description,PDO::PARAM_STR);
        $result->bindParam(':status',Task::$STATUS_NEW,PDO::PARAM_STR);
        return $result->execute();
    }



    /**
     * Обновляет задачу в БД
     * @param Task $task Задача
     * @return bool Успешно ли выполнена операция
     */
    public static function updateTask(Task $task)
    {
        $db = Db::getConnection();
        $sql = 'UPDATE task SET user_name=:user_name, email=:email, description=:description, status=:status WHERE id=:id';
        $status = implode (",", $task->status);
        $result = $db->prepare($sql);
        $result->bindParam(':user_name',$task->user_name,PDO::PARAM_STR);
        $result->bindParam(':email',$task->email,PDO::PARAM_STR);
        $result->bindParam(':description',$task->description,PDO::PARAM_STR);
        $result->bindParam(':status',$status,PDO::PARAM_STR);
        $result->bindParam(':id',$task->id,PDO::PARAM_STR);
        return $result->execute();
    }


    /**
     * Проверяет описание задачи(не может быть меньше 5 символов)
     * @param $description описание
     * @return bool Валидное ли описание
     */
    public static function checkDescription($description)
    {
        if(strlen($description) >= 5){
            return true;
        }
        return false;
    }

    /**
     * Сравнивает две задачи
     * @param Task $one Задача 1
     * @param Task $two Задача 2
     * @return bool Являются ли задачи одинковыми
     */
    public static function compareTasks(Task $one, Task $two)
    {
        if($one->id == $two->id && $one->description == $two->description
            /*$one->user_name == $two->user_name &&
            $one->email == $two->email &&
            $one->status == $two->status*/) return true;

        return false;

    }



}