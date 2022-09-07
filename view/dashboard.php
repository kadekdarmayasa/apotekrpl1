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
// Session untuk view dashboard
// Digunakan untuk mendeteksi perubahan tab dalam sidebar
$_SESSION['view'] = 'dashboard';
include '../template/header.php'
?>
<div class="container">
  <!-- Awal Sidebar -->
  <?php include '../template/sidebar.php'; ?>
  <!-- Akhir Sidebar -->

  <!-- Awal Content -->
  <div class="content">
    <!-- Awal Navbar -->
    <?php include '../template/navbar.php'; ?>
    <!-- Akhir Navbar -->

    <!-- Awal Main -->
    <main>

      <!-- Awal Jumbotron -->
      <div class="jumbotron"></div>
      <!-- Akhir Jumbotron -->

      <!-- Awal Dashboard -->
      <div class="dashboard">
        <h3>Dashboard</h3>

        <!-- Awal Dashboard Items -->
        <div class="dashboard-items">
          <!-- Session untuk viewobat -->
          <!-- Digunakan untuk mendeteksi perubahan tab dalam sidebar -->

          <!-- Awal Item 1 - Obat -->
          <a href="viewobat.php" class="item obat">
            <div class="picture">
              <i class="fa-solid fa-capsules"></i>
            </div>
            <div class="description">
              <p>Total Obat</p>
              <h4><?= $totalObat; ?></h4>
            </div>
            <div class="arrow">
              <i class="fa-solid fa-angle-right"></i>
            </div>
          </a>
          <!-- Akhir Item 1 - Obat  -->

          <!-- Awal Item 2 - Karyawan -->
          <a href="./viewkaryawan.php" class="item karyawan">
            <div class="picture">
              <i class="fa-solid fa-user-doctor"></i>
            </div>
            <div class="description">
              <p>Total Karyawan</p>
              <h4><?= $totalKaryawan; ?> </h4>
            </div>
            <div class="arrow">
              <i class="fa-solid fa-angle-right"></i>
            </div>
          </a>
          <!-- Akhir item 2 - Karyawan -->

          <!-- Awal Item 3 - Pelanggan -->
          <a href="./viewpelanggan.php" class="item pelanggan">
            <div class="picture">
              <i class="fa-solid fa-users"></i>
            </div>
            <div class="description">
              <p>Total Pelanggan</p>
              <h4><?= $totalPelanggan; ?></h4>
            </div>
            <div class="arrow">
              <i class="fa-solid fa-angle-right"></i>
            </div>
          </a>
          <!-- Akhir Item 3 - Pelanggan -->

          <!-- Awal Item 4 - Supplier -->
          <a href="./viewsupplier.php" class="item supplier">
            <div class="picture">
              <i class="fa-solid fa-truck-field"></i>
            </div>
            <div class="description">
              <p>Total Supplier</p>
              <h4><?= $totalSupplier; ?></h4>
            </div>
            <div class="arrow">
              <i class="fa-solid fa-angle-right"></i>
            </div>
          </a>
          <!-- Akhir Item 4 - Supplier -->

          <!-- Awal Item 5 - Transaksi -->
          <a href="" class="item transaksi">
            <div class="picture">
              <i class="fa-solid fa-money-bill-transfer"></i>
            </div>
            <div class="description">
              <p>Total Transaksi</p>
              <h4><?= $totalTransaksi; ?></h4>
            </div>
            <div class="arrow">
              <i class="fa-solid fa-angle-right"></i>
            </div>
          </a>
          <!-- Akhir Item 5 - Transaksi -->
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