<?php

namespace models;

use Database;
use ErrorException;
use Exception;

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

include('./database/database.php');

class AccountModel extends Database
{

  private $id;
  private $fname;
  private $lname;
  private $mname;
  private $user;
  private $pass;
  private $type;

  private $con;

  private $error;

  public function __construct()
  {
    $this->con = parent::connect();
  }
  public function __destruct()
  {
    $this->con = null;
  }

  public function getAll()
  {

    try {
      $stmt = $this->con->prepare("SELECT * FROM accounts");
      if (!$stmt->execute()) {
        throw new ErrorException("Login failed");
      }
      $_DATA = [];
      if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch()) {
          $_DATA[] = $row;
        }
      }
      //throw new ErrorException("Login Success");

      return $_DATA;

    } catch (Exception $ex) {
      throw new ErrorException($ex->getMessage());
    }

  }

  public function getById($id)
  {

    try {
      $stmt = $this->con->prepare("SELECT * FROM accounts WHERE id=:id");
      $stmt->bindParam(':id', $id);
      if (!$stmt->execute()) {
        throw new ErrorException("User not found");
      }

      if (!$stmt->rowCount() > 0) {
        throw new ErrorException("User not found");
      }

      $row = $stmt->fetch();

      $this->setFname($row['fname']);
      $this->setLname($row['mname']);
      $this->setMname($row['lname']);
      $this->setUser($row['username']);
      $this->setPass($row['password']);
      $this->setType($row['type']);
      $this->setId($row['id']);

    } catch (Exception $ex) {
      throw new ErrorException($ex->getMessage());
    }

  }

  public function update(
    $fname,
    $mname,
    $lname,
    $username,
    $password,
    $rpassword,
    $type,
    $id
  ) {

    try {

      if ($password != $rpassword) {
        throw new ErrorException("Password does not match");
      }

      $stmt = $this->con->prepare("SELECT * FROM accounts WHERE username=:user AND id!=:id");
      $stmt->bindParam(':user', $username);
      $stmt->bindParam(':id', $id);
      if (!$stmt->execute()) {
        throw new ErrorException("Login failed");
      }
      if ($stmt->rowCount() > 0) {
        throw new ErrorException("User already exist");
      }
      
      if (!empty($password) && !$password == $this->getPass()) {
        $password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 8]);

        $stmt = $this->con->prepare("UPDATE accounts SET fname=:fname, mname=:mname, lname=:lname, username=:user, password=:pass, type=:type WHERE id=:id ");

        $stmt->bindParam(':pass', $password);

      } else {
        $stmt = $this->con->prepare("UPDATE accounts SET fname=:fname, mname=:mname, lname=:lname, username=:user, type=:type WHERE id=:id ");
      }

      $stmt->bindParam(':fname', $fname);
      $stmt->bindParam(':mname', $mname);
      $stmt->bindParam(':lname', $lname);
      $stmt->bindParam(':user', $username);
      $stmt->bindParam(':type', $type);
      $stmt->bindParam(':id', $id);

      if (!$stmt->execute()) {
        throw new ErrorException("Update failed");
      }

      header('location: /accounts');
      exit();

    } catch (Exception $ex) {
      throw new ErrorException($ex->getMessage());
    }

  }


  public function createUser(
    $fname,
    $mname,
    $lname,
    $username,
    $password,
    $rpassword,
    $type
  ) {

    try {

      if ($password != $rpassword) {
        throw new ErrorException("Password does not match");
      }

      $stmt = $this->con->prepare("SELECT * FROM accounts WHERE username=:username");
      $stmt->bindParam(':username', $username);
      if (!$stmt->execute()) {
        throw new ErrorException("Login failed");
      }
      if ($stmt->rowCount() > 0) {
        throw new ErrorException("User already exist");
      }

      $password = password_hash($password, PASSWORD_BCRYPT, ["cost" => 8]);

      $stmt = $this->con->prepare("INSERT INTO accounts(fname, mname, lname, username, password, type) VALUES (:fname, :mname, :lname, :username, :password, :type)");
      $stmt->bindParam(':fname', $fname);
      $stmt->bindParam(':mname', $mname);
      $stmt->bindParam(':lname', $lname);
      $stmt->bindParam(':username', $username);
      $stmt->bindParam(':password', $password);
      $stmt->bindParam(':type', $type);

      if (!$stmt->execute()) {
        throw new ErrorException("Login failed");
      }

      header('location: /accounts');
      exit();

    } catch (Exception $ex) {
      throw new ErrorException($ex->getMessage());
    }


    

    

  }

  public function delete($id)
  {

    try {

      self::getById($id);

      if ($_SESSION['uid'] == self::getId()) {
        throw new ErrorException("User is currently active");
      }

      $stmt = $this->con->prepare("DELETE FROM accounts WHERE id=:id");
      $stmt->bindParam(':id', $id);
      if (!$stmt->execute()) {
        throw new ErrorException("User not found");
      }

      if (!$stmt->rowCount() > 0) {
        throw new ErrorException("User not found");
      }

      return true;

    } catch (Exception $ex) {
      self::setError($ex->getMessage());
    }

  }



  /**
   * @return mixed
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * @param mixed $id 
   * @return self
   */
  public function setId($id): self
  {
    $this->id = $id;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getFname()
  {
    return $this->fname;
  }

  /**
   * @param mixed $fname 
   * @return self
   */
  public function setFname($fname): self
  {
    $this->fname = $fname;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getLname()
  {
    return $this->lname;
  }

  /**
   * @param mixed $lname 
   * @return self
   */
  public function setLname($lname): self
  {
    $this->lname = $lname;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getMname()
  {
    return $this->mname;
  }

  /**
   * @param mixed $mname 
   * @return self
   */
  public function setMname($mname): self
  {
    $this->mname = $mname;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getUser()
  {
    return $this->user;
  }

  /**
   * @param mixed $user 
   * @return self
   */
  public function setUser($user): self
  {
    $this->user = $user;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getPass()
  {
    return $this->pass;
  }

  /**
   * @param mixed $pass 
   * @return self
   */
  public function setPass($pass): self
  {
    $this->pass = $pass;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getType()
  {
    return $this->type;
  }

  /**
   * @param mixed $type 
   * @return self
   */
  public function setType($type): self
  {
    $this->type = $type;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getCon()
  {
    return $this->con;
  }

  /**
   * @param mixed $con 
   * @return self
   */
  public function setCon($con): self
  {
    $this->con = $con;
    return $this;
  }

	/**
	 * @return mixed
	 */
	public function getError() {
		return $this->error;
	}
	
	/**
	 * @param mixed $error 
	 * @return self
	 */
	public function setError($error): self {
		$this->error = $error;
		return $this;
	}
}