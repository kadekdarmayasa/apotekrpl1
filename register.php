<?php
session_start();
if (!isset($_SESSION['userinfo']['username'])) {
  header('Location: login.php');
  exit;
}
$_SESSION['view'] = 'register';
?>

<?php include 'template/header.php' ?>


<div class="form">
  <div class="form-toggle"></div>
  <div class="form-panel one">
    <form action="proses_register.php" method="post">
      <div class="form-header">
        <h1>Account Register</h1>
      </div>
      <div class="form-content">
        <form>
          <div class="form-group">
            <label for="leveluser">Level User</label>
            <select name="leveluser" id="leveluser">
              <option value="user_admin">User Admin</option>
              <option value="user_karyawan">User Karyawan</option>
            </select>
          </div>
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required />
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required />
          </div>
          <div class="form-group">
            <label for="name">Nama Karyawan</label>
            <input type="name" id="name" name="name" required />
          </div>
          <div class="form-group">
            <label for="telp">No Telepon</label>
            <input type="number" id="telp" name="telp" required />
          </div>
          <div class="form-group">
            <label for="address">Alamat</label>
            <textarea id="address" name="address" rows="10" cols="10" required></textarea>
          </div>
          <div class="form-group">
            <button type="submit">Register</button>
          </div>
        </form>
      </div>
    </form>
  </div>
  <div class="form-panel two">
  </div>
</div>

<?php include 'template/footer.php' ?>