<?php

/**
 * Главный контроллер сайта
 */
class SiteController extends BaseController
{
    public const ITEMS_ON_PAGE = 3;

    /**
     * Главная страница
     * @param int $page номер страницы
     * @return bool
     */
    public function actionIndex($page = 0)
    {
        $sort_type = 0;
        if(isset($_POST['sort']))
            $sort_type = intval($_POST['sort']);


        $sort = self::getSortParams($sort_type);
        $taskList = [];
        $taskList = Task::getTaskList($page, self::ITEMS_ON_PAGE, $sort['order_column'], $sort['order_by']);
        $taskTotal = Task::getTotalTaskList();
        $pagination = new Pagination($taskTotal, $page, self::ITEMS_ON_PAGE,'page-');
        require_once (ROOT.'/views/task/site/index.php');
        return true;
    }


    /**
     * Проверяет тип сортироки
     * @param int $type вил сортировки
     * @return array массив параметров для сортировки
     */
    private function getSortParams($type = 0)
    {

        switch ($type)
        {
            case 1: {
                $order_by = Task::SORT_ASC;
                $order_column = Task::SORT_BY_NAME;
            } break;
            case 2: {
                $order_by = Task::SORT_DESC;
                $order_column = Task::SORT_BY_NAME;
            } break;
            case 3: {
                $order_by = Task::SORT_ASC;
                $order_column = Task::SORT_BY_EMAIL;
            } break;
            case 4: {
                $order_by = Task::SORT_DESC;
                $order_column = Task::SORT_BY_EMAIL;
            } break;
            case 5: {
                $order_by = Task::SORT_ASC;
                $order_column = Task::SORT_BY_STATUS;
            } break;
            case 6: {
                $order_by = Task::SORT_DESC;
                $order_column = Task::SORT_BY_STATUS;
            } break;
            default : {
                $order_by = Task::SORT_ASC;
                $order_column = Task::SORT_BY_ID;
            } break;
        }
        return ['order_by'=>$order_by, 'order_column'=>$order_column];
    }


    /**
     * Добавление задачи
     * @return bool
     */
    public function actionAdd()
    {
            $task = self::getTaskFromSubmit();
            if($task){
                $checkAdd = Task::addTask($task);
                if($checkAdd){
                    Flash::setFlash("Задача успешно добавлена", "success", true);
                }
            }
        require_once (ROOT.'/views/task/site/add.php');
        return true;
    }

    /**
     * Просмотр задачи
     * @param int $id Идентефикатор задачи
     * @return bool
     */
    public function actionView($id = 0)
    {
        if($id){
            $taskItem = Task::getTaskById($id);
            require_once (ROOT.'/views/task/site/detail.php');
        }
        return true;
    }
}