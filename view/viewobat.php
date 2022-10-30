<?php
session_start();
include '../app/koneksi.php';
include '../app/functions.php';
$_SESSION['view'] = 'obat';

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

// Delete Statement
if (isset($_GET['idobat'])) {
  $affectedRow = delete("DELETE FROM tb_obat WHERE idobat=" . $_GET['idobat']);
  if ($affectedRow > 0) {
    $isDeleted = true;
  }
}

// Insert Statement
if (isset($_POST['submit-button'])) {
  $idsupplier = $_POST['idsupplier'];
  $namaobat = $_POST['namaobat'];
  $kategoriobat = $_POST['kategoriobat'];
  $hargajual = $_POST['hargajual'];
  $hargabeli = $_POST['hargabeli'];
  $stokobat = $_POST['stokobat'];
  $keterangan = $_POST['keterangan'];

  $affectedRow = insert("INSERT INTO tb_obat VALUES (null, $idsupplier, '$namaobat', '$kategoriobat', '$hargajual', '$hargabeli', '$stokobat', '$keterangan')");
  if ($affectedRow > 0) {
    $successfullyAdded = true;
  } else {
    $successfullyAdded = false;
  }
}

// Search Statement
if (isset($_POST['search-keyword'])) {
  $keyword = $_POST['search-keyword'];
  $queryObat = mysqli_query($conn, "SELECT * FROM tb_obat WHERE namaobat LIKE '%$keyword%'");
  if (mysqli_num_rows($queryObat) == 0) {
    $isEmptyResult = true;
  }
} else {
  $queryObat = mysqli_query($conn, "SELECT * FROM tb_obat ORDER BY idobat DESC");
}
?>

<?php include '../template/header.php' ?>

<div class="container">
  <?php include '../template/sidebar.php' ?>

  <div class="content">
    <?php include '../template/navbar.php'; ?>

    <div class="sidebar-content">
      <h2>Daftar Obat</h2>


      <div class="search-container">
        <!-- Awal Search Bar -->
        <form method="post" action="viewobat.php" class="search-bar">
          <i class="fa-solid fa-magnifying-glass"></i>
          <input type="text" name="search-keyword" placeholder="Cari obat berdasarkan nama..." id="keyword">
        </form>
        <!-- Akhir Search Bar -->

        <!-- Print Button -->
        <div class="print">
          <a href="print-data-obat.php">Print Data</a>
        </div>
        <!-- Print Button -->
      </div>

      <!-- Awal Cards -->
      <div class="cards">
        <?php if (@$isEmptyResult) : ?>
          <p>Obat yang anda cari tidak ada.</p>
        <?php else : ?>
          <?php
          while ($row = mysqli_fetch_assoc($queryObat)) :
            $idsupplier = $row['idsupplier'];
            $keterangan = $row['keterangan'];
            $nama_obat = $row['namaobat'];
            $idobat = $row['idobat'];
            $kategori_obat = $row['kategoriobat'];
            $harga_jual = number_format($row['hargajual'], 0, ',', '.');
            $harga_beli = number_format($row['hargabeli'], 0, ',', '.');
            $stok_obat = $row['stok_obat'];
          ?>
            <div class="card">
              <div class="card-header">
                <div class="title">
                  <h3 class="nama-obat"><?= $nama_obat; ?></h3>
                  <p class="kategori-obat"><?= strtolower($kategori_obat); ?></p>
                </div>
                <div class="button-menu">
                  <i class="fa-solid fa-ellipsis-vertical"></i>
                </div>
                <div class="actions">
                  <a id="delete-btn" data-idobat="<?= $idobat; ?>" data-name="idobat">
                    <i class="fa-solid fa-trash-can"></i>
                    Delete
                  </a>
                  <a href="../update/updateobat.php?idobat=<?= $idobat ?>" class="update">
                    <i class=" fa-solid fa-pen-to-square"></i>
                    Update
                  </a>
                  <a class="detail" data-keterangan="<?= $keterangan ?>" data-namaobat="<?= $nama_obat ?>" data-kategoriobat="<?= $kategori_obat ?>" data-hargabeli="<?= $harga_beli ?>" data-hargajual="<?= $harga_jual ?>" data-stokobat="<? $stok_obat ?>">
                    <i class="fa-solid fa-info"></i>
                    Detail
                  </a>
                </div>
              </div>
              <div class="price-stok">
                <div class="hargajual">
                  <h5>Harga</h5>
                  <p>Rp. <?= $harga_jual; ?></p>
                </div>
                <div class="stok-obat">
                  <h5>Stok</h5>
                  <p><?= $stok_obat; ?></p>
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



<!-- Sweealert Template Tambah obat -->
<template id="tambah-data-obat">
  <swal-param name="showConfirmButton" value="false" />
  <swal-html>
    <form action="viewobat.php" method="post">
      <div class="item-input-container">
        <h2 class="title">Tambahkan Data Obat</h2>
        <div class="input-item">
          <label for="idsuppplier">ID Supplier</label>
          <select name="idsupplier" id="idsupplier">
            <?php
            $querySupplier = mysqli_query($conn, "SELECT idsupplier, perusahaan FROM tb_supplier");
            while ($row = mysqli_fetch_assoc($querySupplier)) :
            ?>
              <option value="<?= $row['idsupplier']; ?>">
                <?= $row['perusahaan']; ?>
              </option>
            <?php endwhile; ?>
          </select>
        </div>
        <div class="input-item">
          <label for="namaobat">Nama Obat</label>
          <input type="text" name="namaobat" id="namaobat" required>
        </div>
        <div class="input-item">
          <label for="kategoriobat">Ketegori Obat</label>
          <input type="text" name="kategoriobat" id="kategoriobat" required>
        </div>
        <div class="input-item">
          <label for="hargajual">Harga Jual</label>
          <input type="number" name="hargajual" id="hargajual" required>
        </div>
        <div class="input-item">
          <label for="hargabeli">Harga Beli</label>
          <input type="number" name="hargabeli" id="hargabeli" required>
        </div>
        <div class="input-item">
          <label for="stokobat">Stok Obat</label>
          <input type="number" name="stokobat" id="stokobat" required>
        </div>
        <div class="input-item">
          <label for="stokobat">Keterangan</label>
          <textarea name="keterangan" id="keterangan" required></textarea>
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
      title: 'Data obat berhasil dihapus',
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
      location.href = 'viewobat.php';
    });
  </script>
<?php endif; ?>

<?php if (isset($successfullyAdded)) : ?>
  <?php if ($successfullyAdded) : ?>
    <script>
      Swal.fire({
        icon: 'success',
        title: 'Data obat berhasil ditambahkan',
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 10000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
      }).then(() => {
        location.href = 'viewobat.php';
      });
    </script>
  <?php else : ?>
    <script>
      Swal.fire({
        icon: 'error',
        title: 'Data obat gagal ditambahkan',
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
        location.href = 'viewobat.php';
      });
    </script>
  <?php endif ?>
<?php endif; ?>

<?php include '../template/footer.php' ?>