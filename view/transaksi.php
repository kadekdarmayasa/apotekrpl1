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
  $queryTransaksi = search('tb_transaksi', 'tgltransaksi', $keyword);
  if (mysqli_num_rows($queryTransaksi) == 0) $isEmptyResult = true;
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
          <?php if (@$_POST['search-keyword']) : ?>
            <input type="text" name="search-keyword" value="<?= $keyword ?>" placeholder="Cari transaksi..." id="keyword">
          <?php else : ?>
            <input type="text" name="search-keyword" placeholder="Cari transaksi..." id="keyword">
          <?php endif; ?>
        </form>
        <!-- Akhir Search Bar -->
      </div>

      <div class="cards">
        <?php if (@$isEmptyResult) : ?>
          <p>Transaksi yang anda cari tidak ada.</p>
        <?php else : ?>
          <?php
          while ($row = mysqli_fetch_assoc($queryTransaksi)) :
            $tgl_transaksi = $row['tgltransaksi'];
            $id_transaksi = $row['idtransaksi'];
            $kategori_pelanggan = $row['kategoripelanggan'];
            $bayar =  number_format($row['bayar'], 0, ',', '.');
            $kembali =  number_format($row['kembali'], 0, ',', '.');
          ?>
            <div class="card">
              <!-- Card Header -->
              <div class="card-header">
                <div class="title">
                  <h3 class="tgl-transaksi"><?= $tgl_transaksi; ?></h3>
                  <p class="kategori-pelanggan"><?= $kategori_pelanggan ?></p>
                </div>

                <div class="button-menu">
                  <i class="fa-solid fa-ellipsis-vertical"></i>
                </div>
                <div class="actions">
                  <?php if (@$_SESSION['userinfo']['leveluser'] != 'user_karyawan') :  ?>
                    <a id="delete-btn" data-name="idtransaksi" data-id_transaksi="<?= $id_transaksi ?>">
                      <i class="fa-solid fa-trash-can"></i>
                      Delete
                    </a>
                  <?php endif; ?>
                  <a class="detail" href="../tambah/tambah-detail-transaksi.php?idtransaksi=<?= $id_transaksi ?>">
                    <i class="fa-solid fa-info"></i>
                    Detail
                  </a>
                </div>
              </div>
              <!-- Akhir Card Header -->

              <!-- Card Body -->
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
              <!-- Akhir Card Body -->
            </div>
          <?php endwhile; ?>
        <?php endif; ?>
      </div>

      <!-- Awal Add button -->
      <?php if ($_SESSION['userinfo']['leveluser'] != 'user_karyawan') :  ?>
        <button id="add-button">
          <a href="../tambah/tambah-transaksi.php" style="display: block; color: white;">
            <i class="fa-solid fa-plus"></i>
          </a>
        </button>
      <?php endif; ?>
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