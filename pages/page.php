<?php

include('./includes/autoload.php');


class Page
{

  private $page;

  public function __construct($url)
  {

    switch ($url[1]) {

      case "applicants":
        if (empty($_SESSION['user'])) {
          header("location: /login");
          exit();
        }
        $this->page = new Applicant();
        break;

      case "accounts":
        if (empty($_SESSION['user'])) {
          header("location: /login");
          exit();
        }
        if ($_SESSION['type'] == "USER") {
          header("location: /error");
          exit();
        }
        $this->page = new Account();
        break;

      case "login":
        if (!empty($_SESSION['user'])) {
          header("location: /applicants");
          exit();
        }
        $this->page = new Login();
        break;

      default:
        header("location: /error");
        exit();
    }

    if (empty($url[2])) {
      $this->page::index();
      exit();
    }

    if (method_exists($this->page, $url[2])) {

      switch ($url[2]) {

        case "create":
          $this->page::create();
          break;

        case "update":
          if (empty($url[3])) {
            //$this->page::index();
            header("location: /error");
            exit();
          }
          $this->page::update($url[3]);
          break;

        case "delete":
          if (empty($url[3])) {
            //$this->page::index();
            header("location: /error");
            exit();
          }
          $this->page::delete($url[3]);
          break;

        case "view":
          if (empty($url[3])) {
            //$this->page::index();
            header("location: /error");
            exit();
          }
          $this->page::view($url[3]);
          break;

        default:
          $this->page::index();
          break;
      }
      exit();
    }

    //$this->page::index();
    header("location: /error");
    exit();
  }

}
