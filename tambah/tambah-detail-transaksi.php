<?php
session_start();
$_SESSION['view'] = 'transaksi-detail';
include '../app/functions.php';
include '../app/koneksi.php';

if (@$_GET['idtransaksi']) {
  $idtransaksi = $_GET['idtransaksi'];
} else {
  $idtransaksi = $_SESSION['idtransaksi'];
}
$row = selectSingleData("SELECT * FROM tb_transaksi WHERE idtransaksi=$idtransaksi");

$idpelanggan = $row['idpelanggan'];
$row_pelanggan = selectSingleData("SELECT namalengkap FROM tb_pelanggan WHERE idpelanggan=" . $idpelanggan);

$idkaryawan = $row['idkaryawan'];
$row_karyawan = selectSingleData("SELECT namakaryawan FROM tb_karyawan WHERE idkaryawan=" . $idkaryawan);

$query_transaksi = selectSingleData("SELECT totalbayar, bayar FROM tb_transaksi WHERE idtransaksi=$idtransaksi");

if (@$_POST['more']) {
  $nama_obat = $_POST['namaobat'];
  $jumlah = $_POST['jumlah'];
  $query_obat = selectSingleData("SELECT idobat, hargajual FROM tb_obat WHERE namaobat='$nama_obat'");
  $id_obat = $query_obat['idobat'];
  $harga_satuan = $query_obat['hargajual'];
  $total_harga = $jumlah * $harga_satuan;

  insert("INSERT INTO tabel_detail_transaksi VALUES(null, '$idtransaksi', '$id_obat', '$jumlah', '$harga_satuan', '$total_harga')");
}
?>


<?php include '../template/header.php' ?>
<div class="form">
  <div class="form-toggle"></div>
  <div class="form-panel one">
    <div class="form-header d-flex">
      <h1>Detail Transaksi</h1>
    </div>
    <div class="form-content">
      <!-- Tabel Atas -->
      <table class="table table-bordered">
        <tr>
          <td>Tanggal Transaksi</td>
          <td><?= $row['tgltransaksi']; ?></td>
        </tr>
        <?php if ($row_pelanggan != null) : ?>
          <tr>
            <td>Nama Pelanggan</td>
            <td><?= $row_pelanggan['namalengkap']; ?></td>
          </tr>
        <?php endif; ?>
        <tr>
          <td>Kategori Pelanggan</td>
          <td><?= $row['kategoripelanggan']; ?></td>
        </tr>
        <tr>
          <td>Nama Karyawan</td>
          <td><?= $row_karyawan['namakaryawan']; ?></td>
        </tr>
      </table>

      <div class="container mt-3">
        <!-- Tabel Bawah -->
        <div class="row mt-5" style="width: 550px;">
          <table class="table table-bordered">
            <thead>
              <tr class="text-center">
                <th scope="col">Nama Obat</th>
                <th scope="col">Jumlah</th>
                <th scope="col">Harga Satuan</th>
                <th scope="col">Total Harga</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $hasildetail = mysqli_query($conn, "SELECT * FROM tabel_detaiL_transaksi WHERE idtransaksi='$idtransaksi'");
              while ($rowDetail = mysqli_fetch_assoc($hasildetail)) :
                $rowIdObat = $rowDetail['idobat'];
                $query_obat = selectSingleData("SELECT namaobat FROM tb_obat WHERE idobat='$rowIdObat'");
              ?>
                <tr>
                  <td><?= $query_obat['namaobat'] ?></td>
                  <td><?= $rowDetail['jumlah']; ?></td>
                  <td class="text-end"><?= number_format($rowDetail['hargasatuan'], 0, ',', '.') ?></td>
                  <td class="text-end"><?= number_format($rowDetail['totalharga'], 0, ',', '.') ?></td>
                </tr>
              <?php endwhile; ?>
              <tr>
                <td colspan="3" class="fw-bold text-end">Grand Total</td>
                <td class="text-end fw-bold">
                  <?php
                  $grandTotal = mysqli_fetch_row(mysqli_query($conn, "SELECT SUM(totalharga) FROM tabel_detail_transaksi WHERE idtransaksi ='$idtransaksi'"));
                  echo number_format($grandTotal[0], 0, ',', '.');
                  ?>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <?php if (@$_POST['finish']) : ?>
        <!-- Input Total Bayar -->
        <form action="" method="post">
          <div class="row">
            <div class="col-12">
              <input type="number" name="bayar" class="form-control mt-3" placeholder="Masukkan jumlah bayar...">
              <input type="submit" name="simpan_transaksi" class="btn btn-primary mt-3 mb-5" value="Simpan Transaksi">
            </div>
          </div>
        </form>

        <!-- Simpan Transaksi Terakhir dan Tampil Detail Bayar -->
      <?php
      elseif (@$_POST['simpan_transaksi'] || $query_transaksi['totalbayar'] != 0) :
        $grandTotal = mysqli_fetch_row(mysqli_query($conn, "SELECT SUM(totalharga) FROM tabel_detail_transaksi WHERE idtransaksi=$idtransaksi"));
        $totalBayar = $grandTotal[0];
        if ($query_transaksi['bayar'] != 0) {
          $bayar = $query_transaksi['bayar'];
        } else {
          $bayar = $_POST['bayar'];
        }
        $kembali = $bayar - $totalBayar;

        mysqli_query($conn, "UPDATE tb_transaksi SET totalbayar='$totalBayar', bayar='$bayar', kembali='$kembali' WHERE idtransaksi=$idtransaksi");
        $transaksi = selectSingleData("SELECT * FROM tb_transaksi WHERE idtransaksi=$idtransaksi");
      ?>
        <table class="table table-bordered mt-5">
          <tr>
            <td>Bayar</td>
            <td><?= number_format($transaksi['bayar'], 0, ',', '.'); ?></td>
          </tr>
          <tr>
            <td>Total Bayar</td>
            <td><?= number_format($transaksi['totalbayar'], 0, ',', '.'); ?></td>
          </tr>
          <tr>
            <td>Kembali</td>
            <td><?= number_format($transaksi['kembali'], 0, ',', '.'); ?></td>
          </tr>
        </table>
        <a href="../view/transaksi.php" class="btn btn-outline-primary mt-3">Lihat Semua Transaksi</a>
        <button class="btn btn-primary mt-3 ms-2" onclick="window.print()">Print Data</button>

        <!-- Input Obat -->
      <?php else : ?>
        <?php
        $query_transaksi = selectSingleData("SELECT totalbayar FROM tb_transaksi WHERE idtransaksi=$idtransaksi");
        if ($query_transaksi['totalbayar'] == 0) :
        ?>
          <div class="row mt-5">
            <div class="col-12">
              <form action="" method="post">
                <input list="list_obat" name="namaobat" class="form-control" placeholder="Masukkan nama obat...">
                <datalist id="list_obat">
                  <?php
                  $hasilNamaObat = mysqli_query($conn, "SELECT * FROM tb_obat");
                  while ($row = mysqli_fetch_assoc($hasilNamaObat)) :
                  ?>
                    <option value="<?= $row['namaobat'] ?>" />
                  <?php endwhile; ?>
                </datalist>
                <input type="number" class="form-control mt-3" name="jumlah" placeholder="Jumlah...">
                <input type="submit" class="btn btn-warning mt-3" value="Masukkan Obat" name="more">
                <input type="submit" class="btn btn-primary mt-3" value="Selesai" name="finish">
              </form>
            </div>
          </div>
        <?php endif; ?>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php include '../template/footer.php' ?>