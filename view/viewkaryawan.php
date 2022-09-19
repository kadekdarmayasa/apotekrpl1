<?php
session_start();
if (!isset($_SESSION['userinfo']['username'])) {
  header('Location: ../login.php');
  exit;
} else {
  if ($_SESSION['userinfo']['leveluser'] != 'user_admin') {
    echo "
      <script>
        alert('Anda adalah karyawan');
        location.href = '../index.php';
      </script>
    ";
  }
}

include "../app/koneksi.php";
include '../app/functions.php';

if (isset($_POST['submit-button'])) {
  $username = htmlspecialchars($_POST['username']);
  $password =  htmlspecialchars($_POST['password']);
  $namakaryawan = htmlspecialchars($_POST['namakaryawan']);
  $levelUser = htmlspecialchars($_POST['leveluser']);
  $telp = htmlspecialchars($_POST['telp']);
  $alamat = htmlspecialchars($_POST['alamat']);

  if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_login WHERE username = '$username'")) > 0) {
    $isExist = true;
  } else {
    // Insert ke dalam tabel karyawan
    $queryKaryawan = insert("INSERT INTO tb_karyawan(idkaryawan, namakaryawan, alamat, telp) VALUES (null, '$namakaryawan', '$alamat', $telp)");

    // Jika karyawan berhasil ditambahkan 
    if ($queryKaryawan > 0) {
      // Ambil idkaryawan dari data terakhir 
      $idkaryawan = mysqli_fetch_assoc(mysqli_query($conn, "SELECT idkaryawan FROM tb_karyawan WHERE namakaryawan = '$namakaryawan'"))['idkaryawan'];

      // Insert ke dalam tabel login dengan idkaryawan diatas
      $queryToLogin = insert("INSERT INTO tb_login(username, password, leveluser, idkaryawan) VALUES ('$username', '$password', '$levelUser', $idkaryawan)");

      if ($queryToLogin) {
        $successfullyAdded = true;
      }
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
          <label for="leveluser">Level User</label>
          <select name="leveluser" id="leveluser">
            <option value="user_admin">admin</option>
            <option value="user_karyawan">karyawan</option>
          </select>
        </div>
        <div class="input-item">
          <label for="namakaryawan">Nama Karyawan</label>
          <input type="text" name="namakaryawan" id="namakaryawan" required>
        </div>
        <div class="input-item">
          <label for="username">Username</label>
          <input type="text" name="username" id="username" required>
        </div>
        <div class="input-item">
          <label for="password">Password</label>
          <input type="password" name="password" id="password" required>
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

<?php if (isset($isExist)) : ?>
  <?php if ($isExist) : ?>
    <script>
      Swal.fire({
        icon: 'error',
        title: 'Mohon maaf username sudah terdaftar',
        position: 'center',
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
  <?php endif; ?>
<?php endif; ?>

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
  <?php endif ?>
<?php endif; ?>
<?php include '../template/footer.php' ?>