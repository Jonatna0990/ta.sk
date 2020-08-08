<?php

/**
 * Контроллер панели администрирования
 * Class AdminController
 */
class AdminController extends BaseController
{


    public const ITEMS_ON_PAGE = 20;

    /**
     * Главная страница админ панели
     * @param int $page номер страницы
     * @return bool
     */
    public function actionIndex($page = 0)
    {
        $userId = User::checkLogged();
        $user = User::getUserById($userId);
        $taskTotal = Task::getTotalTaskList();
        $taskList = Task::getTaskList($page,self::ITEMS_ON_PAGE);
        $pagination = new Pagination($taskTotal, $page, self::ITEMS_ON_PAGE,'page-');
        require_once(ROOT . '/views/task/admin/index.php');
        return true;
    }


    /**
     * Редактирование задачи
     * @param int $id
     * @return bool
     */
    public function actionEdit($id = 0)
    {
        $userId = User::checkLogged();
        if($id) {
            $task = self::getTaskFromSubmit();
            if($task){
                $task->id = $id;
                $old_task = Task::getTaskById($id);
                $equal_task = Task::compareTasks($old_task,$task);
                if(!$equal_task) $task->status[] = Task::$STATUS_EDIT;

                $checkAdd = Task::updateTask($task);
                if($checkAdd){
                    Flash::setFlash("Задача успешно обновлена", "success", true, '/');
                }
            }
            $taskItem = Task::getTaskById($id);
        }
        require_once (ROOT.'/views/task/site/add.php');

        return true;
    }
}