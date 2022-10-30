<?php
session_start();
include 'app/functions.php';
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
            <label for="idkaryawan">Nama Karyawan</label>
            <select name="idkaryawan" id="idkaryawan">
              <?php
              $hasilKaryawan = select("SELECT * FROM tb_karyawan WHERE idkaryawan NOT IN (SELECT idkaryawan FROM tb_login)");

              if (mysqli_num_rows($hasilKaryawan) > 0) :
              ?>
                <?php while ($row = mysqli_fetch_assoc($hasilKaryawan)) :  ?>
                  <option value="<?= $row['idkaryawan'] ?>"><?= $row['namakaryawan']; ?></option>
                <?php endwhile; ?>
              <?php else : ?>
                <option value="">Semua karyawan telah memiliki akun</option>
              <?php endif; ?>
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
            <label for="leveluser">Level User</label>
            <select name="leveluser" id="leveluser">
              <option value="user_admin">User Admin</option>
              <option value="user_karyawan">User Karyawan</option>
            </select>
          </div>
          <?php if (mysqli_num_rows($hasilKaryawan) > 0) : ?>
            <div class="form-group">
              <button type="submit">Register</button>
            </div>
          <?php else : ?>
            <div class="form-group">
              <button disabled style="cursor: none;">Register</button>
            </div>
          <?php endif; ?>
          <div class="form-group">
            <a href="index.php" class="back-dashboard-button">Kembali ke dashboard</a>
          </div>
        </form>
      </div>
    </form>
  </div>
</div>

<?php include 'template/footer.php' ?>