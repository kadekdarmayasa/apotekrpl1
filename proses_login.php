<?php
session_start();
include 'app/functions.php';

if (!isset($_POST['username'])) {
  header('Location: login.php');
  exit;
}

// Login Username dan Password
$login_username = $_POST['username'];
$login_password = $_POST['password'];

// Data user di database
$userData = selectSingleData("SELECT * FROM tb_login WHERE username='$login_username'");

$_SESSION['view'] = 'proses_login';
?>

<?php include 'template/header.php'; ?>

<?php if ($userData != null) : ?>
  <?php
  if (password_verify($login_password, $userData['password'])) :
    $userInfo = [
      "idkaryawan" => $userData['idkaryawan'],
      "username" => $login_username,
      "leveluser" => $userData['leveluser']
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
        text: 'Password anda salah!',
        width: '30em',
        icon: 'error',
        showConfirmButton: false
      }).then(() => {
        location.href = 'login.php';
      });
    </script>
  <?php endif; ?>
<?php else : ?>
  <script>
    Swal.fire({
      title: "Oops",
      text: 'Username anda belum terdaftar!',
      width: '30em',
      icon: 'error',
      showConfirmButton: false
    }).then(() => {
      location.href = 'login.php';
    });
  </script>
<?php endif; ?>

<?php include 'template/footer.php'; ?>