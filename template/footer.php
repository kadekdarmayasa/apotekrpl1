<?php
$view = $_SESSION['view'];
?>

<!-- Script for view obat -->
<?php if ($view == 'obat') : ?>
  <script src="../assets/js/viewobat.js"></script>
  <script src="../assets/js/action-buttons.js"></script>
  <script src="../assets/js/dropdown.js"></script>

  <!-- Script for view dashboard -->
<?php elseif ($view == 'dashboard') : ?>
  <script src="../assets/js/dropdown.js"></script>

  <!-- Script for view login -->
<?php elseif ($view == 'login') : ?>
  <script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script src='https://codepen.io/andytran/pen/vLmRVp.js'></script>
  <script src="assets/js/login.js"></script>

  <!-- Script for view pelanggan -->
<?php elseif ($view == 'pelanggan') : ?>
  <script src="../assets/js/action-buttons.js"></script>
  <script src="../assets/js/dropdown.js"></script>
  <script src="../assets/js/viewpelanggan.js"></script>

  <!-- Script for view supplier -->
<?php elseif ($view == 'supplier') : ?>
  <script src="../assets/js/dropdown.js"></script>
  <script src="../assets/js/action-buttons.js"></script>
  <script src="../assets/js/supplier.js"></script>

  <!-- Script for view karyawan -->
<?php elseif ($view == 'karyawan') : ?>
  <script src="../assets/js/dropdown.js"></script>
  <script src="../assets/js/action-buttons.js"></script>
  <script src="../assets/js/karyawan.js"></script>
<?php endif; ?>
</body>

</html>