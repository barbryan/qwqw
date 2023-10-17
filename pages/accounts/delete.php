<main style="
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 1rem;
  justify-content: center;">

    <span class="bg-danger bg-opacity-25 p-2"><?=$model->getError();?></span>

    <a href="/accounts" type="buttom" class="btn btn-primary" style="width: 100px;">Back</a>

</main>