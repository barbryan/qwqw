<main style="
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;">

  <?php

  if (isset($_POST['CREATE_ACCOUNT'])) {
    try {
      $fname = toHtmlSpecailChars($_POST['fname']);
      $mname = toHtmlSpecailChars($_POST['mname']);
      $lname = toHtmlSpecailChars($_POST['lname']);
      $username = toHtmlSpecailChars($_POST['user']);
      $password = toHtmlSpecailChars($_POST['pass']);
      $type = toHtmlSpecailChars($_POST['type']);

      $model->createUser($fname, $mname, $lname, $username, $password, $type);


    } catch (Exception $ex) {
      echo '<span class="bg-danger bg-opacity-25 p-2">' . $ex->getMessage() . '</span>';
    }
  }

  ?>

  <section>
    <div class="container-fluid" style="width: 500px;">

      <h2>Create Account</h2>
      <form action="/accounts/create" method="post">
        <div class="row">
          <div class="col">
            <label for="fname" class="form-label">First Name</label>
            <input required type="text" id="fname" name="fname" class="form-control border-black" />
          </div>
          <div class="col">
            <label for="mname" class="form-label">Middle Name</label>
            <input required type="text" id="mname" name="mname" class="form-control border-black" />
          </div>
          <div class="col">
            <label for="lname" class="form-label">Last Name</label>
            <input required type="text" id="lname" name="lname" class="form-control border-black" />
          </div>
        </div>
        <div class="row">
          <div class="col">
            <label for="user" class="form-label">Username</label>
            <input required type="text" id="user" name="user" class="form-control border-black" />
          </div>
        </div>
        <div class="row">
          <div class="col">
            <label for="pass" class="form-label">Password</label>
            <input required type="password" id="pass" name="pass" class="form-control border-black" />
          </div>
        </div>
        <div class="row">
          <div class="col">
            <label for="type" class="form-label">Type</label>
            <select required name="type" id="type" class="form-control border-black">
              <option value="ADMIN">Admin</option>
              <option value="USER">User</option>
            </select>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col">
            <a href="/accounts" class="btn btn-danger w-100">Cancel</a>
          </div>
          <div class="col">
            <input type="submit" name="CREATE_ACCOUNT" value="Submit" class="btn btn-success w-100" />
          </div>
        </div>
      </form>
    </div>
  </section>
</main>