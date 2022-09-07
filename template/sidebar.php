<?php
$view =  $_SESSION['view'];
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

    <li class="menu">
      <a href="">
        <i class="fa-solid fa-money-bill-transfer"></i>
        Transaksi
      </a>
    </li>

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


    <?php if ($view == 'supplier') : ?>
      <li class="menu">
        <a href="viewsupplier.php" class="active">
          <i class="fa-solid fa-truck-field"></i>
          Supplier
        </a>
      </li>
    <?php else : ?>
      <li class="menu">
        <a href="viewsupplier.php">
          <i class="fa-solid fa-truck-field"></i>
          Supplier
        </a>
      </li>
    <?php endif; ?>

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
  </ul>
  <!-- Akhir Sidebar Menu -->
</div>