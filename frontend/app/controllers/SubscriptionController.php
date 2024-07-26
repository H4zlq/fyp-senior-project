<?php

class SubscriptionController extends Controller
{
  public function index()
  {
    $this->view('templates/header');
    $this->view('subscription/index');
    $this->view('templates/footer');
  }
}
