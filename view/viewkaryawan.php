<?php
session_start();
if (!isset($_SESSION['username'])) {
  header('Location: ../login.php');
  exit;
}

include "../app/koneksi.php";
include '../app/functions.php';

if (isset($_POST['submit-button'])) {
  $namakaryawan = $_POST['namakaryawan'];
  $alamat = $_POST['alamat'];
  $telp = $_POST['telp'];

  if ($filename) {
    $affectedRow = insert("INSERT INTO tb_karyawan
    (idkaryawan, namakaryawan, alamat, telp) 
    VALUES 
    (null, '$namakaryawan', '$alamat', $telp)
  ");

    if ($affectedRow > 0) {
      $successfullyAdded = true;
    } else {
      $successfullyAdded = false;
    }
  }
}

$_SESSION['view'] = 'karyawan';
?>

<?php include '../template/header.php' ?>

<div class="container">
  <?php include '../template/sidebar.php' ?>

  <div class="content">
    <!-- Awal Navbar -->
    <?php include '../template/navbar.php' ?>
    <!-- Akhir Navbar -->

    <div class="sidebar-content">
      <h2>Daftar Karyawan</h2>

      <!-- Awal Search Bar -->
      <form method="post" action="viewkaryawan.php" class="search-bar">
        <i class="fa-solid fa-magnifying-glass"></i>
        <input type="text" name="search-keyword" placeholder="Cari karyawan berdasarkan nama..." id="search">
      </form>
      <!-- Akhir Search Bar -->

      <div class="cards">
        <?php $queryKaryawan = mysqli_query($conn, "SELECT * FROM tb_karyawan") ?>
        <?php while ($row = mysqli_fetch_assoc($queryKaryawan)) : ?>
          <div class="card">
            <div class="card-header">
              <div class="title">
                <h3 class="nama"><?= $row['namakaryawan']; ?></h3>
              </div>
              <div class="button-menu">
                <i class="fa-solid fa-ellipsis-vertical"></i>
              </div>
              <div class="actions">
                <a onclick='confirmation(<?= $row["idkaryawan"] ?>)'>
                  <i class=" fa-solid fa-trash-can"></i>
                  Delete
                </a>
                <a href="../update/updatekaryawan.php?idkaryawan=<?= $row['idkaryawan']  ?>" class="update">
                  <i class=" fa-solid fa-pen-to-square"></i>
                  Update
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
                <div class="id-user">
                  <p>Id</p>
                  <h4><?= $row['idkaryawan']; ?></h4>
                </div>
              </div>
              <div class="address">
                <h4>Alamat</h4>
                <p><?= $row['alamat']; ?></p>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      </div>

      <!-- Awal Add button -->
      <button id="add-button">
        <i class="fa-solid fa-plus"></i>
      </button>
      <!-- Akhir Add Button -->
    </div>
  </div>
</div>

<template id="tambah-data-karyawan">
  <swal-param name="showConfirmButton" value="false" />
  <swal-html>
    <form action="viewkaryawan.php" method="post">
      <div class="item-input-container">
        <h2 class="title">Tambah Karyawan</h2>
        <div class="input-item">
          <label for="namakaryawan">Nama Karyawan</label>
          <input type="text" name="namakaryawan" id="namakaryawan" required>
        </div>
        <div class="input-item">
          <label for="telp">No Telephone</label>
          <input type="number" name="telp" id="telp" required>
        </div>
        <div class="input-item">
          <label for="alamat">Alamat</label>
          <textarea name="alamat" id="alamat" required></textarea>
        </div>
        <button type="submit" name="submit-button" class="submit-button">Tambahkan</button>
      </div>
    </form>
  </swal-html>
</template>


<?php if (isset($successfullyAdded)) : ?>
  <?php if ($successfullyAdded) : ?>
    <script>
      Swal.fire({
        icon: 'success',
        title: 'Data karyawan berhasil ditambahkan',
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
        location.href = 'viewkaryawan.php';
      });
    </script>
  <?php else : ?>
    <script>
      Swal.fire({
        icon: 'error',
        title: 'Data karyawan gagal ditambahkan',
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
        location.href = 'viewkaryawan.php';
      });
    </script>
  <?php endif ?>
<?php endif; ?>
<?php include '../template/footer.php' ?>