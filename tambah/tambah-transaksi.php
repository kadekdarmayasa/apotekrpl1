<?php
session_start();
$_SESSION['view'] = 'tambah-transaksi';
include '../app/functions.php';
include '../app/koneksi.php';

if (isset($_POST['simpan_langganan'])) {
  $namaPelanggan = $_POST['namapelanggan'];
  $queryIdPelanggan = mysqli_query($conn, "SELECT idpelanggan FROM tb_pelanggan WHERE namalengkap='$namaPelanggan'");
  $barisPelanggan = mysqli_fetch_assoc($queryIdPelanggan);

  $idPelanggan = $barisPelanggan['idpelanggan'];
  $idkaryawan = $_SESSION['userinfo']['idkaryawan'];
  $tglTransaksi = date('Y-m-d');
  $kategoriPelanggan = 'langganan';

  insert("INSERT INTO tb_transaksi VALUES (null, '$idPelanggan', '$idkaryawan', '$tglTransaksi', '$kategoriPelanggan', '0', '0', '0')");

  $queryTransaksi = mysqli_query($conn, "SELECT LAST_INSERT_ID()");
  $hasilidtransaksi = mysqli_fetch_row($queryTransaksi);
  $_SESSION['idtransaksi'] = $hasilidtransaksi['0'];

  if (!$hasilidtransaksi) {
    die("Gagal memasukkan data Transaksi " . mysqli_error($conn));
  } else {
    echo "<script>
      window.location = 'tambah-detail-transaksi.php';
    </script>";
  }
}

?>

<?php include '../template/header.php' ?>

<div class="form">
  <div class="form-toggle"></div>
  <div class="form-panel one">
    <div class="form-header">
      <h1>Tambah Transaksi</h1>
    </div>
    <div class="form-content">
      <form method="POST" action="">
        <!-- Field Kategori Pelanggan -->
        <div class="form-group show">
          <label for="kategoripelanggan">Kategori Pelanggan</label>
          <select name="kategoripelanggan" id="kategoripelanggan" required>
            <option value="langganan">Langganan</option>
            <option value="umum">Umum</option>
          </select>
        </div>
        <div class="form-group">
          <a href="../view/transaksi.php" class="back-dashboard-button">Kembali</a>
          <button type="submit" class="submit-btn" id="submit-next-btn">Selanjutnya</button>
        </div>
      </form>


      <?php if (isset($_POST['kategoripelanggan'])) : ?>
        <form action="" method="POST" style="margin-top: 4rem ;">
          <!-- Field Id Pelanggan -->
          <div class="form-group hidden">
            <label for="namapelanggan">Nama Pelanggan</label>
            <input list="listpelanggan" id="namapelanggan" name="namapelanggan">
            <datalist id="listpelanggan">
              <?php
              $query = select("SELECT * FROM tb_pelanggan");
              while ($row = mysqli_fetch_assoc($query)) :
              ?>
                <option value="<?= $row['namalengkap'] ?>"></option>
              <?php endwhile; ?>
            </datalist>
          </div>

          <div class="form-group">
            <button type="submit" name="simpan_langganan" class="submit-btn">Submit</button>
          </div>
        </form>
        <!-- </div> -->
      <?php endif; ?>

    </div>
  </div>

  <?php if (isset($existIdTransaksi)) : ?>
    <script>
      Swal.fire({
        icon: 'error',
        title: 'Oops',
        text: 'Id transaksi sudah ada di dalam database'
      })
    </script>
  <?php endif; ?>
  <?php include '../template/footer.php' ?>