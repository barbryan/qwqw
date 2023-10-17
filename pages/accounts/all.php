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
          <th style="width: 2rem;">#</th>
          <th>Name</th>
          <th>Username</th>
          <th>Type</th>
          <th style="width: 75px;">Action</th>
        </thead>
        <tbody>

          <?php

          try {

            $count = 1;

            foreach ($model->getAll() as $account) {

              $name = $account['lname'] . ", " . $account['fname'] . " " . $account['mname'];

              echo '<tr>';
              echo '  <td style="width: 2rem;">' . $count++ . '</td>';
              echo '  <td>' . $name . '</td>';
              echo '  <td>' . $account['username'] . '</td>';
              echo '  <td>' . $account['type'] . '</td>';
              echo '  <td style="width: 75px;">';
              echo '    <div class="btn-group">';
              echo '      <a href="/accounts/update/' . $account['id'] . '" class="btn btn-sm btn-secondary"><i class="fas fa-regular fa-pen-to-square"></i></a>';
              echo '      <button type="button" rid="' . $account['id'] . '" class=" delete btn btn-sm btn-danger"><i class="fas fa-regular fa-trash"></i></a>';
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

<!-- Modal -->
<div class="modal fade" id="notifModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="notifModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="notifModalLabel">Notification</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <div id="fileContainer">
            <span>Confirm delete</span>
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <a href="" id="delete" class="btn btn-danger">Delete</a>
      </div>
    </div>
  </div>
</div>

<script>
  const deleteRecord = document.querySelectorAll('.delete')

  deleteRecord.forEach(btn => {
    btn.addEventListener('click', function(e) {
      e.preventDefault()
      var id = this.getAttribute("rid")
      document.getElementById('delete').setAttribute('href', `/accounts/delete/${id}`)
      $('#notifModal').modal('show')
    })
  })
</script>