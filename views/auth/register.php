<?php require('../layout/headerWithLogin.php');
session_start();
if(isset($_SESSION["PasswordError"])) {
    $PasswordError=$_SESSION["PasswordError"];
    session_destroy();
}

?>

<form action="../../controllers/auth/register.php" method="post">
  <div class="form">
    <h1>Create an account</h1>
      <?php
      if (isset($PasswordError)){
          ?>
          <div class="warning">
          <p>Passwords do not Match!</p>
            </div>
          <?php
      }
      ?>
    <input type="text" placeholder="User Name" name="username" required />
    <br>
    <input type="email" placeholder="Email" name="email" required />
    <br>
    <input type="password" placeholder="Password" name="password" autocomplete="new-password" required />
    <br>
    <input type="password" placeholder="Confirm Password" name="confirmpassword" autocomplete="new-password" required />
    <br>
    <button class="btn btn-info">Register</button>
      <p class="message">Already registered? <a href="login.php">Sign In</a></p>
  </div>
</form>

<?php
require ("../layout/footer.php")
?>
