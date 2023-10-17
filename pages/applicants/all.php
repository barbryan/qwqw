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
          <th style="width: 2rem;">#</th>
          <th>Last Name</th>
          <th>First Name</th>
          <th>Middle Name</th>
          <th>Date of Birth</th>
          <th>Course</th>
          <th>School</th>
          <th>Address</th>
          <th>Last Update</th>
          <th style="width: 100px;">Action</th>
        </thead>
        <tbody class="overflowy">

          <?php

          //print_r($model->getAll());

          $count = 1;
          foreach ($model->getAll() as $applicant) {

            $date = date("M-d-Y", strtotime($applicant['birthdate']));
            $mod = date("M-d-Y h:i:s", strtotime($applicant['datemodified']));

            echo '<tr>';
            echo '  <td style="width: 2rem;">' . $count++ . '</td>';
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
            echo '  <td style="width: 100px;">';
            echo '    <div class="btn-group">';
            echo '      <button type="button" rid="' . $applicant["id"] . '" class="view btn btn-sm btn-primary"><i class="fas fa-regular fa-eye"></i></button>';
            echo '      <a href="/applicants/update/' . $applicant["id"] . '" class="btn btn-sm btn-secondary"><i class="fas fa-regular fa-pen-to-square"></i></a>';
            echo '      <button type="button" rid="' . $applicant["id"] . '" class="delete btn btn-sm btn-danger"><i class="fas fa-regular fa-trash"></i></button>';
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
<div class="modal modal-lg fade" id="resumeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="resumeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="resumeModalLabel">Resume</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <div id="fileContainer">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

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
  const view = document.querySelectorAll('.view')
  const deleteRecord = document.querySelectorAll('.delete')

  view.forEach(btn => {
    btn.addEventListener('click', function(e) {
      e.preventDefault()
      var id = this.getAttribute("rid")
      fetch(`/applicants/view/${id}`)
        .then(data => data.json())
        .then(data => loadData(data))
        .catch(err => console.error(err))

      function loadData(data) {

        document.getElementById('fileContainer').innerHTML = ""


        var resume = data.resume
        resume = resume.split('.')
        var fileElem = "";
        if (resume[1] == 'pdf') {
          fileElem = document.createElement('object');
          fileElem.data = `/uploads/${resume.join(".")}`;
          fileElem.type = 'application/pdf';
        } else if (resume[1] == 'png' || resume[1] == 'jpeg' || resume[1] == 'jpg') {
          fileElem = document.createElement('img');
          fileElem.src = `/uploads/${resume.join(".")}`;
        } else if (resume[1] == 'doc' || resume[1] == 'docx') {
          fileElem = document.createElement('iframe');
          fileElem.setAttribute('src', `/uploads/${resume.join(".")}`);
          fileElem.style.display = 'none';
          spanElem = document.createElement('span');
          spanElem.textContent = "The resume will be downloaded";
          document.getElementById('fileContainer').appendChild(spanElem);
        }
        fileElem.style.width = '100%';
        fileElem.style.minHeight = '500px';
        document.getElementById('fileContainer').appendChild(fileElem);
        $('#resumeModal').modal('show');
      }
    })
  })

  deleteRecord.forEach(btn => {
    btn.addEventListener('click', function(e) {
      e.preventDefault()
      var id = this.getAttribute("rid")
      document.getElementById('delete').setAttribute('href', `/applicants/delete/${id}`)
      $('#notifModal').modal('show')
    })
  })
</script>