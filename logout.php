<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Logout</title>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.29/dist/sweetalert2.all.min.js"></script>
  <link rel="stylesheet" href="assets/css/index.css">
</head>

<body>
  <?php
  session_start();
  session_destroy();
  ?>

  <script>
    Swal.fire({
      text: "Anda Berhasil Logout",
      width: '30em',
      icon: 'success',
    }).then(() => {
      location.href = 'index.php';
    });
  </script>
</body>

</html>