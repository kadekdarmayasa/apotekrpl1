  <?php
  include '../app/koneksi.php';
  if (isset($_GET['key'])) {
    $keyword = $_GET['key'];
    $queryKaryawan = mysqli_query($conn, "SELECT * FROM tb_karyawan WHERE namakaryawan LIKE '%$keyword%'");
    if (mysqli_num_rows($queryKaryawan) == 0) {
      $isEmptyResult = true;
    }
  } else {
    $queryKaryawan = mysqli_query($conn, "SELECT * FROM tb_karyawan");
  }
  ?>

  <?php if (@$isEmptyResult) : ?>
    <p>Karyawan yang anda cari tidak ada.</p>
  <?php else : ?>
    <?php while ($row = mysqli_fetch_assoc($queryKaryawan)) : ?>
      <div class="card">
        <div class="card-header">
          <div class="title">
            <h3 class="nama"><?= $row['namakaryawan']; ?></h3>
          </div>
          <div class="button-menu">
            <i class="fa-solid fa-ellipsis-vertical"></i>
          </div>
          <div class="actions">
            <a onclick='confirmation(<?= $row["idkaryawan"] ?>)'>
              <i class=" fa-solid fa-trash-can"></i>
              Delete
            </a>
            <a href="../update/updatekaryawan.php?idkaryawan=<?= $row['idkaryawan']  ?>" class="update">
              <i class=" fa-solid fa-pen-to-square"></i>
              Update
            </a>
          </div>
        </div>
        <hr>
        <div class="card-body">
          <div class="first-item">
            <div class="phone">
              <p>No Telephone</p>
              <h4><?= $row['telp']; ?></h4>
            </div>
            <div class="id-user">
              <p>Id</p>
              <h4><?= $row['idkaryawan']; ?></h4>
            </div>
          </div>
          <div class="address">
            <h4>Alamat</h4>
            <p><?= $row['alamat']; ?></p>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
  <?php endif; ?>