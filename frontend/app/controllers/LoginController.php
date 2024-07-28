<?php

class LoginController extends Controller
{
  public function index()
  {
    $data = [
      'id' => Session::get('id'),
      'username' => Session::get('username'),
      'role' => Session::get('role'),
    ];

    $this->view('templates/header');
    $this->view('login/index', $data);
    $this->view('templates/footer');
  }

  public function user($params = [])
  {
    $this->model(UserModel::class);
    $service = $this->service(UserService::class);

    $isLoggedIn = $service->loginUser();

    if ($params === 'request') {
      $this->request();
    }

    if (!$isLoggedIn) {
      $this->redirect('/login');
    }

    $this->redirect('/home');
  }

  public function request()
  {
    $this->model(UserModel::class);
    $service = $this->service(UserService::class);

    $isRequested = $service->submitRequest();

    if ($isRequested) {
      Flasher::set('Request submitted successfully.', 'success');
    } else {
      Flasher::set('An error occurred. Please try again.', 'danger');
    }

    $this->redirect('/login');
  }
}
