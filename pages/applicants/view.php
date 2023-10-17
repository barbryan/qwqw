<main>
  <section style="background-color: #e3f2fd;">
    <div class="container-fluid">
      <div class="d-flex justify-content-between align-items-center py-2">
        <div class="d-flex gap-3">
          <a href="/applicants" style="font-size: 25px;"><i class="fas fa-regular fa-backward"></i></a>
          <h4 class="m-0">Applicants</h4>
        </div>
        <div class="d-flex gap-3">
          <a href="/applicants/create" style="font-size: 25px;"><i class="fas fa-regular fa-user-plus"></i></a>
          <?= $usertype ?>
        </div>
      </div>
    </div>
    </div>
  </section>
  <section class="my-2">
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
  </section>
</main>