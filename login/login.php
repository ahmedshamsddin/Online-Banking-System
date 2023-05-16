<!DOCTYPE html>
<html>
<head>
  <title>Login - Banking System</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  
  <div class="login-container">
    <h1>Login</h1>
    <form id="loginForm">
      <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
      </div>
      <button type="submit" class="login-button">Login</button>
    </form>
  </div>

  <script src="script.js"></script>
</body>
</html>
