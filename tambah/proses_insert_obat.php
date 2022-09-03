<?php

include '../app/koneksi.php';

$idsupplier = $_POST['idsupplier'];
$namaobat = $_POST['namaobat'];
$kategoriobat = $_POST['kategoriobat'];
$hargajual = $_POST['hargajual'];
$hargabeli = $_POST['hargabeli'];
$stokobat = $_POST['stokobat'];
$keterangan = $_POST['keterangan'];

$query = mysqli_query($conn, "INSERT INTO tb_obat VALUES (null, $idsupplier, '$namaobat', '$kategoriobat', '$hargajual', '$hargabeli', '$stokobat', '$keterangan')");

if (!mysqli_errno($conn)) {
  echo "<script>
          alert('Data berhasil ditambahkan');
          location.href = '../view/viewobat.php';
        </script>";
} else {
  echo "Data gagal di masukkan" . mysqli_error($conn);
}
