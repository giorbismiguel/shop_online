<?php

class Controller
{
    protected $_model;

    protected $_controller;

    protected $_action;

    protected $_view;

    protected $_modelBaseName;

    /**
     * Controller constructor.
     *
     * @param $model
     * @param $action
     */
    public function __construct($model, $action)
    {
        $this->_controller = ucwords(__CLASS__);
        $this->_action = $action;
        $this->_modelBaseName = $model;

        $this->_view = new View(HOME.DS.'views'.DS.$action.'.php');
    }

    /**
     * @param $modelName
     */
    protected function _setModel($modelName)
    {
        $modelName .= 'Model';
        $this->_model = new $modelName();
    }

    /**
     * @param $viewName
     */
    protected function _setView($viewName)
    {
        $this->_view = new View(HOME.DS.'views'.DS.strtolower($this->_modelBaseName).DS.$viewName.'.php');
    }
}
