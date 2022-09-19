<?php
$view = $_SESSION['view'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!-- Font Awesome -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://kit.fontawesome.com/a53653dcab.js" crossorigin="anonymous"></script>

  <!-- Sweet Alert -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.29/dist/sweetalert2.all.min.js"></script>


  <!-- Title and CSS for view dashboard and proses login -->
  <?php if ($view == 'dashboard' || $view == 'proses_login') : ?>
    <?php if ($view == 'proses_login') : ?>
      <link rel="stylesheet" href="assets/css/index.css">
      <title>Proses Login</title>
    <?php else : ?>
      <link rel="stylesheet" href="../assets/css/index.css">
      <title>Dashboard - Apotek Media Utama</title>
    <?php endif ?>

    <!-- Title and CSS for view proses_update and view logout -->
  <?php elseif ($view == 'proses_update' || $view == 'logout' || $view == 'proses_register') : ?>
    <title>Processing...</title>
    <?php if ($view == 'proses_update') : ?>
      <link rel="stylesheet" href="../assets/css/index.css">
    <?php else : ?>
      <link rel="stylesheet" href="assets/css/index.css">
    <?php endif; ?>

    <!-- Title and CSS for view login  -->
  <?php elseif ($view == 'login' || $view == 'register') : ?>
    <?php if ($view == 'login') : ?>
      <title>Login - Apotek Media Utama</title>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
      <link rel="stylesheet" href="assets/css/login.css">
    <?php endif; ?>
    <title>Register - Apotek Media Utama</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel="stylesheet" href="assets/css/login.css">

    <!-- Title and CSS for view pelanggan -->
  <?php elseif ($view == 'pelanggan') : ?>
    <title>Pelanggan - Apotek Media Utama</title>
    <link rel="stylesheet" href="../assets/css/index.css">
    <link rel="stylesheet" href="../assets/css/view.css">
    <link rel="stylesheet" href="../assets/css/pelanggan.css">

    <!-- Title and CSS for view updateform -->
  <?php elseif ($view == 'updateform') : ?>
    <title>Update - Apotek Media Utama</title>
    <link rel="stylesheet" href="../assets/css/index.css">
    <link rel="stylesheet" href="../assets/css/formupdate.css">

    <!-- Title and CSS for view supplier -->
  <?php elseif ($view == 'supplier') : ?>
    <title>Supplier - Apotek Media Utama</title>
    <link rel="stylesheet" href="../assets/css/index.css">
    <link rel="stylesheet" href="../assets/css/view.css">
    <link rel="stylesheet" href="../assets/css/supplier.css">

    <!-- Title and CSS for view karyawan -->
  <?php elseif ($view == 'karyawan') : ?>
    <title>Karyawan - Apotek Media Utama</title>
    <link rel="stylesheet" href="../assets/css/index.css">
    <link rel="stylesheet" href="../assets/css/view.css">
    <link rel="stylesheet" href="../assets/css/pelanggan.css">

    <!-- Title and CSS for view obat -->
  <?php elseif ($view == 'obat') : ?>
    <title>Obat - Apotek Media Utama</title>
    <link rel="stylesheet" href="../assets/css/index.css">
    <link rel="stylesheet" href="../assets/css/view.css">
  <?php endif ?>
</head>

<body id="body">