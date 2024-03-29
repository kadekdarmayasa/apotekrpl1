<?php
session_start();
include "../app/koneksi.php";
include '../app/functions.php';
$_SESSION['view'] = 'karyawan';

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
  $namakaryawan = htmlspecialchars($_POST['namakaryawan']);
  $telp = htmlspecialchars($_POST['telp']);
  $alamat = htmlspecialchars($_POST['alamat']);

  $queryKaryawan = insert("INSERT INTO tb_karyawan(idkaryawan, namakaryawan, alamat, telp) VALUES (null, '$namakaryawan', '$alamat', $telp)");

  if ($queryKaryawan > 0) $successfullyAdded = true;
}

// Search Statement
if (isset($_POST['search-keyword'])) {
  $keyword = $_POST['search-keyword'];
  $queryKaryawan = search('tb_karyawan', 'namakaryawan', $keyword);
  if (mysqli_num_rows($queryKaryawan) == 0) $isEmptyResult = true;
} else {
  $queryKaryawan = mysqli_query($conn, "SELECT * FROM tb_karyawan ORDER BY idkaryawan DESC");
}

// Delete Statement
if (isset($_GET['idkaryawan'])) {
  $affectedRow = delete("DELETE FROM tb_karyawan WHERE idkaryawan=" . $_GET['idkaryawan']);
  if ($affectedRow > 0) $isDeleted = true;
}
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


      <div class="search-container">
        <!-- Awal Search Bar -->
        <form method="post" action="viewkaryawan.php" class="search-bar">
          <i class="fa-solid fa-magnifying-glass"></i>
          <?php if (@$_POST['search-keyword']) : ?>
            <input type="text" name="search-keyword" value="<?= $keyword ?>" placeholder="Cari karyawan..." id="keyword">
          <?php else :  ?>
            <input type="text" name="search-keyword" placeholder="Cari karyawan..." id="keyword">
          <?php endif; ?>
        </form>
        <!-- Akhir Search Bar -->

        <!-- Print Button -->
        <div class="print">
          <a href="print-data-karyawan.php">Print Data</a>
        </div>
        <!-- Print Button -->
      </div>

      <div class="cards">
        <?php if (@$isEmptyResult) : ?>
          <p>Tidak terdapat karyawan dengan nama <b><?= $keyword; ?></b></p>
        <?php else : ?>
          <?php while ($row = mysqli_fetch_assoc($queryKaryawan)) : ?>
            <div class="card">
              <!-- Card Header -->
              <div class="card-header">
                <div class="title">
                  <h3 class="nama"><?= $row['namakaryawan']; ?></h3>
                </div>
                <div class="button-menu">
                  <i class="fa-solid fa-ellipsis-vertical"></i>
                </div>
                <div class="actions">
                  <a data-name='idkaryawan' data-idkaryawan='<?= $row['idkaryawan'] ?>' id='delete-btn'>
                    <i class=" fa-solid fa-trash-can"></i>
                    Delete
                  </a>
                  <a href="../update/updatekaryawan.php?idkaryawan=<?= $row['idkaryawan']  ?>" class="update">
                    <i class=" fa-solid fa-pen-to-square"></i>
                    Update
                  </a>
                </div>
              </div>
              <!-- Akhir Card Header -->

              <hr>

              <!-- Card Body -->
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
              <!-- Akhir Card Body -->
            </div>
          <?php endwhile; ?>
        <?php endif; ?>
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

<?php if (isset($isDeleted)) : ?>
  <script>
    Swal.fire({
      icon: 'success',
      title: 'Data karyawan berhasil dihapus',
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