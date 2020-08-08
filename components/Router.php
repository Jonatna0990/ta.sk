<?php

/**
 * Класс для работы с роутами
 */
class Router
{
    private $routes;
    public function __construct()
    {
        $routesPath = ROOT.'/config/routes.php';
        $this->routes = include($routesPath);
    }

    /**
     * возвращает метод запроса
     */
    private function getURI()
    {
        if(!empty($_SERVER['REQUEST_URI'])){
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    /***
     * запуск роутера
     */
    public function run()
    {
        $url = $this->getURI();
        foreach ($this->routes as $uriPattern => $path) {

            if(preg_match("~$uriPattern~",$url))
            {

                $internalRoute = preg_replace("~$uriPattern~", $path, $url);
                $segments = explode('/', $internalRoute);
                $controllerName = array_shift($segments).'Controller';
                $controllerName = ucfirst($controllerName);
                $actionName = 'action'.ucfirst(array_shift($segments));
                $parametrs = $segments;
                $controllerFile = ROOT.'/controllers/'.$controllerName.'.php';
                if(file_exists($controllerFile)) {
                    include_once($controllerFile);
                }
                $controllerObject = new $controllerName;
                $result =  call_user_func_array(array($controllerObject, $actionName), $parametrs);
                if($result != null ){
                    break;
                }
            }
        }

    }

}