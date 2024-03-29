<?php
session_start();
include '../app/koneksi.php';
include '../app/functions.php';
$_SESSION['view'] = 'supplier';

if (!isset($_SESSION['userinfo']['username'])) {
  header('Location: ../login.php');
  exit;
} else {
  if ($_SESSION['userinfo']['leveluser'] != 'admin') {
    echo "
      <script>
        alert('Anda adalah karyawan');
        location.href = '../index.php';
      </script>
    ";
  }
}

// Insert Statement 
if (isset($_POST['submit-button'])) {
  $perusahaan = $_POST['perusahaan'];
  $keterangan = $_POST['keterangan'];

  $affectedRow = insert("INSERT INTO tb_supplier VALUES (null, '$perusahaan', '$keterangan')");

  $successfullyAdded = $affectedRow > 0 ? true : false;
}

// Delete Statement 
if (isset($_GET['idsupplier'])) {
  $queryDelete = mysqli_query($conn, "SELECT * FROM tb_supplier INNER JOIN tb_obat USING (idsupplier) WHERE tb_supplier.idsupplier=" . $_GET['idsupplier']);

  if (mysqli_num_rows($queryDelete) > 0) {
    $canDeleted = false;
  } else {
    mysqli_query($conn, "DELETE FROM tb_supplier WHERE idsupplier=" . $_GET['idsupplier']);
    $canDeleted = true;
  }
}

// Search Statement
if (isset($_POST['search-keyword'])) {
  $keyword = $_POST['search-keyword'];
  $querySupplier = search('tb_supplier', 'perusahaan', $keyword);
  if (mysqli_num_rows($querySupplier) == 0) $isEmptyResult = true;
} else {
  $querySupplier = mysqli_query($conn, "SELECT * FROM tb_supplier");
}

?>

<?php include '../template/header.php'; ?>

<div class="container">
  <?php include '../template/sidebar.php'; ?>

  <div class="content">
    <?php include '../template/navbar.php' ?>

    <div class="sidebar-content">
      <h2>Daftar Supplier</h2>

      <div class="search-container">
        <!-- Awal Search Bar -->
        <form method="post" action="viewsupplier.php" class="search-bar">
          <i class="fa-solid fa-magnifying-glass"></i>
          <?php if (@$_POST['search-keyword']) : ?>
            <input type="text" name="search-keyword" value="<?= $keyword ?>" placeholder="Cari nama perusahaan..." id="keyword">
          <?php else : ?>
            <input type="text" name="search-keyword" placeholder="Cari nama perusahaan..." id="keyword">
          <?php endif; ?>
        </form>
        <!-- Akhir Search Bar -->

        <!-- Print Button -->
        <div class="print">
          <a href="print-data-supplier.php">Print Data</a>
        </div>
        <!-- Print Button -->
      </div>

      <!-- Awal Cards -->
      <div class="cards">
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
      </div>
      <!-- Akhir Cards -->

      <!-- Awal Add button -->
      <button id="add-button">
        <i class="fa-solid fa-plus"></i>
      </button>
      <!-- Akhir Add Button -->

    </div>
  </div>
</div>

<!-- Sweealert Template Tambah obat -->
<template id="tambah-data-supplier">
  <swal-param name="showConfirmButton" value="false" />
  <swal-html>
    <form action="viewsupplier.php" method="post">
      <div class="item-input-container">
        <h2 class="title">Tambahkan Data Supplier</h2>
        <div class="input-item">
          <label for="perusahaan">Nama Perusahaan</label>
          <input type="text" name="perusahaan" id="perusahaan" required>
        </div>
        <div class="input-item">
          <label for="keterangan">Deskripsi Singkat Perusahaan</label>
          <textarea name="keterangan" id="keterangan" required></textarea>
        </div>
        <button type="submit" name="submit-button" class="submit-button">Tambahkan</button>
      </div>
    </form>
  </swal-html>
</template>

<?php if (isset($canDeleted)) : ?>
  <?php if (!$canDeleted) : ?>
    <script>
      Swal.fire({
        icon: 'error',
        title: 'Data supplier tidak dapat dihapus',
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
      }).then(() => {
        location.href = 'viewsupplier.php';
      });
    </script>
  <?php else : ?>
    <script>
      Swal.fire({
        icon: 'success',
        title: 'Data supplier berhasil dihapus',
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
      }).then(() => {
        location.href = 'viewsupplier.php';
      });
    </script>
  <?php endif; ?>

<?php endif; ?>

<?php if (isset($successfullyAdded)) : ?>
  <?php if ($successfullyAdded) : ?>
    <script>
      Swal.fire({
        icon: 'success',
        title: 'Data supplier berhasil ditambahkan',
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
      }).then(() => {
        location.href = 'viewsupplier.php';
      });
    </script>
  <?php else : ?>
    <script>
      Swal.fire({
        icon: 'error',
        title: 'Data supplier gagal ditambahkan',
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
      }).then(() => {
        location.href = 'viewsupplier.php';
      });
    </script>
  <?php endif ?>
<?php endif; ?>

<?php include '../template/footer.php' ?>