<?php

if (isset($_POST['LOGIN'])) {
  try {
    $user = toHtmlSpecailChars($_POST['user']);
    $pass = toHtmlSpecailChars($_POST['pass']);

    $model->login($user, $pass);
    
  } catch (Exception $ex) {
    echo '<span class="bg-danger bg-opacity-25 p-2">'.$ex->getMessage().'</span>';
  }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Applicant</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

  <style>
    body {
      height: 100vmin;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }
  </style>
</head>

<body>

  <section>
    <div class="container-fluid" style="width: 500px;">
      <h2>Login</h2>
      <form action="/login" method="post">
        <div class="row">
          <div class="col">
            <label for="user" class="form-label">Username</label>
            <input type="text" id="user" name="user" class="form-control border-black" />
          </div>
        </div>
        <div class="row">
          <div class="col">
            <label for="pass" class="form-label">Password</label>
            <input type="password" id="pass" name="pass" class="form-control border-black" />
          </div>
        </div>
        <div class="row mt-3">
          <div class="col">
            <input type="submit" name="LOGIN" value="Login" class="btn btn-success w-100" />
          </div>
        </div>
      </form>
    </div>
  </section>

  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

</body>

</html>