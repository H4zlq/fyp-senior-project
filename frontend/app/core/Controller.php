<?php

class Controller
{
  public function model($model)
  {
    require_once '../app/models/' . $model . '.php';
    return new $model;
  }

  public function view($view, $data = [])
  {
    require_once '../app/views/' . $view . '.php';
  }

  public function service($service)
  {
    require_once '../app/services/' . $service . '.php';
    return new $service;
  }

  public function helper($helper)
  {
    require_once '../app/helpers/' . $helper . '.php';
    return new $helper;
  }

  public function redirect($url)
  {
    header('Location: ' . BASE_URL . $url);
    exit;
  }
}
