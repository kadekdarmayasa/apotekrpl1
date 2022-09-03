<?php
include '../app/koneksi.php';
if (isset($_GET['key'])) {
  $keyword = $_GET['key'];
  $queryObat = mysqli_query($conn, "SELECT * FROM tb_obat WHERE namaobat LIKE '%$keyword%'");
  if (mysqli_num_rows($queryObat) == 0) {
    $isEmptyResult = true;
  }
} else {
  $queryObat = mysqli_query($conn, "SELECT * FROM tb_obat ORDER BY idobat DESC");
}

?>

<?php if (@$isEmptyResult) : ?>
  <p>Obat yang anda cari tidak ada.</p>
<?php else : ?>
  <?php
  while ($row = mysqli_fetch_assoc($queryObat)) :
    $idsupplier = $row['idsupplier'];
    $keterangan = $row['keterangan'];
    $nama_obat = $row['namaobat'];
    $idobat = $row['idobat'];
    $kategori_obat = $row['kategoriobat'];
    $harga_jual = $row['hargajual'];
    $harga_beli = $row['hargabeli'];
    $stok_obat = $row['stok_obat'];
  ?>
    <div class="card">
      <div class="card-header">
        <div class="title">
          <h3 class="nama-obat"><?= $nama_obat; ?></h3>
          <p class="kategori-obat"><?= strtolower($kategori_obat); ?></p>
        </div>
        <div class="button-menu">
          <i class="fa-solid fa-ellipsis-vertical"></i>
        </div>
        <div class="actions">
          <a href="?idobat=<?= $idobat; ?>">
            <i class="fa-solid fa-trash-can"></i>
            Delete
          </a>
          <a href="../update/updateobat.php?idobat=<?= $idobat ?>" class="update">
            <i class=" fa-solid fa-pen-to-square"></i>
            Update
          </a>
          <a class="detail" data-keterangan="<?= $keterangan ?>" data-namaobat="<?= $nama_obat ?>" data-kategoriobat="<?= $kategori_obat ?>" data-hargabeli="<?= $harga_beli ?>" data-hargajual="<?= $harga_jual ?>" data-stokobat="<? $stok_obat ?>">
            <i class="fa-solid fa-info"></i>
            Detail
          </a>
        </div>
      </div>
      <div class="price-stok">
        <div class="hargajual">
          <h5>Harga</h5>
          <p>Rp. <?= $harga_jual; ?></p>
        </div>
        <div class="stok-obat">
          <h5>Stok</h5>
          <p><?= $stok_obat; ?></p>
        </div>
      </div>
    </div>
  <?php endwhile; ?>
<?php endif; ?>