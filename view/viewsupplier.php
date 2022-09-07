<?php
session_start();
if (!isset($_SESSION['userinfo']['username'])) {
  header('Location: ../login.php');
  exit;
}

include '../app/koneksi.php';
include '../app/functions.php';
$_SESSION['view'] = 'supplier';

if (isset($_POST['submit-button'])) {
  $perusahaan = $_POST['perusahaan'];
  $keterangan = $_POST['keterangan'];

  $affectedRow = insert("INSERT INTO tb_supplier VALUES (null, '$perusahaan', '$keterangan')");
  if ($affectedRow > 0) {
    $successfullyAdded = true;
  } else {
    $successfullyAdded = false;
  }
}

if (isset($_GET['idsupplier'])) {
  $queryDelete = mysqli_query($conn, "SELECT * FROM tb_supplier INNER JOIN tb_obat USING (idsupplier) WHERE tb_supplier.idsupplier=" . $_GET['idsupplier']);

  if (mysqli_num_rows($queryDelete) > 0) {
    $canDeleted = false;
  } else {
    mysqli_query($conn, "DELETE FROM tb_supplier WHERE idsupplier=" . $_GET['idsupplier']);
    $canDeleted = true;
  }
}

if (isset($_POST['search-keyword'])) {
  $keyword = $_POST['search-keyword'];
  $querySupplier = mysqli_query($conn, "SELECT * FROM tb_supplier WHERE perusahaan LIKE '%$keyword%'");
  if (mysqli_num_rows($querySupplier) == 0) {
    $isEmptyResult = true;
  }
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

      <!-- Awal Search Bar -->
      <form method="post" action="viewsupplier.php" class="search-bar">
        <i class="fa-solid fa-magnifying-glass"></i>
        <input type="text" name="search-keyword" placeholder="Cari supplier berdasarkan nama perusahaan..." id="keyword">
      </form>
      <!-- Akhir Search Bar -->

      <!-- Awal Cards -->
      <div class="cards">
        <?php if (@$isEmptyResult) : ?>
          <p>Supplier yang anda cari tidak ada.</p>
        <?php else : ?>
          <?php while ($row = mysqli_fetch_assoc($querySupplier)) : ?>
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