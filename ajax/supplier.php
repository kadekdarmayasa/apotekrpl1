  <?php
  include '../app/koneksi.php';
  include '../app/functions.php';

  if (isset($_GET['key'])) {
    $keyword = $_GET['key'];
    $querySupplier = search('tb_supplier', 'perusahaan', $keyword);
    if (mysqli_num_rows($querySupplier) == 0) $isEmptyResult = true;
  } else {
    $querySupplier = mysqli_query($conn, "SELECT * FROM tb_supplier");
  }
  ?>

  <?php if (@$isEmptyResult) : ?>
    <p>Tidak terdapat supplier dengan nama perusaahaan <b><?= $keyword; ?></b></p>
  <?php else : ?>
    <?php while ($row = mysqli_fetch_assoc($querySupplier)) : ?>
      <div class="card">
        <!-- Card Header -->
        <div class="card-header">
          <h2 class="company-name"><?= $row['perusahaan'] ?></h2>
          <div class="button-menu">
            <i class="fa-solid fa-ellipsis-vertical"></i>
          </div>
          <div class="actions">
            <a data-name='idsupplier' data-idsupplier='<?= $row['idsupplier'] ?>' id='delete-btn'>
              <i class="fa-solid fa-trash-can"></i>
              Delete
            </a>
            <a href="../update/updatesupplier.php?idsupplier=<?= $row['idsupplier'] ?>" class="update">
              <i class=" fa-solid fa-pen-to-square"></i>
              Update
            </a>
          </div>
        </div>
        <!-- Akhir Card Header -->

        <hr>

        <!-- Card Body -->
        <p class="description"><?= $row['keterangan'] ?></p>
        <!-- Akhir Card Body -->
      </div>
    <?php endwhile; ?>
  <?php endif; ?>