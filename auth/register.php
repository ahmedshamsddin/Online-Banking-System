
<?php 
session_start();
if (isset($_POST['submit'])) {
  
  $username = $_POST['username'];
  $fullName = $_POST['firstName'] . " " . $_POST['lastName'];
  $password = $_POST['password'];
  $repeatPassword = $_POST['repeatPassword'];
  $email = $_POST['email'];
  $idNumber = $_POST['idNumber'];
  $dob = $_POST['dob'];
  $phoneNumber = $_POST['phoneNumber'];
  $occupation = $_POST['occupation'];
  $personalPhoto = $_FILES['photo'];
  
  if (is_uploaded_file($personalPhoto['tmp_name'])) {
    $personalPhotoName = $personalPhoto['name'];
    $personalPhotoTmpName = $personalPhoto['tmp_name'];
    $personalPhotoSize = $personalPhoto['size'];
    $personalPhotoError = $personalPhoto['error'];
    $personalPhotoType = $personalPhoto['type'];
    
    $personalPhotoExt = explode('.', $personalPhotoName);
    $personalPhotoActualExt = strtolower(end($personalPhotoExt));
    
    $allowed = array('jpg', 'jpeg', 'png');
    
    if (in_array($personalPhotoActualExt, $allowed)) {
      if ($personalPhotoError === 0) {
        if ($personalPhotoSize < 5000000) {
          $personalPhotoNameNew = uniqid('', true) . "." . $personalPhotoActualExt;
          $personalPhotoDestination = '../upload/profile_picture/' . $personalPhotoNameNew;
          move_uploaded_file($personalPhotoTmpName, $personalPhotoDestination);
        } else {
          echo '<div class="alert alert-danger mt-2 text-center" role="alert">Your photo is too big!</div>';
          exit();
        }
      } else {
        echo '<div class="alert alert-danger mt-2 text-center" role="alert">There was an error uploading your photo!</div>';
        exit();
      }
    } else {
      echo '<div class="alert alert-danger mt-2 text-center" role="alert">You cannot upload files of this type!</div>';
      exit();
    }
}
  
  require_once '../libraries/RegisterController.php';

  $personalPhotoNameNew = $personalPhotoNameNew ?? null;
  $register = new RegisterController($username, $fullName, $password, $repeatPassword, $email, $idNumber, $dob, $phoneNumber, $occupation, $personalPhotoNameNew);

  if (count($register->registerUser()) > 0) {
    foreach ($register->registerUser() as $error) {
      echo '<div class="alert alert-danger mt-2 text-center" role="alert">' . $error . '</div>';
    }
  } else {
    header("location: login.php");
  }
}
?>

<?php if (!isset($_SESSION['user_id'])) { ?>
<!DOCTYPE html>
<html>
<head>
  <title>Register - Banking System</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="../static/css/register.css">
  <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link
      rel="stylesheet"
      href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css"
    />

    <style>
      select {
        width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
      }
      </style>
</head>
<body>

  <div class="register-container">
    <h1>Register</h1>
    <form id="registerForm" method="POST" enctype="multipart/form-data">
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
  <label for="password">Repeat Password:</label>
  <input type="password" id="repeatPassword" name="repeatPassword" required>
  <button type="button" id="showPasswordBtn" onclick="togglePasswordVisibility()">Show Password</button>
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
      <label for="date">Date of Birth:</label>
      <input type="text" id="datepicker" name="dob" required placeholder="DD/MM/YYYY"/>
      </div>
      <div class="form-group">
        <label for="telephone">Phone Number:</label>
        <input type="tel" id="telephone" name="phoneNumber" required placeholder="05XX XXX XX XX">
      </div>
      <div class="form-group">
          <label for="occupation"></label>
        <select id="occupation" name="occupation" onchange="showFileUpload()" required>
          <option value="student" selected>Student</option>
         <option value="employee">Employee</option>
          <option value="businessman">Businessman</option>
        </select>
        </div>
        <div class="form-group">
        <div id="fileUploadContainer" style="display: none;">
          <label for="fileUpload" id="fileUploadLabel"></label>
          <input type="file" id="fileUpload" name="fileUpload">
        </div>
        </div>
      <div class="form-group">
        <label for="photo">Personal Photo:</label>
        <input type="file" name="photo">
      </div>
       

      <button type="submit" name="submit" class="register-button">Register</button>
      <p id="errorMessage" class="error-message"></p>
      <p id="successMessage" class="success-message"></p>
    </form>
    <span>Already have an account? Login <a href="login.php">here</span>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
        function showFileUpload() {
    var occupation = document.getElementById("occupation").value;
    var fileUploadContainer = document.getElementById("fileUploadContainer");

    if (occupation === "employee") {
      fileUploadContainer.style.display = "block";
      document.getElementById("fileUploadLabel").innerHTML = "Salary Certificate:";
    } else if (occupation === "businessman") {
      fileUploadContainer.style.display = "block";
      document.getElementById("fileUploadLabel").innerHTML = "Trade License:";
    } else {
      fileUploadContainer.style.display = "none";
    }
  }

  function togglePasswordVisibility() {
    var passwordInput = document.getElementById("password");
    var repeatPasswordInput = document.getElementById("repeatPassword");
    var showPasswordBtn = document.getElementById("showPasswordBtn");

    if (passwordInput.type === "password") {
      passwordInput.type = "text";
      repeatPasswordInput.type = "text";
      showPasswordBtn.textContent = "Hide Password";
    } else {
      passwordInput.type = "password";
      repeatPasswordInput.type = "password";
      showPasswordBtn.textContent = "Show Password";
    }
  }

    </script>
</body>
</html>
<?php } else { 
  header("location: ../homepage/index.php");
} ?>