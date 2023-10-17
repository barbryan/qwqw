<?php
use models\ApplicantModel;

// namespace Controllers;

class Applicant
{

  public static function index()
  {
    include('./models/applicant.model.php');
    $model = new ApplicantModel();
    $type = ($_SESSION['type'] == 'ADMIN') ? include('./pages/nav.php') : "";
    $usertype = (empty($type)) ? ' |  <a class="nav-link" href="/logout"><i class="fas fa-regular fa-right-from-bracket me-2"></i>Logout</a>' : "";
    $content = include('./pages/applicants/all.php');
    include('./pages/applicants/_layout.php');
  }

  public static function create()
  {
    include('./models/applicant.model.php');
    $model = new ApplicantModel();
    $content = include('./pages/applicants/create.php');
    include('./pages/applicants/_layout.php');
  }
  public static function update($id)
  {
    include('./models/applicant.model.php');
    $model = new ApplicantModel();
    $model->getById($id);
    $content = include('./pages/applicants/update.php');
    include('./pages/applicants/_layout.php');
  }
  public static function delete($id)
  {
    include('./models/applicant.model.php');
    $model = new ApplicantModel();
    $model->delete($id);
    $content = include('./pages/applicants/delete.php');
    include('./pages/applicants/_layout.php');
  }

  public static function view($id)
  {
    include('./models/applicant.model.php');
    $model = new ApplicantModel();
    $file = $model->resume($id);

    echo json_encode($model->resume($id));
    exit();
    // $type = ($_SESSION['type'] == 'ADMIN') ? include('./pages/nav.php') : "";
    // $usertype = (empty($type)) ? ' |  <a class="nav-link" href="/logout"><i class="fas fa-regular fa-right-from-bracket me-2"></i>Logout</a>' : "";
    // $content = include('./pages/applicants/view.php');
    // include('./pages/applicants/_layout.php');
  }
}