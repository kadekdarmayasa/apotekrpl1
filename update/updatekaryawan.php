<?php
include '../app/koneksi.php';
include '../app/functions.php';

$idkaryawan = $_GET['idkaryawan'];
$query = select("SELECT * FROM tb_karyawan WHERE idkaryawan=$idkaryawan");

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

      <!-- Field Level User -->
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

      <!-- Field Nama Karyawan -->
      <div class="form-input">
        <label for="namakaryawan">Nama Karyawan</label>
        <input type="text" name="namakaryawan" id="namakaryawan" value="<?= $row['namakaryawan'] ?>" required>
      </div>

      <!-- Field No Telepone -->
      <div class="form-input">
        <label for="telp">No Telephone</label>
        <input type="number" name="telp" id="telp" value="<?= $row['telp'] ?>" required>
      </div>

      <!-- Field Alamat -->
      <div class="form-input">
        <label for="alamat">Alamat</label>
        <textarea name="alamat" id="alamat" required><?= $row['alamat']; ?></textarea>
      </div>


      <div class="form-buttons">
        <button type="submit" name="udpate-button">Perbarui</button>
        <?php $_SESSION['view'] = 'viewobat'; ?>
        <a href="../view/viewkaryawan.php">Kembali</a>
      </div>
    <?php endwhile; ?>
  </form>
</div>
</body>

</html>