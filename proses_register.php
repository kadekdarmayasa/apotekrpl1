<?php
session_start();
include 'app/functions.php';

if ($_SESSION['view'] != 'register') {
  header('Location: register.php');
  exit;
}
$_SESSION['view'] = 'proses_register';
$leveluser = $_POST['leveluser'];
$usernameRegis = $_POST['username'];
$passwordRegis = password_hash($_POST['password'], PASSWORD_DEFAULT);
$namakaryawan = $_POST['name'];
$noTelp = $_POST['telp'];
$alamat = $_POST['address'];

$matchingValues = select("SELECT * FROM tb_login WHERE username='$usernameRegis'");
if (mysqli_num_rows($matchingValues)) {
  $existUsername = true;
} else {
  $insert_to_karyawan = insert("INSERT INTO tb_karyawan(idkaryawan, namakaryawan, alamat, telp) VALUES (null, '$namakaryawan', '$alamat', $noTelp)");
  $last_id = mysqli_insert_id($conn);

  $query_to_login = insert("INSERT INTO tb_login(username, password, leveluser, idkaryawan) VALUES('$usernameRegis', '$passwordRegis', '$leveluser', $last_id)");
  $successRegis = true;
}

?>

<?php include 'template/header.php' ?>

<script>
  const backToDashboard = (_) => {
    location.href = 'index.php';
  };

  const backToRegister = (_) => {
    location.href = 'register.php';
  };
</script>

<?php if (isset($existUsername)) : ?>
  <script>
    Swal.fire({
      icon: 'error',
      title: 'Oops',
      text: 'Username sudah terdaftar!',
      showConfirmButton: false,
    }).then(backToRegister);
  </script>
<?php endif; ?>

<?php if (isset($successRegis)) : ?>
  <script>
    Swal.fire({
      icon: 'success',
      title: 'Karyawan Berhasil Ditambahkan',
      text: 'Anda akan diarahkan ke dashboard...',
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
      didOpen: () => {
        Swal.showLoading();
      }
    }).then(backToDashboard);
  </script>
<?php endif; ?>

<?php include 'template/footer.php' ?>