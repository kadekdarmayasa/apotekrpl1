<?php
include '../app/functions.php';

if ($_POST['update'] == 'obat') {
  $idobat = $_POST['idobat'];
  $namaobat = $_POST['namaobat'];
  $idsupplier = $_POST['idsupplier'];
  $kategoriobat = $_POST['kategoriobat'];
  $hargajual = $_POST['hargajual'];
  $hargabeli = $_POST['hargabeli'];
  $stokobat = $_POST['stokobat'];
  $keterangan = $_POST['keterangan'];

  update("UPDATE tb_obat SET namaobat='$namaobat', idsupplier='$idsupplier', kategoriobat='$kategoriobat', hargajual='$hargajual', hargabeli='$hargabeli', stok_obat='$stokobat', keterangan='$keterangan' WHERE idobat='$idobat'");

  if (mysqli_affected_rows($conn) > 0) {
    echo "
      <script>
        alert('Data Obat Berhasil Diperbarui');
        location.href = '../view/viewobat.php';
      </script>
    ";
  } elseif ($result < 0) {
    echo "
      <script>
        alert('Data Obat Gagal Diperbarui');
        location.href = '../view/viewobat.php';
      </script>
    ";
  } else {
    echo "
      <script>
        alert('Tidak Terdapat Data Obat Yang Diperbarui');
        location.href = '../view/viewobat.php';
      </script>
    ";
  }
}

if ($_POST['update'] == 'pelanggan') {
  $idpelanggan = $_POST['idpelanggan'];
  $namalengkap = $_POST['namalengkap'];
  $alamat = $_POST['alamat'];
  $telp = $_POST['telp'];
  $usia = $_POST['usia'];
  $oldfilename = $_POST['oldfotoresep'];

  if ($_FILES['fotoresep']['error'] == 4) {
    $fotoresep = $oldfilename;
  } else {
    $fotoresep = upload();
    if (!$fotoresep) {
      echo "<script>
        location.href = '../update/updatepelanggan.php?idpelanggan=' + $idpelanggan;
      </script>";
      exit;
    }
  }

  $query = "
    UPDATE tb_pelanggan SET
      namalengkap = '$namalengkap',
      alamat = '$alamat',
      telp = $telp,
      usia = $usia,
      buktifotoresep = '$fotoresep'
    WHERE 
      idpelanggan = $idpelanggan
  ";
  mysqli_query($conn, $query);
  if (mysqli_affected_rows($conn) > 0) {
    echo "
      <script>
        alert('Data Pelanggan Berhasil Diperbarui');
        location.href = '../view/viewpelanggan.php';
      </script>
    ";
  } elseif (mysqli_affected_rows($conn) < 0) {
    echo "
      <script>
        alert('Data Pelanggan Gagal Diperbarui');
        location.href = '../view/viewpelanggan.php';
      </script>
    ";
  } else {
    echo "
      <script>
        alert('Tidak Terdapat Data Pelanggan Yang Diperbarui');
        location.href = '../view/viewpelanggan.php';
      </script>
    ";
  }
}
