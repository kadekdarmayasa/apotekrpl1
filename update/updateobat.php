<?php
include '../app/koneksi.php';

$idobat = $_GET['idobat'];
$query = mysqli_query($conn, "SELECT * FROM tb_obat WHERE idobat=" . $idobat);

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
      <h2>Perbarui Data Obat</h2>
    </div>
    <?php while ($row = mysqli_fetch_assoc($query)) : ?>
      <input type="hidden" name="idobat" value="<?= $idobat ?>">
      <input type="hidden" name="update" value="obat">
      <div class="form-input">
        <select name="idsupplier" id="idsupplier">
          <?php
          $querySupplier = mysqli_query($conn, "SELECT idsupplier, perusahaan FROM tb_supplier");
          while ($rowSupplier = mysqli_fetch_assoc($querySupplier)) :
          ?>
            <?php if ($row['idsupplier'] == $rowSupplier['idsupplier']) : ?>
              <option selected value="<?= $rowSupplier['idsupplier']; ?>">
                <?= $rowSupplier['perusahaan']; ?>
              </option>
            <?php else : ?>
              <option value="<?= $rowSupplier['idsupplier']; ?>">
                <?= $rowSupplier['perusahaan']; ?>
              </option>
            <?php endif; ?>
          <?php endwhile; ?>
        </select>
      </div>
      <div class="form-input">
        <label for="namaobat">Nama Obat</label>
        <input type="text" name="namaobat" id="namaobat" value="<?= $row['namaobat'] ?>" required>
      </div>
      <div class="form-input">
        <label for="kategoriobat">Ketegori Obat</label>
        <input type="text" name="kategoriobat" id="kategoriobat" value="<?= $row['kategoriobat'] ?>" required>
      </div>
      <div class="form-input">
        <label for="hargajual">Harga Jual</label>
        <input type="number" name="hargajual" id="hargajual" value="<?= $row['hargajual'] ?>" required>
      </div>
      <div class="form-input">
        <label for="hargabeli">Harga Beli</label>
        <input type="number" name="hargabeli" id="hargabeli" value=<?= $row['hargabeli'] ?> required>
      </div>
      <div class="form-input">
        <label for="stokobat">Stok Obat</label>
        <input type="number" name="stokobat" id="stokobat" value=<?= $row['stok_obat'] ?> required>
      </div>
      <div class="form-input">
        <label for="keterangan">Keterangan</label>
        <textarea name="keterangan" id="keterangan" required><?= $row['keterangan']; ?></textarea>
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