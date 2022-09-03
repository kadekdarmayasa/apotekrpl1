<?php
session_start();

include "app/koneksi.php";

$username = $_POST['username'];
$password = $_POST['password'];

$query = "SELECT * FROM tb_login where username='$username' AND password='$password'";

$hasil = mysqli_query($conn, $query);
$rows = mysqli_num_rows($hasil);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.29/dist/sweetalert2.all.min.js"></script>
  <link rel="stylesheet" href="assets/css/index.css">
  <title>Proses Login</title>
</head>

<body>
  <?php
  if ($rows) :
    $_SESSION['username'] = $username;
    $_SESSION['idkaryawan'] = mysqli_fetch_assoc($hasil)['idkaryawan'];
    header('Location: index.php');
    exit;
  ?>
  <?php else : ?>
    <script>
      Swal.fire({
        text: "username atau password salah",
        width: '30em',
        icon: 'warning',
      }).then(() => {
        location.href = 'login.php';
      });
    </script>
  <?php endif; ?>
</body>

</html>