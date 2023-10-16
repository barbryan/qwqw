<main>
  <section style="background-color: #e3f2fd;">
    <div class="container-fluid">
      <div class="d-flex justify-content-between align-items-center py-2">
        <h4 class="m-0">Accounts</h4>
        <a href="/accounts/create" style="font-size: 25px;"><i class="fas fa-regular fa-user-plus"></i></a>
      </div>
    </div>
  </section>
  <section class="my-2">
    <div class="container-fluid">
      <table id="myTable" class="table table-striped">
        <thead>
          <th>#</th>
          <th>Name</th>
          <th>Username</th>
          <th>Type</th>
          <th style="width: 100px;">Action</th>
        </thead>
        <tbody>

          <?php

          try {

            $count = 1;

            foreach ($model->getAll() as $account) {

              $name = $account['fname']." ".$account['mname']." ".$account['lname'];

              echo '<tr>';
              echo '  <td>'.$count++.'</td>';
              echo '  <td>'.$name.'</td>';
              echo '  <td>'.$account['username'].'</td>';
              echo '  <td>'.$account['type'].'</td>';
              echo '  <td>';
              echo '    <div class="btn-group">';
              //echo '      <a href="/accounts/view/'.$account['id'].'" class="btn btn-sm btn-primary"><i class="fas fa-regular fa-eye"></i></a>';
              echo '      <a href="/accounts/update/'.$account['id'].'" class="btn btn-sm btn-secondary"><i class="fas fa-regular fa-pen-to-square"></i></a>';
              echo '      <a href="/accounts/delete/'.$account['id'].'" class="btn btn-sm btn-danger"><i class="fas fa-regular fa-trash"></i></a>';
              echo '    </div>';
              echo '  </td>';
              echo '</tr>';
            }

          } catch (Exception $ex) {

          }

          ?>

        </tbody>
      </table>
    </div>
  </section>
</main>