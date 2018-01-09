<?php
  // show potential errors / feedback (from registration object)
  if ($login->errors) {
      foreach ($login->errors as $error) {
          echo $error;
      }
  }
  if ($login->messages) {
      foreach ($login->messages as $message) {
          echo $message;
      }
  }
?>

<!-- register form -->
<form method="post" action="register.php" name="registerform">

    <label for="email">Email</label>
    <input id="email" type="text" name="email" required />

    <label for="password">Password</label>
    <input id="password"  type="password" name="password" autocomplete="off" required />

    <input type="submit"  name="register" value="Register" />

</form>

<!-- backlink -->
<a href="index.php">Back to Login Page</a>