<?php

use models\LoginModel;

// namespace Controllers;

class Login
{

  public static function index()
  {
    include('./models/login.model.php');
    $model = new LoginModel();
    
    include('./pages/auth/_layout.php');
  }

}
