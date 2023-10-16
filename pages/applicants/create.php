<?php

if (isset($_POST['CREATE_APPLICANTS'])) {
  try {

    // $fname = toHtmlSpecailChars($_POST['fname']);
    // $mname = toHtmlSpecailChars($_POST['mname']);
    // $lname = toHtmlSpecailChars($_POST['lname']);
    // $address = toHtmlSpecailChars($_POST['address']);
    // $school = toHtmlSpecailChars($_POST['school']);
    // $Course = toHtmlSpecailChars($_POST['Course']);
    // $dob = toHtmlSpecailChars($_POST['dob']);
    $resume = fileInputs($_FILES['resume']);
    echo '<object data="./uploads/652ceccd5534e.pdf" type="" width="100" height="100"></object>';
    print_r($resume);

  } catch (Exception $ex) {
    echo '<span class="bg-danger bg-opacity-25 p-2">' . $ex->getMessage() . '</span>';
  }
}

?>

<main>
  <section>
    <div class="container-fluid" style="width: 800px;">
      <h2>Add Applicant</h2>
      <form action="/applicants/create" enctype="multipart/form-data" method="post">
        <div class="row">
          <div class="col">
            <label for="fname" class="form-label">First Name</label>
            <input  type="text" id="fname" name="fname" class="form-control border-black" />
          </div>
          <div class="col">
            <label for="mname" class="form-label">Middle Name</label>
            <input  type="text" id="mname" name="mname" class="form-control border-black" />
          </div>
          <div class="col">
            <label for="lname" class="form-label">Last Name</label>
            <input  type="text" id="lname" name="lname" class="form-control border-black" />
          </div>
        </div>
        <div class="row">
          <div class="col">
            <label for="address" class="form-label">Address</label>
            <input  type="text" id="address" name="address" class="form-control border-black" />
          </div>
        </div>
        <div class="row">
          <div class="col">
            <label for="school" class="form-label">School</label>
            <input  type="text" id="school" name="school" class="form-control border-black" />
          </div>
        </div>
        <div class="row">
          <div class="col">
            <label for="Course" class="form-label">Course</label>
            <input  type="text" id="Course" name="Course" class="form-control border-black" />
          </div>
          <div class="col">
            <label for="dob" class="form-label">Date of Birth</label>
            <input  type="date" id="dob" name="dob" class="form-control border-black" />
          </div>
        </div>
        <div class="row">
          <div class="col">
            <label for="resume" class="form-label">Resume</label>
            <input  type="file" id="resume" name="resume" class="form-control border-black" />
          </div>
        </div>

        <div class="row mt-3">
          <div class="col">
            <a href="/applicants" class="btn btn-danger w-100">Cancel</a>
          </div>
          <div class="col">
            <input type="submit" name="CREATE_APPLICANTS" value="Submit" class="btn btn-success w-100" />
          </div>
        </div>

      </form>
    </div>
  </section>
</main>