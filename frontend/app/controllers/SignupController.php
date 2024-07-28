<?php

class SignupController extends Controller
{
  public function index()
  {
    $this->view('templates/header');
    $this->view('signup/index');
    $this->view('templates/footer');
  }

  public function user()
  {
    $this->model(UserModel::class);
    $service = $this->service(UserService::class);
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password != $confirm_password) {
      Flasher::set('Passwords do not match.', 'danger');
      $this->redirect('/signup');
    }

    $user = $service->getUserByUsername($username);

    if ($user != null) {
      Flasher::set('Username already exists.', 'danger');
      $this->redirect('/signup');
    }

    $isSignedUp = $service->insertUser();

    if ($isSignedUp) {
      $this->redirect('/login');
    } else {
      Flasher::set('An error occurred. Please try again.', 'danger');
      $this->redirect('/signup');
    }
  }
}
