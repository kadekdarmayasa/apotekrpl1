<?php
$view = $_SESSION['view'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://kit.fontawesome.com/a53653dcab.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.29/dist/sweetalert2.all.min.js"></script>
  <?php if ($view == 'dashboard') : ?>
    <title>Dashboard - Apotek Media Utama</title>
    <link rel="stylesheet" href="../assets/css/index.css">
  <?php elseif ($view == 'pelanggan') : ?>
    <title>Pelanggan - Apotek Media Utama</title>
    <link rel="stylesheet" href="../assets/css/index.css">
    <link rel="stylesheet" href="../assets/css/view.css">
    <link rel="stylesheet" href="../assets/css/pelanggan.css">
  <?php elseif ($view == 'updateform') : ?>
    <title>Update - Apotek Media Utama</title>
    <link rel="stylesheet" href="../assets/css/index.css">
    <link rel="stylesheet" href="../assets/css/formupdate.css">
  <?php elseif ($view == 'supplier') : ?>
    <title>Supplier - Apotek Media Utama</title>
    <link rel="stylesheet" href="../assets/css/index.css">
    <link rel="stylesheet" href="../assets/css/view.css">
    <link rel="stylesheet" href="../assets/css/supplier.css">
  <?php elseif ($view == 'karyawan') : ?>
    <title>Karyawan - Apotek Media Utama</title>
    <link rel="stylesheet" href="../assets/css/index.css">
    <link rel="stylesheet" href="../assets/css/view.css">
    <link rel="stylesheet" href="../assets/css/pelanggan.css">
  <?php else : ?>
    <title>Obat - Apotek Media Utama</title>
    <link rel="stylesheet" href="../assets/css/index.css">
    <link rel="stylesheet" href="../assets/css/view.css">
  <?php endif ?>
</head>

<body id="body">