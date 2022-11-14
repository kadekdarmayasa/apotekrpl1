  <?php
  session_start();
  include '../app/koneksi.php';
  include '../app/functions.php';

  if (isset($_GET['key'])) {
    $keyword = $_GET['key'];
    $queryTransaksi = search('tb_transaksi', 'tgltransaksi', $keyword);
    if (mysqli_num_rows($queryTransaksi) == 0) {
      $isEmptyResult = true;
    }
  } else {
    $queryTransaksi = mysqli_query($conn, "SELECT * FROM tb_transaksi ORDER BY idtransaksi DESC");
  }
  ?>

  <?php if (@$isEmptyResult) : ?>
    <p>Transaksi yang anda cari tidak ada.</p>
  <?php else : ?>
    <?php
    while ($row = mysqli_fetch_assoc($queryTransaksi)) :
      $tgl_transaksi = $row['tgltransaksi'];
      $kategori_pelanggan = $row['kategoripelanggan'];
      $id_karyawan = $row['idkaryawan'];
      $id_pelanggan = $row['idpelanggan'];
      $id_transaksi = $row['idtransaksi'];
      $total_bayar = number_format($row['totalbayar'], 0, ',', '.');
      $bayar =  number_format($row['bayar'], 0, ',', '.');
      $kembali =  number_format($row['kembali'], 0, ',', '.');
    ?>
      <div class="card">
        <!-- Card Header -->
        <div class="card-header">
          <div class="title">
            <h3 class="tgl-transaksi"><?= $tgl_transaksi; ?></h3>
            <p class="kategori-pelanggan"><?= $kategori_pelanggan ?></p>
          </div>
          <div class="button-menu">
            <i class="fa-solid fa-ellipsis-vertical"></i>
          </div>
          <div class="actions">
            <?php if ($_SESSION['userinfo']['leveluser'] != 'user_karyawan') :  ?>
              <a id="delete-btn" data-name="idtransaksi" data-id_transaksi="<?= $id_transaksi ?>">
                <i class="fa-solid fa-trash-can"></i>
                Delete
              </a>
            <?php endif; ?>
            <a class="detail" href="../tambah/tambah-detail-transaksi.php?idtransaksi=<?= $id_transaksi ?>">
              <i class="fa-solid fa-info"></i>
              Detail
            </a>
          </div>
        </div>
        <!-- Akhir Card Header -->

        <!-- Card Body -->
        <div class="price-stok">
          <div class="bayar">
            <h5>Bayar</h5>
            <p>Rp. <?= $bayar ?></p>
          </div>
          <div class="kembali">
            <h5>Kembali</h5>
            <p>Rp. <?= $kembali ?></p>
          </div>
          <!-- Akhir Card Body -->
        </div>
      </div>
    <?php endwhile; ?>
  <?php endif; ?>