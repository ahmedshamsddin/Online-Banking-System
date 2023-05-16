

<!DOCTYPE html>
<html>
<head>
  <title>Register - Banking System</title>
  <link rel="stylesheet" type="text/css" href="styl.css">
  <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>jQuery UI Datepicker - Default functionality</title>
    <link
      rel="stylesheet"
      href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css"
    />
    <link rel="stylesheet" href="/resources/demos/style.css" />
</head>
<body>
  <div class="register-container">
    <h1>Register</h1>
    <form id="registerForm">
      <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
      </div>
      <div class="form-group">
        <label for="firstName">First Name:</label>
        <input type="text" id="firstName" name="firstName" required>
      </div>
      <div class="form-group">
        <label for="lastName">Last Name:</label>
        <input type="text" id="lastName" name="lastName" required>
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
      </div>
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
      </div>
      <div class="form-group">
        <label for="idNumber">ID Number:</label>
        <input type="text" id="idNumber" name="idNumber" required>
      </div>
      <div class="form-group">
      <p>Date: <input type="text" id="datepicker" /></p>
      </div>
      <div class="form-group">
        <label for="telephone">Telephone Number:</label>
        <input type="tel" id="telephone" name="telephone" required>
      </div>
      <div class="form-group">
        <label for="photo">Personal Photo:</label>
        <input type="file" id="photo" name="photo">
      </div>
      <button type="submit" class="register-button">Register</button>
      <p id="errorMessage" class="error-message"></p>
      <p id="successMessage" class="success-message"></p>
    </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="scrio.js"></script>
    <script>
      $(function () {
        $("#datepicker").datepicker();
      });
    </script>
</body>
</html>
