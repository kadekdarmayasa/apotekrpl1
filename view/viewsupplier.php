<?php
session_start();
if (!isset($_SESSION['username'])) {
  header('Location: ../login.php');
  exit;
}

include '../app/koneksi.php';
include '../app/functions.php';
$_SESSION['view'] = 'supplier';

?>

<?php include '../template/header.php'; ?>

<div class="container">
  <?php include '../template/sidebar.php'; ?>

  <div class="content">
    <?php include '../template/navbar.php' ?>

    <div class="sidebar-content">
      <h2>Daftar Supplier</h2>

      <!-- Awal Search Bar -->
      <form method="post" action="viewobat.php" class="search-bar">
        <i class="fa-solid fa-magnifying-glass"></i>
        <input type="text" name="search-keyword" placeholder="Cari obat berdasarkan nama..." id="keyword">
      </form>
      <!-- Akhir Search Bar -->

      <!-- Awal Cards -->
      <div class="cards">
        <?php $querySupplier = mysqli_query($conn, "SELECT * FROM tb_supplier"); ?>
        <?php while ($row = mysqli_fetch_assoc($querySupplier)) : ?>
          <div class="card">
            <div class="card-header">
              <h2 class="company-name"><?= $row['perusahaan'] ?></h2>
              <div class="button-menu">
                <i class="fa-solid fa-ellipsis-vertical"></i>
              </div>
              <div class="actions">
                <a onclick="">
                  <i class="fa-solid fa-trash-can"></i>
                  Delete
                </a>
                <a href="" class="update">
                  <i class=" fa-solid fa-pen-to-square"></i>
                  Update
                </a>
              </div>
            </div>
            <hr>
            <p class="description"><?= $row['keterangan'] ?></p>
          </div>
        <?php endwhile; ?>
      </div>
      <!-- Akhir Cards -->

    </div>
  </div>
</div>

<?php include '../template/footer.php' ?>