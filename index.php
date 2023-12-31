<?php

use Dompdf\Dompdf;
use PhpOffice\PhpWord\IOFactory;

require_once(__DIR__ . '/vendor/autoload.php');

// use \Dompdf\Dompdf;

session_start();

include('./pages/page.php');
//include('./includes/autoload.php');

$url = explode("/", (string) $_SERVER['REQUEST_URI']);


$pathmain = $_SERVER['HTTP_HOST'] . "/" . $url[1];


// $base = "/applicants";

// print_r($url);

if (empty($url[1])) {
  header('location: /applicants');
  exit();
}
if ($url[1] == "error") {
  include('./error.php');
  exit();
}
if ($url[1] == "logout") {
  include('./logout.php');
  exit();
}
if ($url[1] == "test") {
  include('./test.php');
  exit();
}

new Page($url);

function toHtmlSpecailChars($input)
{
  if (empty($input)) {
    throw new ErrorException("Invalid inputs");
  }
  return trim(htmlspecialchars($input, ENT_QUOTES, "UTF-8"));
}

function fileInputs($file)
{

  if (empty($file)) {
    throw new ErrorException("Invalid inputs");
  }

  // Require the vendor/autoload.php file
  require __DIR__ . '/vendor/autoload.php';

  // Create a new instance of PhpOffice\PhpWord
  $phpWord = new \PhpOffice\PhpWord\PhpWord();

  // Create a new instance of Dompdf
  $dompdf = new Dompdf();

  // Define the upload directory and allowed file types
  $upload_dir = __DIR__ . "/uploads/";
  $allowed_types = array("pdf", "doc", "docx", "png", "jpeg", "jpg");

  // Get the file name, size, and type
  $file_name = $file["name"];
  $file_size = $file["size"];
  $file_type = $file["type"];

  // Get the file extension
  $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

  // Check if the file type and size are allowed
  if (in_array($file_ext, $allowed_types) && $file_size < 5000000) {

    // Generate a unique name for the file
    $new_name = uniqid() . "." . $file_ext;

    // Move the file to the upload directory
    $upload_path = $upload_dir . $new_name;
    if (move_uploaded_file($file["tmp_name"], $upload_path)) {

      // Check if the file is a PDF or not
      if ($file_ext == "pdf") {
        // No need to convert, just echo a success message
        // echo "The file " . $file_name . " was uploaded and saved as " . $new_name;
        return basename($upload_path);
      } else if ($file_ext == "png" || $file_ext == "jpg" || $file_ext == "jpeg") {
        return basename($upload_path);
      } else if ($file_ext == "doc" || $file_ext == "docx") {
        return basename($upload_path);
      }
    } else {

      // Echo an error message
      // echo "An error occurred while moving the file to the upload directory";
      throw new ErrorException("An error occurred while moving the file to the upload directory");
    }
  } else {

    // Echo an error message
    // echo "The file type or size is not allowed";
    throw new ErrorException("The file type or size is not allowed");
  }


  // return basename($upload_path);
}


function fileli()
{
  require('fpdf.php');

  // Path to the image file
  $imagePath = 'path/to/image.jpg';

  // Path to the output PDF file
  $pdfPath = 'path/to/output.pdf';

  // Create a new FPDF object
  //$pdf = new FPDF();

  // Add a new page to the PDF document
  $pdf->AddPage();

  // Load the image into memory
  $image = @imagecreatefromjpeg($imagePath);

  // Get the width and height of the image
  $width = imagesx($image);
  $height = imagesy($image);

  // Insert the image into the PDF document
  $pdf->Image($imagePath, 0, 0, $width, $height);

  // Output the PDF document to a file
  $pdf->Output('F', $pdfPath);
}
