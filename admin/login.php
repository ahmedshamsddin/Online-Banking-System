<?php
  session_start();
  // Check if a user account is already logged in
  if (isset($_SESSION['user_id'])) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
  }
  // Check if post request is sent
  if (isset($_POST['submit'])) {
    // Filter the username and password to prevent XSS attacks
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

    require_once '../libraries/DB.php';
    // Get the username from the database (? is used to prevent SQL injection)
    $db = new DB();
    $sql = "SELECT username FROM admins WHERE username = ?";
    $stmt = $db->connect()->prepare($sql);
    if(!$stmt->execute(array($username))) {
      $stmt = null;
      exit();
    };
    // Check if the username exists
    if ($stmt->rowCount() > 0) {
      $sql = "SELECT pwd_hash FROM admins WHERE username = ?";
      $stmt = $db->connect()->prepare($sql);
      if(!$stmt->execute(array($username))) {
        $stmt = null;
        exit();
      };
      $hash = $stmt->fetchAll(PDO::FETCH_ASSOC)[0]["pwd_hash"];
      // Check if the password is correct
      if (password_verify($password, $hash)) {
        session_start();
        $_SESSION['admin'] = $username;
        header('location: dashboard.php');
      } else {
        echo "<script>alert('Incorrect password')</script>";
      }
    } else {
      echo "<script>alert('Incorrect username')</script>";
    }
  }
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin Login</title>
  <style>
    /* CSS styles for the login page */
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    .container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .login-card {
      width: 300px;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .login-card h2 {
      margin-top: 0;
      margin-bottom: 10px;
      font-size: 18px;
    }

    .login-card input[type="text"],
    .login-card input[type="password"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .login-card button {
      width: 100%;
      padding: 10px;
      background-color: #333;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .login-card button:hover {
      background-color: #555;
    }

    .error-message {
      color: red;
      margin-top: 10px;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="login-card">
      <h2>Admin Login</h2>
      <form method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="submit">Login</button>
      </form>
    </div>
  </div>
</body>
</html>