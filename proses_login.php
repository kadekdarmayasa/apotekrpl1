<?php
if (!isset($_POST['username'])) {
  header('Location: login.php');
  exit;
}

session_start();
include 'app/functions.php';

$login_username = $_POST['username'];
$hash_pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

$_SESSION['view'] = 'proses_login';
?>

<?php include 'template/header.php'; ?>

<?php
if (password_verify($_POST['password'], $hash_pass)) :
  $hasil = select("SELECT * FROM tb_login WHERE username='$login_username'");
  $row = mysqli_fetch_assoc($hasil);

  $userInfo = [
    "idkaryawan" => $row['idkaryawan'],
    "username" => $login_username,
    "leveluser" => $row['leveluser']
  ];
  $_SESSION['userinfo'] = $userInfo;

  $namakaryawan = selectSingleData("SELECT namakaryawan FROM tb_karyawan WHERE idkaryawan=" . $userInfo['idkaryawan'])['namakaryawan'];
?>
  <script>
    Swal.fire({
      title: "Selamat Datang " + "<?= $namakaryawan ?>",
      text: 'Anda akan diarahkan ke dashboard...',
      width: '30em',
      icon: 'success',
      timer: 5000,
      timerProgressBar: true,
      showConfirmButton: false,
      didOpen: () => {
        Swal.showLoading();
      }
    }).then(() => {
      location.href = 'index.php';
    });
  </script>
<?php else : ?>
  <script>
    Swal.fire({
      title: "Oops",
      text: 'Username dan Password anda salah',
      width: '30em',
      icon: 'error',
      showConfirmButton: false
    }).then(() => {
      location.href = 'login.php';
    });
  </script>
<?php endif; ?>

<?php include 'template/footer.php'; ?>