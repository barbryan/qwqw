<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Applicant</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

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
      <form action="/accounts/login" method="post">
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
        <div class="row mt-3">
          <div class="col">
            <input type="submit" name="LOGIN" value="Login" class="btn btn-success w-100" />
          </div>
        </div>
      </form>
    </div>
  </section>

</body>

</html>