<!DOCTYPE html>
<html>
<head>
  <title>Register - Banking System</title>
  <link rel="stylesheet" type="text/css" href="styl.css">
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>jQuery UI Datepicker - Default functionality</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css" />
  <link rel="stylesheet" href="/resources/demos/style.css" />
 
  <style>
    .form-row {
      display: flex;
      gap: 20px;
    }

    .form-group {
      flex: 1;
    }
  </style>
</head>
<body>
  <div class="register-container">
    <h1>Register</h1>
    <form id="registerForm">
      <div class="form-row">
        <div class="form-group">
          <label for="username">Username:</label>
          <input type="text" id="username" name="username" required>
        </div>
        <div class="form-group">
          <label for="firstName">First Name:</label>
          <input type="text" id="firstName" name="firstName" required>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label for="lastName">Last Name:</label>
          <input type="text" id="lastName" name="lastName" required>
        </div>
        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" id="password" name="password" required>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
          <label for="idNumber">ID Number:</label>
          <input type="text" id="idNumber" name="idNumber" required>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label for="birthdate">Birth Date:</label>
          <input type="text" id="datepicker" name="birthdate" required>
        </div>
        <div class="form-group">
          <label for="telephone">Telephone Number:</label>
          <input type="tel" id="telephone" name="telephone" required>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label for="city">City:</label>
          <input type="text" id="city" name="city" required>
        </div>
        <div class="form-group">
          <label for="street">Street:</label>
          <input type="text" id="street" name="street" required>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label for="building">Building Name or Compound Name:</label>
          <input type

          ="text" id="building" name="building" required>
</div>
<div class="form-group">
<label for="department">Department Number:</label>
<input type="text" id="department" name="department" required>
</div>
</div>
<div class="form-row">

<div class="form-group">
<label for="photo">Personal Photo:</label>
<input type="file" id="photo" name="photo">
</div>
</div>
<div class="form-row">
<div class="form-group">
<label for="salaryCertificate">Salary Certificate:</label>
<input type="file" id="salaryCertificate" name="salaryCertificate">
</div>
</div>
<button type="submit" class="register-button">Register</button>
<p id="errorMessage" class="error-message"></p>
<p id="successMessage" class="success-message"></p>
</form>

  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  <script>
    $(function () {
      $("#datepicker").datepicker();
    });
  </script>
</body>
</html>