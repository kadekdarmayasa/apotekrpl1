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
      <form method="POST" action="tambah-transaksi.php" id="form">
        <div class="form-group show">
          <label for="kategoripelanggan">Kategori Pelanggan</label>
          <select name="kategoripelanggan" id="kategoripelanggan" required>
            <?php if (@$_POST['kategoripelanggan'] == 'pelanggan') : ?>
              <option value="pelanggan" selected>Langganan</option>
            <?php else : ?>
              <option value="pelanggan">Langganan</option>
            <?php endif; ?>

            <?php if (@$_POST['kategoripelanggan'] == 'umum') : ?>
              <option value="umum" selected>Umum</option>
            <?php else :  ?>
              <option value="umum">Umum</option>
            <?php endif; ?>
          </select>
        </div>
        <div class="form-group">
          <a href="../view/transaksi.php" class="back-dashboard-button">Kembali</a>
          <button type="submit" class="submit-btn" id="submit-next-btn">Selanjutnya</button>
        </div>
      </form>


      <?php if (@$_POST['kategoripelanggan'] == 'pelanggan') : ?>
        <?php echo 'Kategori Pelanggan : ' . $_POST['kategoripelanggan'];  ?>
        <form action="" method="POST" style="margin-top: 4rem ;">
          <div class="form-group">
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
      <?php
      elseif (@$_POST['kategoripelanggan'] == 'umum') :
        $id_pelanggan = '10';
        $id_karyawan = $_SESSION['userinfo']['idkaryawan'];
        $tgl_transaksi = date("Y-m-d");
        $kategori_pelanggan = 'umum';

        mysqli_query($conn, 'SET FOREIGN_KEY_CHECKS=0');

        mysqli_query($conn, "INSERT INTO tb_transaksi VALUES(null, '$id_pelanggan', '$id_karyawan', '$tgl_transaksi', '$kategori_pelanggan', '0', '0', '0')");

        $query_transaksi = mysqli_query($conn, "SELECT LAST_INSERT_ID()");
        $hasil_id_transaksi = mysqli_fetch_row($query_transaksi);
        $_SESSION['idtransaksi'] = $hasil_id_transaksi[0];

        if (!$hasil_id_transaksi) {
          die("Gagal " . mysqli_error($conn));
        } else {
          echo "
            <script>
              window.location = 'tambah-detail-transaksi.php';
            </script>
          ";
        }
      ?>
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