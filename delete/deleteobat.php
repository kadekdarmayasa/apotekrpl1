<?php
include '../app/koneksi.php';

$query = mysqli_query($conn, "DELETE FROM tb_obat WHERE idobat=" . $_GET['idobat']);

if (!mysqli_errno($conn)) {
  echo "<script>
          alert('Data berhasil dihapus');
          location.href='../view/viewobat.php';
        </script>";
} else {
  echo "Data gagal dihapus" . mysqli_error($conn);
}
