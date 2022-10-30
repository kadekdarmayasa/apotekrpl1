<?php
include '../app/koneksi.php';
include '../app/functions.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Print Data Pelanggan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <style>
    @media print {
      .print {
        display: none;
      }
    }

    img {
      width: 250px;
      height: 100%;
      object-fit: cover;
    }
  </style>
</head>

<body>
  <div class="container d-flex flex-column mt-5">
    <div class="mx-auto mb-5">
      <button type="button" class="print btn btn-primary" onclick="window.print()">Cetak Data</button>
      <a href="viewpelanggan.php" class="print btn btn-danger">Kembali</a>
    </div>

    <div class="card">
      <div class="card-body">
        <table class="table table-hover">
          <thead class="text-center">
            <tr>
              <th>Id Pelanggan</th>
              <th>Nama Lengkap</th>
              <th>Alamat</th>
              <th>Telp</th>
              <th>Usia</th>
              <th>Foto Resep</th>
            </tr>
          </thead>
          <?php
          $query = select("SELECT * FROM tb_pelanggan");
          while ($row = mysqli_fetch_assoc($query)) :
          ?>
            <tbody>
              <td><?= $row['idpelanggan']; ?></td>
              <td><?= $row['namalengkap']; ?></td>
              <td><?= $row['alamat']; ?></td>
              <td><?= $row['telp']; ?></td>
              <td><?= $row['usia']; ?></td>
              <td>
                <img src="../assets/img/<?= $row['buktifotoresep']; ?>" alt="buktifotoresep" class="img-fluid">
              </td>
            </tbody>
          <?php endwhile; ?>
        </table>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>

</html>