<?php
session_start();
$_SESSION['view'] = 'login';
?>

<?php include 'template/header.php' ?>

<form action="proses_login.php" method="post">
  <div class="form">
    <div class="form-toggle"></div>
    <div class="form-panel one">
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
    </div>
    <div class="form-panel two">
      <div class="form-header">
        <h1>Register Account</h1>
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
            <label for="cpassword">Confirm Password</label>
            <input type="password" id="cpassword" name="cpassword" required />
          </div>
          <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" required />
          </div>
          <div class="form-group">
            <button type="submit">Register</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</form>

<?php include 'template/footer.php' ?>