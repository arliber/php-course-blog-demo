<?php
// show potential errors / feedback (from login object)
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

<!-- login form box -->
<form method="post" action="index.php" name="loginform">

    <label for="email">Email</label>
    <input id="email" type="text" name="email" required />

    <label for="password">Password</label>
    <input id="password"  type="password" name="password" autocomplete="off" required />

    <input type="submit"  name="login" value="Log in" />

</form>

<a href="register.php">Register new account</a>