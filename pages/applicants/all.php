<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<main>
  <section style="background-color: #e3f2fd;">
    <div class="container-fluid">
      <div class="d-flex justify-content-between align-items-center py-2">
        <h4 class="m-0">Applicants</h4>
        <div class="d-flex gap-3">
          <a href="/applicants/create" style="font-size: 25px;"><i class="fas fa-regular fa-user-plus"></i></a>
          <?= $usertype ?>
        </div>
      </div>
    </div>
  </section>
  <section class="my-2">
    <div class="container-fluid">
      <table id="myTable" class="table table-striped">
        <thead>
          <th>#</th>
          <th>Last Name</th>
          <th>First Name</th>
          <th>Middle Name</th>
          <th>Date of Birth</th>
          <th>Course</th>
          <th>School</th>
          <th>Address</th>
          <th>Last Update</th>
          <th>Action</th>
        </thead>
        <tbody class="overflowy">

          <?php

          //print_r($model->getAll());
          
          $count = 1;
          foreach ($model->getAll() as $applicant) {

            $date = date("M-d-Y", strtotime($applicant['birthdate']));
            $mod = date("M-d-Y h:i:s", strtotime($applicant['datemodified']));

            echo '<tr>';
            echo '  <td>' . $count++ . '</td>';
            //echo '  <td>'.$applicant['id'].'</td>';
            echo '  <td>' . $applicant['lname'] . '</td>';
            echo '  <td>' . $applicant['fname'] . '</td>';
            echo '  <td>' . $applicant['mname'] . '</td>';
            echo '  <td>' . $date . '</td>';
            echo '  <td>' . $applicant['course'] . '</td>';
            echo '  <td>' . $applicant['school'] . '</td>';
            echo '  <td>' . $applicant['address'] . '</td>';
            //echo '  <td>'.$applicant['resume'].'</td>';
            echo '  <td>' . $mod . '</td>';
            echo '  <td>';
            echo '    <div class="btn-group">';
            echo '      <button type="button" rid="' . $applicant["id"] . '" class="view btn btn-sm btn-primary"><i class="fas fa-regular fa-eye"></i></button>';
            echo '      <a href="/applicants/update/' . $applicant["id"] . '" class="btn btn-sm btn-secondary"><i class="fas fa-regular fa-pen-to-square"></i></a>';
            echo '      <a href="/applicants/delete/' . $applicant["id"] . '" class="btn btn-sm btn-danger"><i class="fas fa-regular fa-trash"></i></a>';
            echo '    </div>';
            echo '  </td>';
            echo '</tr>';
          }

          ?>

        </tbody>
      </table>
    </div>
  </section>
</main>


<!-- Modal -->
<div class="modal modal-lg fade" id="resumeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-labelledby="resumeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="resumeModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <?php

          $file = explode(".", $file);

          if ($file[1] == "pdf") {
            echo '<object data="/uploads/' . implode(".", $file) . '" type="application/pdf" style="width: 100%; min-height:500px;"></object>';
          } else if ($file[1] == "png" || $file[1] == "jpg" || $file[1] == "jpeg") {
            echo '<img src="/uploads/' . implode(".", $file) . '" alt="">';
          } else if ($file[1] == "docx" || $file[1] == "doc") {
            echo '<iframe src="/uploads/' . implode(".", $file) . '" frameborder="0" style="display: none;"></iframe>';
            echo "Resume of " . $model->getFname() . " was downloaded";
          }

          ?>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Understood</button>
      </div>
    </div>
  </div>
</div>

<script>
  const view = document.querySelectorAll('.view')
  view.forEach(btn => {
    btn.addEventListener('click', function (e) {
      e.preventDefault()
      var id = this.getAttribute("rid")
      fetch(`/applicants/view/${id}`)
        .then(data => data.json())
        .then(data => loadData(data))
        .catch(err => console.error(err))

      function loadData(data) {
        $('#resumeModal').modal('show')
        
      }
    })
  })

</script>