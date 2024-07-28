<?php

class CheckoutController extends Controller
{
  public function index($params = [])
  {
    $this->model(UserModel::class);
    $service = $this->service(UserService::class);

    $user = $service->getUserById();
    $username = Session::get('username');
    $email = $user->getEmail();
    $plan = $params[1];
    $price = $params[2];

    $this->view('templates/header');
    $this->view('checkout/index', [
      'username' => $username,
      'email' => $email,
      'plan' => $plan,
      'price' => $price
    ]);
    $this->view('templates/footer');
  }
}
