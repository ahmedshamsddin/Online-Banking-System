<?php
session_start();
// Check if POST request is sent
if (isset($_POST['submit'])) {
  // Sanitize input
  $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
  $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
  // Require the LoginController and DB classes
  require_once("../libraries/DB.php");
  require_once("../libraries/LoginController.php");
  // Create a new LoginController object
  $login = new LoginController($username, $password);
  // Check the input
  $result = $login->checkInput();
  // If the input is correct, login the user
  if ($result == "password_correct") {
    $login->login();
  } elseif ($result == "no_user_found") {
  // If the no user is found, display an error message
    echo '<div class="alert alert-danger mt-2" role="alert">User not found!</div>';
  } else if ($result == "locked_account") {
  // If the password is incorrect, display an error message
    echo '<div class="alert alert-danger mt-2" role="alert">Your account is locked due to many attempts to login. Please contact the administration through this email: aziz_admin@turkish.com</div>';
  } else {
    echo '<div class="alert alert-danger mt-2" role="alert">Incorrect password!</div>';
  }
}
?>
<?php if (!isset($_SESSION['user_id'])) { ?>
<!DOCTYPE html>
<html>
<head>
  <title>Login - Banking System</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

  <link rel="stylesheet" type="text/css" href="../static/css/login.css">
</head>
<body>
  <div class="login-container">
    
    <h1>Login</h1>
    <form id="loginForm" method="POST">
      <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
      </div>
      <button type="submit" name="submit" class="login-button">Login</button>
      <span>Create account <a href="register.php">here</span>
    </form>
  </div>
</body>
</html>
<?php } else { 
  header("location: ../homepage/index.php");
} ?>
