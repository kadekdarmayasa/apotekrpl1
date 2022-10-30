<?php
session_start();
$_SESSION['view'] = 'login';
?>

<?php include 'template/header.php' ?>

<div class="form">
  <div class="form-toggle"></div>
  <div class="form-panel one">
    <form action="proses_login.php" method="post">
      <div class="form-header">
        <h1>Account Login</h1>
      </div>
      <div class="form-content">
        <form>
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required />
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required />
          </div>
          <div class="form-group">
            <label class="form-remember">
              <input type="checkbox" />Remember Me
            </label><a class="form-recovery" href="#">Forgot Password?</a>
          </div>
          <div class="form-group">
            <button type="submit">Log In</button>
          </div>
        </form>
      </div>
    </form>
  </div>
  <div class="form-panel two">
  </div>
</div>

<?php include 'template/footer.php' ?>