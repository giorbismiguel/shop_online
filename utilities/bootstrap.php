<?php

$controller = 'Index';
$action = 'index';
$query = null;

if (isset($_GET['load'])) {
    $params = array();
    $params = explode('/', $_GET['load']);

    $controller = ucwords($params[0]);

    if (isset($params[1]) && !empty($params[1])) {
        $action = $params[1];
    }

    if (isset($params[2]) && !empty($params[2])) {
        $query = $params[2];
    }
}

$modelName = $controller;
$controller .= 'Controller';

if (class_exists($controller)) {
    $load = new $controller($modelName, $action);

    if (method_exists($load, $action)) {
        $load->$action($query);

        return;
    }

    die('The URL is incorrect, please change and try again.');
}

die('The URL is incorrect, please change and try again.');
