<?php
session_start();

if (!isset($_SESSION['userinfo']['username'])) {
  header('Location: ../login.php');
  exit;
}

include "../app/koneksi.php";
include '../app/functions.php';

$username = $_SESSION['userinfo']['username'];
$idkaryawan = $_SESSION['userinfo']['idkaryawan'];
$totalObat = getNumRows("SELECT * FROM tb_obat");
$totalKaryawan = getNumRows("SELECT * FROM tb_karyawan");
$totalPelanggan = getNumRows("SELECT * FROM tb_pelanggan");
$totalSupplier = getNumRows("SELECT * FROM tb_supplier");
$totalTransaksi = getNumRows("SELECT * FROM tb_transaksi");
?>


<?php
$_SESSION['view'] = 'dashboard';
include '../template/header.php'
?>
<div class="container">
  <?php include '../template/sidebar.php'; ?>

  <!-- Awal Content -->
  <div class="content">
    <?php include '../template/navbar.php'; ?>

    <!-- Awal Main -->
    <main>
      <div class="jumbotron"></div>
      <!-- Awal Dashboard -->
      <div class="dashboard">
        <h3>Dashboard</h3>
        <!-- Awal Dashboard Items -->
        <div class="dashboard-items">
          <?php if ($_SESSION['userinfo']['leveluser'] == 'admin') : ?>
            <?php include '../template/menu-admin.php' ?>
          <?php else : ?>
            <?php include '../template/menu-karyawan.php' ?>
          <?php endif; ?>
        </div>
        <!-- Akhir Dashboard Items -->
      </div>
      <!-- Akhir Dashboard -->
    </main>
    <!-- Akhir Main -->
  </div>
  <!-- Akhir Content -->
</div>

<?php include '../template/footer.php' ?>