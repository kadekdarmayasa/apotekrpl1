<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://kit.fontawesome.com/a53653dcab.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="./assets/css/login.css">
  <title>Login - Apotek Media Utama</title>
</head>

<body>
  <div class="container">
    <div class="banner">
      <i class="fa-solid fa-briefcase-medical"></i>
      <h1>Apotek Media Utama</h1>
      <p>Selalu memberikan pelayanan yang terbaik kepada pelanggan</p>
    </div>
    <form action="proses_login.php" method="post">
      <div class="form-header">
        <h2>Login</h2>
        <p>Belum punya akun? <a href="">Daftar</a></p>
      </div>
      <div class="form-input">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" autofocus>
      </div>
      <div class="form-input">
        <label for="username">Password</label>
        <input type="password" name="password" id="password">
      </div>
      <div class="form-input">
        <button type="submit">Login</button>
      </div>
    </form>
  </div>
</body>

</html>