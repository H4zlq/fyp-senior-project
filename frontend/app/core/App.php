<?php

class App
{
  protected $controller = CONTROLLER;
  protected $admin_controller = ADMIN_CONTROLLER;
  protected $method = METHOD;
  protected $admin_method = ADMIN_METHOD;
  protected $params = [];
  protected $url;

  public function __construct()
  {
    $this->url = $this->parseUrl();

    if (empty($this->url)) {
      $this->url = [$this->controller];
    }

    switch ($this->url[0]) {
      case 'admin':
        $this->admin($this->url);
        break;
      default:
        $this->controller($this->url);
        break;
    }
  }

  public function controller($url = [])
  {
    if (file_exists('../app/controllers/' . $url[0] . 'Controller.php')) {
      $this->controller = ucfirst($url[0]) . 'Controller';
      unset($url[0]);
    }

    require_once '../app/controllers/' . $this->controller . '.php';

    $this->controller = new $this->controller;

    if (isset($url[1])) {
      if (method_exists($this->controller, $url[1])) {
        $this->method = $url[1];
        unset($url[1]);
      }
    }

    if (!empty($url)) {
      if (count($url) > 1) {
        $this->params = [$url];
      } else {
        $this->params = array_values($url);
      }
    }

    call_user_func_array([$this->controller, $this->method], $this->params);
  }

  public function admin($url = [])
  {
    if (file_exists('../app/controllers/admin/' . $url[1] . 'Controller.php')) {
      $this->admin_controller = ucfirst($url[1]) . 'Controller';

      if (isset($url[2])) {
        $this->admin_method = $url[2];
        unset($url[2]);
      }

      unset($url[1]);
    }

    require_once '../app/controllers/admin/' . $this->admin_controller . '.php';

    $this->admin_controller = new $this->admin_controller;

    if (isset($url[1])) {
      if (method_exists($this->admin_controller, $url[1])) {
        $this->admin_method = $url[1];
        unset($url[1]);
      }
    }


    if (!empty($url)) {
      if (count($url) > 1) {
        $this->params = [$url];
      } else {
        $this->params = array_values($url);
      }
    }

    call_user_func_array([$this->admin_controller, $this->admin_method], $this->params);
  }

  public function parseUrl()
  {
    if (isset($_GET['url'])) {
      $url = rtrim($_GET['url'], '/');
      $url = filter_var($url, FILTER_SANITIZE_URL);
      $url = explode('/', $url);

      return $url;
    }
  }
}
