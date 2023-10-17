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
    $resume
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

      if (!$stmt->execute()) {
        throw new ErrorException("Failed");
      }

      throw new ErrorException("Success");
      // return "Success";

    } catch (Exception $ex) {
      throw new ErrorException($ex->getMessage());
    }
  }

  public function getById($id)
  {
    try {

      $stmt = $this->con->prepare("SELECT * FROM person WHERE id=:id");
      $stmt->bindParam(':id', $id);
      if (!$stmt->execute()) {
        throw new ErrorException("Login failed");
      }

      if (!$stmt->rowCount() > 0) {
        header('location: /error');
        exit();
      }

      $row = $stmt->fetch();
      

      $this->setId($row['id']);
      $this->setFname($row['fname']);
      $this->setMname($row['mname']);
      $this->setLname($row['lname']);
      $this->setBirthdate($row['birthdate']);
      $this->setCourse($row['course']);
      $this->setSchool($row['school']);
      $this->setAddress($row['address']);
      $this->setResume($row['resume']);

    } catch (Exception $ex) {
      throw new ErrorException($ex->getMessage());
    }
  }

  public function update(
    $fname,
    $mname,
    $lname,
    $birthdate,
    $course,
    $school,
    $address,
    $resume = ""
  ) {
    try {

      if (!empty($resume)) {
        $stmt = $this->con->prepare("UPDATE person SET fname=:fname, mname=:mname, lname=:lname, birthdate=:birthdate, course=:course, school=:school, address=:address, resume=:resume WHERE id=:id");

        $stmt->bindParam(':resume', $resume);
      } else {
        $stmt = $this->con->prepare("UPDATE person SET fname=:fname, mname=:mname, lname=:lname, birthdate=:birthdate, course=:course, school=:school, address=:address WHERE id=:id");
      }

      $id = $this->getId();

      $stmt->bindParam(':fname', $fname);
      $stmt->bindParam(':mname', $mname);
      $stmt->bindParam(':lname', $lname);
      $stmt->bindParam(':birthdate', $birthdate);
      $stmt->bindParam(':course', $course);
      $stmt->bindParam(':school', $school);
      $stmt->bindParam(':address', $address);
      $stmt->bindParam(':id', $id);
      
      if (!$stmt->execute()) {
        throw new ErrorException("Update failed");
      }

      self::setId($id);

      if (!empty($resume)) {
        if (file_exists("./uploads/".self::getResume())) {
          unlink("./uploads/".self::getResume());
        }
      }
      
      $this->setFname($fname);
      $this->setMname($mname);
      $this->setLname($lname);
      $this->setBirthdate($birthdate);
      $this->setCourse($course);
      $this->setSchool($school);
      $this->setAddress($address);
      $this->setResume( empty($resume) ? $this->getResume() : $resume );

      throw new ErrorException("Success");
      // return "Success";

    } catch (Exception $ex) {
      throw new ErrorException($ex->getMessage());
    }
  }

  public function delete($id)
  {
    try {

      self::getById($id);

      $stmt = $this->con->prepare("DELETE FROM person WHERE id=:id");
      $stmt->bindParam(':id', $id);

      if (!$stmt->execute()) {
        throw new ErrorException("Login failed");
      }

      if (file_exists("./uploads/".self::getResume())) {
        unlink("./uploads/".self::getResume());
      }
      
      header('location: /applicants');
      exit();

    } catch (Exception $ex) {
      throw new ErrorException($ex->getMessage());
    }
  }

  public function resume($id)
  {
    try {

      self::getById($id);

      if (file_exists("./uploads/".self::getResume())) {
        
        // return basename("./uploads/".self::getResume());

        return ["resume" => basename("./uploads/".self::getResume()), "id" => self::getId() ];
      }

      header('location: /error');
        exit();

    } catch (Exception $ex) {
      throw new ErrorException($ex->getMessage());
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
   * @return mixed
   */
  public function getFname()
  {
    return $this->fname;
  }

  /**
   * @return mixed
   */
  public function getMname()
  {
    return $this->mname;
  }

  /**
   * @return mixed
   */
  public function getLname()
  {
    return $this->lname;
  }

  /**
   * @return mixed
   */
  public function getBirthdate()
  {
    return $this->birthdate;
  }

  /**
   * @return mixed
   */
  public function getCourse()
  {
    return $this->course;
  }

  /**
   * @return mixed
   */
  public function getSchool()
  {
    return $this->school;
  }

  /**
   * @return mixed
   */
  public function getAddress()
  {
    return $this->address;
  }

  /**
   * @return mixed
   */
  public function getResume()
  {
    return $this->resume;
  }

	/**
	 * @param mixed $fname 
	 * @return self
	 */
	public function setFname($fname): self {
		$this->fname = $fname;
		return $this;
	}
	
	/**
	 * @param mixed $mname 
	 * @return self
	 */
	public function setMname($mname): self {
		$this->mname = $mname;
		return $this;
	}
	
	/**
	 * @param mixed $lname 
	 * @return self
	 */
	public function setLname($lname): self {
		$this->lname = $lname;
		return $this;
	}
	
	/**
	 * @param mixed $birthdate 
	 * @return self
	 */
	public function setBirthdate($birthdate): self {
		$this->birthdate = $birthdate;
		return $this;
	}
	
	/**
	 * @param mixed $course 
	 * @return self
	 */
	public function setCourse($course): self {
		$this->course = $course;
		return $this;
	}
	
	/**
	 * @param mixed $school 
	 * @return self
	 */
	public function setSchool($school): self {
		$this->school = $school;
		return $this;
	}
	
	/**
	 * @param mixed $address 
	 * @return self
	 */
	public function setAddress($address): self {
		$this->address = $address;
		return $this;
	}
	
	/**
	 * @param mixed $resume 
	 * @return self
	 */
	public function setResume($resume): self {
		$this->resume = $resume;
		return $this;
	}

	/**
	 * @param mixed $id 
	 * @return self
	 */
	public function setId($id): self {
		$this->id = $id;
		return $this;
	}
}