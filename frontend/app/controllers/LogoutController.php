<?php

class LogoutController extends Controller
{
  public function index()
  {
    Session::destroy();
    header('Location: ' . BASE_URL . '/login');
    exit;
  }
}
