<?php
include '../app/koneksi.php';

$idsupplier = $_GET['idsupplier'];
$query = mysqli_query($conn, "SELECT * FROM tb_supplier WHERE idsupplier=" . $idsupplier);

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
      <h2>Perbarui Data Supplier</h2>
    </div>
    <?php while ($row = mysqli_fetch_assoc($query)) : ?>
      <input type="hidden" name="idsupplier" value="<?= $idsupplier ?>">
      <input type="hidden" name="update" value="supplier">
      <div class="form-input">
        <label for="perusahaan">Nama Perusahaan</label>
        <input type="text" name="perusahaan" id="perusahaan" value="<?= $row['perusahaan'] ?>" required>
      </div>
      <div class="form-input">
        <label for="keterangan">Deskripsi Singkat Perusahaan</label>
        <textarea name="keterangan" id="keterangan" required><?= $row['keterangan']; ?></textarea>
      </div>
      <div class="form-buttons">
        <button type="submit" name="udpate-button">Perbarui</button>
        <?php $_SESSION['view'] = 'supplier'; ?>
        <a href="../view/viewsupplier.php">Kembali</a>
      </div>
    <?php endwhile; ?>
  </form>
</div>
</body>

</html>