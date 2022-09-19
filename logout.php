<?php $_SESSION['view'] = 'logout'; ?>
<?php include 'template/header.php' ?>

<script>
  Swal.fire({
    icon: 'success',
    title: 'Anda Berhasil Logout',
    html: 'Sedang diproses...',
    timer: 3000,
    timerProgressBar: true,
    showConfirmButton: false,
    didOpen: () => {
      Swal.showLoading();
    }
  }).then((result) => {
    if (result.dismiss === Swal.DismissReason.timer) {
      location.href = 'login.php';
    }
    location.href = 'login.php';
  })
</script>

<?php include 'template/footer.php' ?>

<?php
session_start();
session_destroy();
?>