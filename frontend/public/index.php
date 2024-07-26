<?php

require_once '../app/init.php';

if (!Session::regenerate()) {
  Session::init();
}

$app = new App;
