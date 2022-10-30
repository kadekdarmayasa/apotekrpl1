<?php
include 'koneksi.php';

function getUserDetails($query, $user)
{
  global $conn;
  while ($row = mysqli_fetch_assoc($query)) {
    if ($row['idkaryawan'] == $user['idkaryawan']) {
      return $row;
    }
  }
}

function getNumRows($query)
{
  global $conn;
  return mysqli_num_rows(mysqli_query($conn, $query));
}


function setLevelUser($leveluser)
{
  return $leveluser == 'admin' ?  'admin' :  'karyawan';
}

function getLevelUser($leveluser)
{
  return setLevelUser($leveluser);
}

function select($query)
{
  global $conn;
  return mysqli_query($conn, $query);
}

function selectSingleData($query)
{
  global $conn;
  return mysqli_fetch_assoc(mysqli_query($conn, $query));
}

function delete($query)
{
  global $conn;
  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}

function insert($query)
{
  global $conn;
  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}

function update($query)
{
  global $conn;
  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}

function upload()
{
  // file name akan berisi nama file gambar yang di upload berserta extensinya 
  $file_name = $_FILES['fotoresep']['name'];
  // file size akan berisi ukuran file gambar yang di upload
  $file_size = $_FILES['fotoresep']['size'];
  $error = $_FILES['fotoresep']['error'];
  // tempat penyimpanan sementara 
  $tmp_name = $_FILES['fotoresep']['tmp_name'];

  // cek apakah gambar sudah di upload
  if ($error === 4) {
    echo "<script>
                alert('Upload gambar terlebih dahulu');
            </script>";
    return false;
  }

  // cek apakah yang di upload gambar 
  $file_extension = ['jpg', 'jpeg', 'png'];
  // memecah kedua buah string menjadi array dengan tanda pemisah tertentu 
  // contoh jika nama filenya adalah vivo1930.png dengan fungsi explode maka akan menjadi seperti ['vivo1930', 'png']
  $image_extension = explode('.', $file_name);
  // mengambil elemen yang palih akhir 
  $image_extension = strtolower(end($image_extension));

  if (!in_array($image_extension, $file_extension)) {
    echo "<script>
                alert('Yang anda upload bukan gambar');
            </script>";
    return false;
  }

  // cek jika ukuran gambar terlalu besar 
  // ukuran file dalam bit, jika dia megabite maka 2
  if ($file_size > 2000000) {
    echo "<script>
                alert('Ukuran File Terlalu Besar');
            </script>";
    return false;
  }

  // lolos pengecekan gambar akan di upload
  // generate nama gambar baru 
  $name_file_new = uniqid(); // akan membakitkan string random
  $name_file_new .= '.' . $image_extension;

  move_uploaded_file($tmp_name, "../assets/img/" . $name_file_new);

  return $name_file_new;
}

function search($tableName, $condition, $keyword)
{
  global $conn;
  $querySearch = mysqli_query($conn, "SELECT * FROM $tableName WHERE $condition LIKE '%$keyword%'");
  return $querySearch;
}
