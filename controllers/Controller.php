<?php

class Controller
{
    protected $model;

    protected $controller;

    protected $action;

    protected $view;

    protected $modelBaseName;

    /**
     * Controller constructor.
     *
     * @param $model
     * @param $action
     */
    public function __construct($model, $action)
    {
        session_start();
        $this->controller = ucwords(__CLASS__);
        $this->action = $action;
        $this->modelBaseName = $model;

        $this->view = new View(HOME.DS.'views'.DS.$action.'.php');
    }

    /**
     * @param $modelName
     */
    protected function _setModel($modelName)
    {
        $modelName .= 'Model';
        $this->model = new $modelName();
    }

    /**
     * @param $viewName
     */
    protected function _setView($viewName)
    {
        $this->view = new View(HOME.DS.'views'.DS.strtolower($this->modelBaseName).DS.$viewName.'.php');
    }
}
