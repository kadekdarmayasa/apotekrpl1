<?php
session_start();

if (!isset($_SESSION['userinfo']['username'])) {
  header('Location: ../login.php');
  exit;
}

include "../app/koneksi.php";
include '../app/functions.php';

if (isset($_POST['submit-button'])) {
  $filename = upload();
  $namalengkap = $_POST['namalengkap'];
  $alamat = $_POST['alamat'];
  $telp = $_POST['telp'];
  $usia = $_POST['usia'];

  if ($filename) {
    $affectedRow = insert("INSERT INTO tb_pelanggan
    (idpelanggan, namalengkap, alamat, telp, usia, buktifotoresep) 
    VALUES 
    (null, '$namalengkap', '$alamat', $telp, $usia, '$filename')
  ");

    if ($affectedRow > 0) {
      $successfullyAdded = true;
    } else {
      $successfullyAdded = false;
    }
  }
}

if (isset($_POST['search-keyword'])) {
  $keyword = $_POST['search-keyword'];
  $queryPelanggan = mysqli_query($conn, "SELECT * FROM tb_pelanggan WHERE namalengkap LIKE '%$keyword%'");
  if (mysqli_num_rows($queryPelanggan) == 0) {
    $isEmptyResult = true;
  }
} else {
  $queryPelanggan = mysqli_query($conn, "SELECT * FROM tb_pelanggan");
}

if (isset($_GET['idpelanggan'])) {
  $queryDelete = mysqli_query($conn, "SELECT * FROM tb_pelanggan INNER JOIN tb_transaksi USING (idpelanggan) WHERE tb_pelanggan.idpelanggan=" . $_GET['idpelanggan']);

  if (mysqli_num_rows($queryDelete) > 0) {
    $isDeleted = false;
  } else {
    mysqli_query($conn, "DELETE FROM tb_pelanggan WHERE idpelanggan=" . $_GET['idpelanggan']);
    $isDeleted = true;
  }
}

$_SESSION['view'] = 'pelanggan';
?>
<?php include '../template/header.php' ?>
<div class="container">
  <?php
  include '../template/sidebar.php';
  ?>

  <div class="content">
    <!-- Awal Navbar -->
    <?php include '../template/navbar.php' ?>
    <!-- Akhir Navbar -->

    <div class="sidebar-content">
      <h2>Daftar Pelanggan</h2>

      <!-- Awal Search Bar -->
      <form method="post" action="viewpelanggan.php" class="search-bar">
        <i class="fa-solid fa-magnifying-glass"></i>
        <input type="text" name="search-keyword" placeholder="Cari pelanggan berdasarkan nama..." id="search">
      </form>
      <!-- Akhir Search Bar -->

      <!-- Awal Cards -->
      <div class="cards">
        <?php if (@$isEmptyResult) : ?>
          <p>Pelanggan yang anda cari tidak ada.</p>
        <?php else : ?>
          <?php while ($row = mysqli_fetch_assoc($queryPelanggan)) : ?>
            <div class="card">
              <div class="card-header">
                <div class="title">
                  <h3 class="nama"><?= $row['namalengkap']; ?></h3>
                </div>
                <div class="button-menu">
                  <i class="fa-solid fa-ellipsis-vertical"></i>
                </div>
                <div class="actions">
                  <a onclick='confirmation(<?= $row["idpelanggan"] ?>)'>
                    <i class=" fa-solid fa-trash-can"></i>
                    Delete
                  </a>
                  <a href="../update/updatepelanggan.php?idpelanggan=<?= $row['idpelanggan']  ?>" class="update">
                    <i class=" fa-solid fa-pen-to-square"></i>
                    Update
                  </a>
                  <a class="foto-resep" data-fotoresep="<?= $row['buktifotoresep'] ?>">
                    <i class="fa-solid fa-image"></i>
                    Foto Resep
                  </a>
                </div>
              </div>
              <hr>
              <div class="card-body">
                <div class="first-item">
                  <div class="phone">
                    <p>No Telephone</p>
                    <h4><?= $row['telp']; ?></h4>
                  </div>
                  <div class="age">
                    <p>Usia</p>
                    <h4><?= $row['usia']; ?></h4>
                  </div>
                  <div class="id-user">
                    <p>Id</p>
                    <h4><?= $row['idpelanggan']; ?></h4>
                  </div>
                </div>
                <div class="address">
                  <h4>Alamat</h4>
                  <p><?= $row['alamat']; ?></p>
                </div>
              </div>
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

<template id="tambah-data-pelanggan">
  <swal-param name="showConfirmButton" value="false" />
  <swal-html>
    <form action="viewpelanggan.php" method="post" enctype="multipart/form-data">
      <div class="item-input-container">
        <h2 class="title">Tambah Pelanggan</h2>
        <div class="input-item">
          <label for="namalengkap">Nama Lengkap</label>
          <input type="text" name="namalengkap" id="namalengkap" required>
        </div>
        <div class="input-item">
          <label for="telp">No Telephone</label>
          <input type="number" name="telp" id="telp" required>
        </div>
        <div class="input-item">
          <label for="usia">Usia</label>
          <input type="number" name="usia" id="usia" required>
        </div>
        <div class="input-item">
          <label for="alamat">Alamat</label>
          <textarea name="alamat" id="alamat" required></textarea>
        </div>
        <div class="input-item">
          <label for="fotoresep">Bukti Foto Resep</label>
          <input type="file" name="fotoresep" id="fotoresep" required>
        </div>
        <button type="submit" name="submit-button" class="submit-button">Tambahkan</button>
      </div>
    </form>
  </swal-html>
</template>
<?php if (isset($isDeleted)) : ?>
  <?php if (!$isDeleted) : ?>
    <script>
      Swal.fire({
        icon: 'error',
        title: 'Data pelanggan tidak dapat dihapus',
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
        location.href = 'viewpelanggan.php';
      });
    </script>
  <?php else : ?>
    <script>
      Swal.fire({
        icon: 'success',
        title: 'Data pelanggan berhasil dihapus',
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
        location.href = 'viewpelanggan.php';
      });
    </script>
  <?php endif; ?>

<?php endif; ?>

<?php if (isset($successfullyAdded)) : ?>
  <?php if ($successfullyAdded) : ?>
    <script>
      Swal.fire({
        icon: 'success',
        title: 'Data pelanggan berhasil ditambahkan',
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
        location.href = 'viewpelanggan.php';
      });
    </script>
  <?php else : ?>
    <script>
      Swal.fire({
        icon: 'error',
        title: 'Data pelanggan gagal ditambahkan',
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
        location.href = 'viewpelanggan.php';
      });
    </script>
  <?php endif ?>
<?php endif; ?>
<?php include '../template/footer.php' ?>