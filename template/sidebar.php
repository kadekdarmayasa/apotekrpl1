<?php
$view =  $_SESSION['view'];
$leveluser = $_SESSION['userinfo']['leveluser'];
?>

<div class="sidebar">
  <!-- Awal Brand -->
  <div class="brand">
    <i class="fa-solid fa-briefcase-medical"></i>
    <div class="brand-name">
      <h1>Apotek</h1>
      <p>Media Utama</p>
    </div>
  </div>
  <!-- Akhir Brand -->
  <!-- Awal sidebar menu -->
  <ul class="middle-menu">
    <?php if ($leveluser == 'admin') : ?>
      <!-- Dashboard Awal -->
      <li class="menu">
        <?php if ($view == 'dashboard') : ?>
          <a href="dashboard.php" class="active">
            <i class="fa-solid fa-gauge"></i>
            Dashboard
          </a>
        <?php else : ?>
          <a href="dashboard.php">
            <i class="fa-solid fa-gauge"></i>
            Dashboard
          </a>
        <?php endif; ?>
      </li>
      <!-- Dashboard Akhir -->

      <!-- Obat Awal -->
      <li class="menu">
        <?php if ($view == 'obat') : ?>
          <a href="viewobat.php" class="active">
            <i class="fa-solid fa-pills"></i>
            Obat
          </a>
        <?php else : ?>
          <a href="viewobat.php">
            <i class="fa-solid fa-pills"></i>
            Obat
          </a>
        <?php endif; ?>
      </li>
      <!-- Obat Akhir -->

      <!-- Transaksi Awal -->
      <li class="menu">
        <?php if ($view == 'transaksi') : ?>
          <a href="../view/transaksi.php" class="active">
            <i class="fa-solid fa-money-bill-transfer"></i>
            Transaksi
          <?php else : ?>
            <a href="../view/transaksi.php">
              <i class="fa-solid fa-money-bill-transfer"></i>
              Transaksi
            </a>
          <?php endif; ?>
      </li>
      <!-- Transaksi Akhir -->

      <!-- Pelanggan Awal -->
      <li class="menu">
        <?php if ($view == 'pelanggan') : ?>
          <a href="viewpelanggan.php" class="active">
            <i class="fa-solid fa-users"></i>
            Pelanggan
          </a>
        <?php else : ?>
          <a href="viewpelanggan.php">
            <i class="fa-solid fa-users"></i>
            Pelanggan
          </a>
        <?php endif; ?>
      </li>
      <!-- Pelanggan Akhir -->

      <!-- Awal Supplier -->
      <li class="menu">
        <?php if ($view == 'supplier') : ?>
          <a href="viewsupplier.php" class="active">
            <i class="fa-solid fa-truck-field"></i>
            Supplier
          </a>
        <?php else : ?>
          <a href="viewsupplier.php">
            <i class="fa-solid fa-truck-field"></i>
            Supplier
          </a>
        <?php endif; ?>
      </li>
      <!-- Akhir Supplier -->

      <!-- Awal Karyawan -->
      <li class="menu">
        <?php if ($view == 'karyawan') : ?>
          <a href="viewkaryawan.php" class="active">
            <i class="fa-solid fa-user-doctor"></i>
            Karyawan
          </a>
        <?php else : ?>
          <a href="viewkaryawan.php">
            <i class="fa-solid fa-user-doctor"></i>
            Karyawan
          </a>
        <?php endif; ?>
      </li>
      <!-- Akhir Karyawan -->

      <!-- Registrasi Link -->
      <li class="menu register-btn">
        <a href="../register.php">
          Registrasi
        </a>
      </li>
      <!-- Registrasi Link -->

    <?php else : ?>
      <!-- Dashboard Awal -->
      <li class="menu">
        <?php if ($view == 'dashboard') : ?>
          <a href="dashboard.php" class="active">
            <i class="fa-solid fa-gauge"></i>
            Dashboard
          </a>
        <?php else : ?>
          <a href="dashboard.php">
            <i class="fa-solid fa-gauge"></i>
            Dashboard
          </a>
        <?php endif; ?>
      </li>
      <!-- Dashboard Akhir -->

      <!-- Transaksi Awal -->
      <li class="menu">
        <?php if ($view == 'transaksi') : ?>
          <a href="../view/transaksi.php" class="active">
            <i class="fa-solid fa-money-bill-transfer"></i>
            Transaksi
          <?php else : ?>
            <a href="../view/transaksi.php">
              <i class="fa-solid fa-money-bill-transfer"></i>
              Transaksi
            </a>
          <?php endif; ?>
      </li>
      <!-- Transaksi Akhir -->

      <!-- Pelanggan Awal -->
      <li class="menu">
        <?php if ($view == 'pelanggan') : ?>
          <a href="viewpelanggan.php" class="active">
            <i class="fa-solid fa-users"></i>
            Pelanggan
          </a>
        <?php else : ?>
          <a href="viewpelanggan.php">
            <i class="fa-solid fa-users"></i>
            Pelanggan
          </a>
        <?php endif; ?>
      </li>
      <!-- Pelanggan Akhir -->
    <?php endif; ?>
  </ul>
  <!-- Akhir Sidebar Menu -->
</div>