<?php

class HomeController extends Controller
{
  public function index()
  {
    $data = [
      'title' => 'Home | My Website',
    ];

    $this->view('templates/header', $data);
    $this->view('home/index');
    $this->view('templates/footer');
  }
}
