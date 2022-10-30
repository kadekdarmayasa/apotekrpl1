<?php
session_start();
include '../app/functions.php';
$_SESSION['view'] = 'transaksi';

// Delete Statement
if (isset($_GET['idtransaksi'])) {
  $affectedRow = delete("DELETE FROM tb_transaksi WHERE idtransaksi=" . $_GET['idtransaksi']);
  if ($affectedRow > 0) {
    $isDeleted = true;
  }
}

// Search Statement
if (isset($_POST['search-keyword'])) {
  $keyword = $_POST['search-keyword'];
  $queryTransaksi = mysqli_query($conn, "SELECT * FROM tb_transaksi WHERE tgltransaksi LIKE '%$keyword%'");
  if (mysqli_num_rows($queryTransaksi) == 0) {
    $isEmptyResult = true;
  }
} else {
  $queryTransaksi = mysqli_query($conn, "SELECT * FROM tb_transaksi ORDER BY idtransaksi DESC");
}

?>

<?php include '../template/header.php'; ?>
<div class="container">
  <?php include '../template/sidebar.php'; ?>

  <div class="content">
    <?php include '../template/navbar.php' ?>

    <div class="sidebar-content">
      <h2>Daftar Transaksi</h2>

      <div class="search-container">
        <!-- Awal Search Bar -->
        <form method="post" action="transaksi.php" class="search-bar">
          <i class="fa-solid fa-magnifying-glass"></i>
          <input type="text" name="search-keyword" placeholder="Cari transaksi berdasarkan tanggal..." id="keyword">
        </form>
        <!-- Akhir Search Bar -->

        <!-- Print Button -->
        <div class="print">
          <a href="table-print-obat.php">Print Data</a>
        </div>
        <!-- Print Button -->
      </div>

      <div class="cards">
        <?php if (@$isEmptyResult) : ?>
          <p>Transaksi yang anda cari tidak ada.</p>
        <?php else : ?>
          <?php
          while ($row = mysqli_fetch_assoc($queryTransaksi)) :
            $tgl_transaksi = $row['tgltransaksi'];
            $kategori_pelanggan = $row['kategoripelanggan'];
            $id_karyawan = $row['idkaryawan'];
            $id_pelanggan = $row['idpelanggan'];
            $id_transaksi = $row['idtransaksi'];
            $total_bayar = number_format($row['totalbayar'], 0, ',', '.');
            $bayar =  number_format($row['bayar'], 0, ',', '.');
            $kembali =  number_format($row['kembali'], 0, ',', '.');
          ?>
            <div class="card">
              <div class="card-header">
                <div class="title">
                  <h3 class="tgl-transaksi"><?= $tgl_transaksi; ?></h3>
                  <p class="kategori-pelanggan"><?= $kategori_pelanggan ?></p>
                </div>
                <div class="button-menu">
                  <i class="fa-solid fa-ellipsis-vertical"></i>
                </div>
                <div class="actions">
                  <a id="delete-btn" data-name="idtransaksi" data-id_transaksi="<?= $id_transaksi ?>">
                    <i class="fa-solid fa-trash-can"></i>
                    Delete
                  </a>
                  <a href="">
                    <i class=" fa-solid fa-pen-to-square"></i>
                    Update
                  </a>
                  <a class="detail" data-tgl_transaksi="<?= $tgl_transaksi ?>" data-kategori_pelanggan="<?= $kategori_pelanggan ?>" data-idkaryawan="<?= $id_karyawan ?>" data-idpelanggan="<?= $id_pelanggan ?>" data-idtransaksi="<?= $id_transaksi ?>" data-totalbayar="<?= $total_bayar ?>" data-bayar="<?= $bayar ?>" data-kembali="<?= $kembali ?>">
                    <i class="fa-solid fa-info"></i>
                    Detail
                  </a>
                </div>
              </div>
              <div class="price-stok">
                <div class="bayar">
                  <h5>Bayar</h5>
                  <p>Rp. <?= $bayar ?></p>
                </div>
                <div class="kembali">
                  <h5>Kembali</h5>
                  <p>Rp. <?= $kembali ?></p>
                </div>
              </div>
            </div>
          <?php endwhile; ?>
        <?php endif; ?>
      </div>

      <!-- Awal Add button -->
      <button id="add-button">
        <a href="../tambah/tambah-transaksi.php" style="display: block; color: white;">
          <i class="fa-solid fa-plus"></i>
        </a>
      </button>
      <!-- Akhir Add Button -->
    </div>
  </div>
</div>

<?php if (isset($isDeleted)) : ?>
  <script>
    Swal.fire({
      icon: 'success',
      title: 'Data transaksi berhasil dihapus',
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
      location.href = 'transaksi.php';
    });
  </script>
<?php endif; ?>

<?php include '../template/footer.php'; ?>