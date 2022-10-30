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
var_dump($row_karyawan);
?>

<table border="1" cellpadding='10' style="border-collapse: collapse; margin: auto;">
  <tr>
    <td>Tanggal Transaksi</td>
    <td><?= $row['tgltransaksi']; ?></td>
  </tr>
</table>