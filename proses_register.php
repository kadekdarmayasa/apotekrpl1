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
$idkaryawan = $_POST['idkaryawan'];
$passwordRegis = password_hash($_POST['password'], PASSWORD_DEFAULT);

$matchingValues = select("SELECT * FROM tb_login WHERE username='$usernameRegis'");
if (mysqli_num_rows($matchingValues)) {
  $existUsername = true;
} else {
  insert("INSERT INTO tb_login(username, password, leveluser, idkaryawan) VALUES('$usernameRegis', '$passwordRegis', '$leveluser', '$idkaryawan')");
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
      title: 'Karyawan Berhasil Difaftarkan',
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