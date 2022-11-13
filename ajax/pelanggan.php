  <?php
  include '../app/koneksi.php';
  include '../app/functions.php';

  if (isset($_GET['key'])) {
    $keyword = $_GET['key'];
    $queryPelanggan = search('tb_pelanggan', 'namalengkap', $keyword);
    if (mysqli_num_rows($queryPelanggan) == 0) $isEmptyResult = true;
  } else {
    $queryPelanggan = mysqli_query($conn, "SELECT * FROM tb_pelanggan");
  }
  ?>

  <?php if (@$isEmptyResult) : ?>
    <p>Pelanggan dengan nama <b><?= $keyword ?></b> tidak ada di dalam daftar.</p>
  <?php else : ?>
    <?php while ($row = mysqli_fetch_assoc($queryPelanggan)) : ?>
      <div class="card">
        <!-- Card Header -->
        <div class="card-header">
          <div class="title">
            <h3 class="nama-pelanggan"><?= $row['namalengkap']; ?></h3>
          </div>
          <div class="button-menu">
            <i class="fa-solid fa-ellipsis-vertical"></i>
          </div>
          <div class="actions">
            <a id="delete-btn" data-idpelanggan="<?= $row['idpelanggan']; ?>" data-name="idpelanggan">
              <i class=" fa-solid fa-trash-can"></i>
              Delete
            </a>
            <a href="../update/updatepelanggan.php?idpelanggan=<?= $row['idpelanggan']  ?>" class="update">
              <i class=" fa-solid fa-pen-to-square"></i>
              Update
            </a>
            <a href="" class="foto-resep" data-fotoresep="<?= $row['buktifotoresep'] ?>">
              <i class="fa-solid fa-image"></i>
              Foto Resep
            </a>
          </div>
        </div>
        <!-- Akhir Card Header -->

        <hr>

        <!-- Card Body -->
        <div class="card-body">
          <div class="first-item">
            <div class="phone">
              <p>No Telephone</p>
              <h4><?= $row['telp']; ?></h4>
            </div>
            <div class="age">
              <p>Usia</p>
              <h4><?= $row['usia']; ?></h4>
            </div>
            <div class="id-customer">
              <p>Id</p>
              <h4><?= $row['idpelanggan']; ?></h4>
            </div>
          </div>
          <div class="address">
            <h4>Alamat</h4>
            <p><?= $row['alamat']; ?></p>
          </div>
        </div>
        <!-- Akhir Card Body -->
      </div>
    <?php endwhile; ?>
  <?php endif; ?>