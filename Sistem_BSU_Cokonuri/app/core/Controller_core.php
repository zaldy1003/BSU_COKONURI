<?php

class Controller_core
{
    // public $data = [];
    // public function __construct()
    // {
    //     // echo 'ini merupakan controller core';
    // }
    public function loadView($view, $data = [])
    {
        require_once '../app/views/' . $view . '.php';
    }

    public function loadModel($model)
    {
        require_once '../app/models/' . $model . '.php';
        return new $model;
    }
}
