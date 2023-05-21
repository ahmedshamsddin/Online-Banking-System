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
      <form action="login.php" method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
      </form>
      <?php
        if (isset($_GET['error'])) {
          $error = $_GET['error'];
          if ($error === 'invalid_credentials') {
            echo '<p class="error-message">Invalid username or password</p>';
          }
        }
      ?>
    </div>
  </div>
</body>
</html>