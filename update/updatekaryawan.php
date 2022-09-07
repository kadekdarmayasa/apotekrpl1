<?php
include '../app/koneksi.php';

$idkaryawan = $_GET['idkaryawan'];
$query = select($conn, "SELECT * FROM tb_karyawan INNERN JOIN tb_login USING(idkaryawan) WHERE idkaryawan=" . $idkaryawan);
?>

<?php
session_start();
$_SESSION['view'] = 'updateform';
include '../template/header.php';
?>
<div class="container">
  <div class="banner">
    <i class="fa-solid fa-briefcase-medical"></i>
    <h1>Apotek <span>Media Utama</span></h1>
  </div>
  <form action="proses_update.php" method="post">
    <div class="form-header">
      <h2>Perbarui Data Karyawan</h2>
    </div>
    <?php while ($row = mysqli_fetch_assoc($query)) : ?>
      <input type="hidden" name="idkaryawan" value="<?= $idkaryawan ?>">
      <input type="hidden" name="update" value="karyawan">
      <?php
      $leveluser = [];
      $allLevelUser = mysqli_query($conn, "SELECT leveluser FROM tb_login");
      while ($rowLevelUser = mysqli_fetch_row($allLevelUser)) {
        $currentValue = $rowLevelUser[0];
        if (count($leveluser) == 0) {
          array_push($leveluser, $currentValue);
        } else {
          if (!in_array($currentValue, $leveluser)) {
            array_push($leveluser, $currentValue);
          }
        }
      }
      ?>
      <div class="form-input">
        <select name="leveluser" id="leveluser">
          <?php foreach ($leveluser as $lvl) : ?>
            <?php if ($lvl == $row['leveluser']) : ?>
              <option selected value="leveluser"><?php echo $lvl ?></option>
            <?php else : ?>
              <option value="leveluser"><?php echo $lvl ?></option>
            <?php endif; ?>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="form-input">
        <label for="namakaryawan">Nama Karyawan</label>
        <input type="text" name="namakaryawan" id="namakaryawan" value="<?= $row['namakaryawan'] ?>" required>
      </div>
      <div class="form-input">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" value="<?= $row['username'] ?>" required>
      </div>
      <div class="form-input">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" value="<?= $row['password'] ?>" required>
      </div>
      <div class="form-input">
        <label for="telp">No Telephone</label>
        <input type="number" name="telp" id="telp" value="<?= $row['telp'] ?>" required>
      </div>
      <div class="form-input">
        <label for="alamat">Alamat</label>
        <textarea name="alamat" id="alamat" required><?= $row['alamat']; ?></textarea>
      </div>
      <div class="form-buttons">
        <button type="submit" name="udpate-button">Perbarui</button>
        <?php $_SESSION['view'] = 'viewobat'; ?>
        <a href="../view/viewobat.php">Kembali</a>
      </div>
    <?php endwhile; ?>
  </form>
</div>
</body>

</html>