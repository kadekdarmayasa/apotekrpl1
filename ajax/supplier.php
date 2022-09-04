  <?php
  include '../app/koneksi.php';
  if (isset($_GET['key'])) {
    $keyword = $_GET['key'];
    $queryPelanggan = mysqli_query($conn, "SELECT * FROM tb_supplier WHERE perusahaan LIKE '%$keyword%'");
    if (mysqli_num_rows($queryPelanggan) == 0) {
      $isEmptyResult = true;
    }
  } else {
    $queryPelanggan = mysqli_query($conn, "SELECT * FROM tb_supplier");
  }
  ?>

  <?php if (@$isEmptyResult) : ?>
    <p>Supplier yang anda cari tidak ada.</p>
  <?php else : ?>
    <?php while ($row = mysqli_fetch_assoc($queryPelanggan)) : ?>
      <div class="card">
        <div class="card-header">
          <h2 class="company-name"><?= $row['perusahaan'] ?></h2>
          <div class="button-menu">
            <i class="fa-solid fa-ellipsis-vertical"></i>
          </div>
          <div class="actions">
            <a onclick="confirmation(<?= $row['idsupplier'] ?>)">
              <i class="fa-solid fa-trash-can"></i>
              Delete
            </a>
            <a href="../update/updatesupplier.php?idsupplier=<?= $row['idsupplier'] ?>" class="update">
              <i class=" fa-solid fa-pen-to-square"></i>
              Update
            </a>
          </div>
        </div>
        <hr>
        <p class="description"><?= $row['keterangan'] ?></p>
      </div>
    <?php endwhile; ?>
  <?php endif; ?>