<?php
use models\AccountModel;

// namespace Controllers;

class Account
{

  public static function index()
  {
    include('./models/account.model.php');
    $model = new AccountModel();
    $type = ($_SESSION['type'] == 'ADMIN') ? include('./pages/nav.php') : "";
    $usertype = (empty($type)) ? ' |  <a class="nav-link" href="/logout"><i class="fas fa-regular fa-right-from-bracket me-2"></i>Logout</a>' : "";
    $content = include('./pages/accounts/all.php');
    include('./pages/accounts/_layout.php');
  }

  public static function create()
  {
    include('./models/account.model.php');
    $model = new AccountModel();
    $content = include('./pages/accounts/create.php');
    include('./pages/accounts/_layout.php');
  }

  public static function update($id)
  {
    include('./models/account.model.php');
    $model = new AccountModel();
    $model->getById($id);
    $content = include('./pages/accounts/update.php');
    include('./pages/accounts/_layout.php');
  }

  public static function delete($id)
  {
    include('./models/account.model.php');
    $model = new AccountModel();
    $model->delete($id);
    header('location: /accounts');
    exit();
  }
}