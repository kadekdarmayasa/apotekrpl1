<?php
session_start();
$_SESSION['view'] = 'transaksi-detail';
include '../app/functions.php';
include '../app/koneksi.php';

$idtransaksi = $_SESSION['idtransaksi'];
$row = selectSingleData("SELECT * FROM tb_transaksi WHERE idtransaksi=$idtransaksi");

$idpelanggan = $row['idpelanggan'];
$row_pelanggan = selectSingleData("SELECT namalengkap FROM tb_pelanggan WHERE idpelanggan=" . $idpelanggan);

$idkaryawan = $row['idkaryawan'];
$row_karyawan = selectSingleData("SELECT namakaryawan FROM tb_karyawan WHERE idkaryawan=" . $idkaryawan);
?>


<?php include '../template/header.php' ?>
<div class="form">
  <div class="form-toggle"></div>
  <div class="form-panel one">
    <div class="form-header">
      <h1>Detail Transaksi</h1>
    </div>
    <div class="form-content">
      <table>
        <tr>
          <td>Tanggal Transaksi</td>
          <td><?= $row['tgltransaksi']; ?></td>
        </tr>
        <tr>
          <td>Nama Pelanggan</td>
          <td><?= $row_pelanggan['namalengkap']; ?></td>
        </tr>
        <tr>
          <td>Kategori Pelanggan</td>
          <td><?= $row['kategoripelanggan']; ?></td>
        </tr>
        <tr>
          <td>Nama Karyawan</td>
          <td><?= $row_karyawan['namakaryawan']; ?></td>
        </tr>
      </table>

      <table class="grand-total-table" style="margin-top: 1.5em;">
        <tr>
          <th>Nama Obat</th>
          <th>Jumlah</th>
          <th>Harga Satuan</th>
          <th>Total Harga</th>
        </tr>
        <?php
        $hasilDetail = mysqli_query($conn, "SELECT * FROM tabel_detail_transaksi WHERE idtransaksi=" . $idtransaksi);
        while ($rowDetail = mysqli_fetch_assoc($hasilDetail)) :
          $idObat = $rowDetail['idobat'];
          $queryObat = selectSingleData("SELECT namaobat FROM tb_obat WHERE idobat=" . $idObat);
        ?>
          <tr>
            <td><?= $queryObat['namaobat']; ?></td>
            <td><?= $rowDetail['jumlah'] ?></td>
            <td><?= number_format($rowDetail['hargasatuan'], 0, ',', '.') ?></td>
            <td><?= number_format($rowDetail['totalharga'], 0, ',', '.') ?></td>
          </tr>
        <?php endwhile; ?>
        <tr>
          <td colspan="3">Grand Total</td>
          <td>
            <?php
            $grand_total = mysqli_fetch_row(mysqli_query($conn, "SELECT SUM(totalharga) FROM tabel_detail_transaksi WHERE idtransaksi=" . $idtransaksi));
            // echo number_format($grand_total[0], 0, ',', '.');
            ?>
          </td>
        </tr>
      </table>

      <!-- input total bayar -->
      <?php if (@$_POST['finish']) : ?>

      <?php endif; ?>
    </div>
  </div>
</div>
<?php include '../template/footer.php' ?>