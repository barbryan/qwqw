<?php

class Database
{
  private $HOST = "localhost";
  private $USER = "root";
  private $PASS = "";
  private $DB = "resume";

  protected function connect()
  {
    try {
      $dsn = 'mysql:host=' . $this->HOST . ';dbname=' . $this->DB;
      $con = new PDO($dsn, $this->USER, $this->PASS);
      $con->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
      return $con;
    } catch (Exception $ex) {
      throw new ErrorException("Error connecting to database");
    }
  }
}
