<?php
include '../app/functions.php';
$_SESSION['view'] = 'proses_update';
include '../template/header.php';
?>


<?php
if ($_POST['update'] == 'obat') :
  $idobat = $_POST['idobat'];
  $namaobat = $_POST['namaobat'];
  $idsupplier = $_POST['idsupplier'];
  $kategoriobat = $_POST['kategoriobat'];
  $hargajual = $_POST['hargajual'];
  $hargabeli = $_POST['hargabeli'];
  $stokobat = $_POST['stokobat'];
  $keterangan = $_POST['keterangan'];

  update("UPDATE tb_obat SET namaobat='$namaobat', idsupplier='$idsupplier', kategoriobat='$kategoriobat', hargajual='$hargajual', hargabeli='$hargabeli', stok_obat='$stokobat', keterangan='$keterangan' WHERE idobat='$idobat'");

  if (mysqli_affected_rows($conn) > 0) :
?>
    <script>
      Swal.fire({
        icon: 'success',
        title: 'Data Obat Berhasil Diperbarui',
        html: 'Anda akan diarahkan ke dalam viewobat...',
        timer: 10000,
        timerProgressBar: true,
        showConfirmButton: false,
        didOpen: () => {
          Swal.showLoading();
        }
      }).then((result) => {
        if (result.dismiss === Swal.DismissReason.timer) {
          location.href = '../view/viewobat.php';
        }
        location.href = '../view/viewobat.php';
      })
    </script>
  <?php else : ?>
    <script>
      Swal.fire({
        icon: 'success',
        title: 'Tidak Terdapat Data yang Diperbarui',
        html: 'Anda akan diarahkan ke dalam viewobat...',
        timer: 10000,
        timerProgressBar: true,
        didOpen: () => {
          Swal.showLoading();
        }
      }).then((result) => {
        if (result.dismiss === Swal.DismissReason.timer) {
          location.href = '../view/viewobat.php';
        }
        location.href = '../view/viewobat.php';
      })
    </script>
  <?php endif; ?>
<?php endif; ?>


<?php
if ($_POST['update'] == 'pelanggan') :
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

  $query = "UPDATE tb_pelanggan SET
            namalengkap = '$namalengkap',
            alamat = '$alamat',
            telp = $telp,
            usia = $usia,
            buktifotoresep = '$fotoresep'
            WHERE idpelanggan = $idpelanggan";
  mysqli_query($conn, $query);
?>
  <?php if (mysqli_affected_rows($conn) > 0) :  ?>
    <script>
      Swal.fire({
        icon: 'success',
        title: 'Data Pelanggan Berhasil Diperbarui',
        html: 'Anda akan diarahkan ke dalam viewpelanggan...',
        timer: 10000,
        timerProgressBar: true,
        showConfirmButton: false,
        didOpen: () => {
          Swal.showLoading();
        }
      }).then((result) => {
        if (result.dismiss === Swal.DismissReason.timer) {
          location.href = '../view/viewpelanggan.php';
        }
        location.href = '../view/viewpelanggan.php';
      })
    </script>
  <?php elseif ((mysqli_affected_rows($conn) < 0)) : ?>
    <script>
      Swal.fire({
        icon: 'success',
        title: 'Data Pelanggan Gagal Diperbarui',
        html: 'Anda akan diarahkan ke dalam viewpelanggan...',
        timer: 10000,
        timerProgressBar: true,
        didOpen: () => {
          Swal.showLoading();
        }
      }).then((result) => {
        if (result.dismiss === Swal.DismissReason.timer) {
          location.href = '../view/viewpelanggan.php';
        }
        location.href = '../view/viewpelanggan.php';
      })
    </script>
  <?php else : ?>
    <script>
      Swal.fire({
        icon: 'success',
        title: 'Tidak Terdapat Data Pelanggan Yang di Perbarui',
        html: 'Anda akan diarahkan ke dalam viewpelanggan...',
        timer: 10000,
        timerProgressBar: true,
        didOpen: () => {
          Swal.showLoading();
        }
      }).then((result) => {
        if (result.dismiss === Swal.DismissReason.timer) {
          location.href = '../view/viewpelanggan.php';
        }
        location.href = '../view/viewpelanggan.php';
      })
    </script>
  <?php endif; ?>
<?php endif; ?>

<?php
if ($_POST['update'] == 'supplier') :
  $idsupplier = $_POST['idsupplier'];
  $perusahaan = $_POST['perusahaan'];
  $keterangan = $_POST['keterangan'];
  update("UPDATE tb_supplier SET perusahaan='$perusahaan' , keterangan='$keterangan' WHERE idsupplier='$idsupplier'");
?>
  <?php if (mysqli_affected_rows($conn) > 0) : ?>
    <script>
      Swal.fire({
        icon: 'success',
        title: 'Data Supplier Berhasil Diperbarui',
        html: 'Anda akan diarahkan ke dalam viewsupplier...',
        timer: 10000,
        timerProgressBar: true,
        showConfirmButton: false,
        didOpen: () => {
          Swal.showLoading();
        }
      }).then((result) => {
        if (result.dismiss === Swal.DismissReason.timer) {
          location.href = '../view/viewsupplier.php';
        }
        location.href = '../view/viewsupplier.php';
      })
    </script>
  <?php elseif (mysqli_affected_rows($conn) < 0) : ?>
    <script>
      Swal.fire({
        icon: 'success',
        title: 'Data Supplier Gagal Diperbarui',
        html: 'Anda akan diarahkan ke dalam viewsupplier...',
        timer: 10000,
        timerProgressBar: true,
        didOpen: () => {
          Swal.showLoading();
        }
      }).then((result) => {
        if (result.dismiss === Swal.DismissReason.timer) {
          location.href = '../view/viewsupplier.php';
        }
        location.href = '../view/viewsupplier.php';
      })
    </script>
  <?php else :  ?>
    <script>
      < script >
        Swal.fire({
          icon: 'success',
          title: 'Tidak Terdapat Data Supplier Yang di Perbarui',
          html: 'Anda akan diarahkan ke dalam viewsupplier...',
          timer: 10000,
          timerProgressBar: true,
          didOpen: () => {
            Swal.showLoading();
          }
        }).then((result) => {
          if (result.dismiss === Swal.DismissReason.timer) {
            location.href = '../view/viewsupplier.php';
          }
          location.href = '../view/viewsupplier.php';
        })
    </script>
  <?php endif; ?>
<?php endif; ?>

<?php
if ($_POST['update'] == 'karyawan') :
  var_dump($_POST);
  die;
  // idkaryawan 
  $idkaryawan = $_POST['idkaryawan'];
  // leveluser 
  $leveluser = $_POST['leveluser'];
  // namakaryawan 
  $leveluser = $_POST['namakaryawan'];
  // username 
  $username = $_POST['username'];
  // password 
  $password = $_POST['password'];
  // no telepon 
  $telp = $_POST['telp'];
  // alamat 
  $alamat = $_POST['alamat'];
?> <?php endif; ?>