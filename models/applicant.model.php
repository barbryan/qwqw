<?php

namespace models;

use Database;
use ErrorException;
use Exception;

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

include('./database/database.php');

class ApplicantModel extends Database
{
  private $id;
  private $fname;
  private $mname;
  private $lname;
  private $birthdate;
  private $course;
  private $school;
  private $address;
  private $resume;
  private $datemodified;
  private $con;

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
      $stmt = $this->con->prepare("SELECT * FROM person");

      if (!$stmt->execute()) {
        throw new ErrorException("Login failed");
      }

      $_DATA = [];

      if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch()) {
          $_DATA[] = $row;
        }
      }

      return $_DATA;
    } catch (Exception $ex) {
      throw new ErrorException($ex->getMessage());
    }
  }

  public function create(
    $fname,
    $mname,
    $lname,
    $birthdate,
    $course,
    $school,
    $address,
    $resume,
    $datemodified
  ) {
    try {
      $stmt = $this->con->prepare("INSERT INTO person(fname, mname, lname, birthdate, course, school, address, resume) VALUES (:fname, :mname, :lname, :birthdate, :course, :school, :address, :resume)");

      $stmt->bindParam(':fname', $fname);
      $stmt->bindParam(':mname', $mname);
      $stmt->bindParam(':lname', $lname);
      $stmt->bindParam(':birthdate', $birthdate);
      $stmt->bindParam(':course', $course);
      $stmt->bindParam(':school', $school);
      $stmt->bindParam(':address', $address);
      $stmt->bindParam(':resume', $resume);
      $stmt->bindParam(':datemodified', $datemodified);

      if (!$stmt->execute()) {
        throw new ErrorException("Login failed");
      }

      return "Success";

      // $this->id = $row['id'];
      // $this->fname = $row['fname'];
      // $this->mname = $row['mname'];
      // $this->lname = $row['lname'];
      // $this->birthdate = $row['birthdate'];   
      // $this->course = $row['course'];
      // $this->school = $row['school'];
      // $this->address = $row['address']; 
      // $this->resume = $row['resume'];
      // $this->datemodified = $row['datemodified'];

    } catch (Exception $ex) {
      throw new ErrorException($ex->getMessage());
    }
  }
}
