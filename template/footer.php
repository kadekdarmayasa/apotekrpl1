<?php
$view = $_SESSION['view'];
?>

<?php if ($view == 'viewobat') : ?>
  <script src="../assets/js/viewobat.js"></script>
  <script src="../assets/js/action-buttons.js"></script>
  <script src="../assets/js/dropdown.js"></script>
<?php elseif ($view == 'dashboard') : ?>
  <script src="../assets/js/dropdown.js"></script>
<?php elseif ($view == 'pelanggan') : ?>
  <script src="../assets/js/action-buttons.js"></script>
  <script src="../assets/js/dropdown.js"></script>
  <script src="../assets/js/viewpelanggan.js"></script>
<?php elseif ($view == 'supplier') : ?>
  <script src="../assets/js/dropdown.js"></script>
  <script src="../assets/js/action-buttons.js"></script>
  <script src="../assets/js/supplier.js"></script>
<?php elseif ($view == 'karyawan') : ?>
  <script src="../assets/js/dropdown.js"></script>
  <script src="../assets/js/action-buttons.js"></script>
  <script src="../assets/js/karyawan.js"></script>
<?php endif; ?>
</body>

</html>