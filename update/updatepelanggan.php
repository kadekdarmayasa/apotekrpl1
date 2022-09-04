<?php
include '../app/koneksi.php';

$idpelanggan = $_GET['idpelanggan'];
$query = mysqli_query($conn, "SELECT * FROM tb_pelanggan WHERE idpelanggan=" . $idpelanggan);

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
  <form action="proses_update.php" method="post" enctype="multipart/form-data">
    <div class="form-header">
      <h2>Perbarui Data Pelanggan</h2>
    </div>
    <?php while ($row = mysqli_fetch_assoc($query)) : ?>
      <input type="hidden" name="idpelanggan" value="<?= $idpelanggan ?>">
      <input type="hidden" name="update" value="pelanggan">
      <input type="hidden" name="oldfotoresep" value="<?= $row['buktifotoresep']  ?>">
      <div class="form-input">
        <label for="namalengkap">Nama</label>
        <input type="text" name="namalengkap" id="namalengkap" value="<?= $row['namalengkap'] ?>" required>
      </div>
      <div class="form-input">
        <label for="telp">No Telephone</label>
        <input type="number" name="telp" id="telp" value="<?= $row['telp'] ?>" required>
      </div>
      <div class="form-input">
        <label for="usia">Usia</label>
        <input type="number" name="usia" id="usia" value="<?= $row['usia'] ?>" required>
      </div>
      <div class="form-input">
        <label for="alamat">Alamat</label>
        <textarea name="alamat" id="alamat" required><?= $row['alamat']; ?></textarea>
      </div>
      <div class="form-input">
        <img src="../assets/img/<?= $row['buktifotoresep'] ?>" alt="fotoresep" width="250">
        <label for="fotoresep">Foto Resep</label>
        <input type="file" name="fotoresep" id="fotoresep">
      </div>
      <div class="form-buttons">
        <button type="submit" name="udpate-button">Perbarui</button>
        <?php $_SESSION['view'] = 'viewpelanggan'; ?>
        <a href="../view/viewpelanggan.php">Kembali</a>
      </div>
    <?php endwhile; ?>
  </form>
</div>

</body>

</html>