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
  <title>Print Data Obat</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <style>
    @media print {
      .print {
        display: none;
      }
    }
  </style>
</head>

<body>
  <div class="container d-flex flex-column mt-5">
    <div class="mx-auto mb-5">
      <button type="button" class="print btn btn-primary" onclick="window.print()">Cetak Data</button>
      <a href="viewobat.php" class="print btn btn-danger">Kembali</a>
    </div>

    <div class="card">
      <div class="card-body">
        <table class="table table-hover">
          <thead class="text-center">
            <tr>
              <th>Id Obat</th>
              <th>Id Supplier</th>
              <th>Nama Obat</th>
              <th>Kategori Obat</th>
              <th>Harga Jual</th>
              <th>Harga Beli</th>
              <th>Stok Obat</th>
              <th>Keterangan</th>
            </tr>
          </thead>
          <?php
          $query = select("SELECT * FROM tb_obat");
          while ($row = mysqli_fetch_assoc($query)) :
          ?>
            <tbody>
              <td><?= $row['idobat']; ?></td>
              <td><?= $row['idsupplier']; ?></td>
              <td><?= $row['namaobat']; ?></td>
              <td><?= $row['kategoriobat']; ?></td>
              <td><?= $row['hargajual']; ?></td>
              <td><?= $row['hargabeli']; ?></td>
              <td><?= $row['stok_obat']; ?></td>
              <td><?= $row['keterangan']; ?></td>
            </tbody>
          <?php endwhile; ?>
        </table>
      </div>
    </div>

  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>

</html>