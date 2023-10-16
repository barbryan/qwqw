<?php

namespace models;

use Database;
use ErrorException;
use Exception;


if (session_status() == PHP_SESSION_NONE) {
  session_start();
}


include('./database/database.php');

class LoginModel extends Database
{

  private $con;

  public function __construct() {
    $this->con = parent::connect();
  }
  public function __destruct() {
    $this->con = null;
  }


  public function login(
    $username,
    $password
  ) {

    try {
      $stmt = $this->con->prepare("SELECT * FROM accounts WHERE username=:username");
      $stmt->bindParam(':username', $username);
      if (!$stmt->execute()) {
        throw new ErrorException("Login failed");
      }
      if ($stmt->rowCount() <= 0) {
        throw new ErrorException("User not Found");
      }

      $row = $stmt->fetch();

      if (!password_verify($password, $row['password'])) {
        throw new ErrorException("Incorrect password");
      }

      $_SESSION['user'] = $row['username'];
      $_SESSION['type'] = $row['type'];

      header('location: /applicants');
      exit();

    } catch (Exception $ex) {
      throw new ErrorException($ex->getMessage());
    }

  }


}
