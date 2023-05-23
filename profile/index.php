<!DOCTYPE html>
<html>
<head>
  <title>User Profile - Banking System</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="../static/css/profile.css">
  <link rel="stylesheet" type="text/css" href="../static/css/navbar.css">
</head>
<body>
<?php include('../includes/header.php'); ?>
<?php if (isset($_SESSION['user_id'])) { ?>

  <?php 
    require_once '../libraries/User.php';
    require_once '../libraries/Encryption.php';
    $user = new User();
    $userDetails = $user->getUser($_SESSION['user_id']);
    $idNumber = Encryption::decrypt($userDetails['id_number']);
  ?>

  <div class="profile-container">
    <h1>User Profile</h1>
    <div class="user-info">
    <div class="user-photo">
        
        <img id="photo" src="../upload/profile_picture/<?php echo $userDetails['personal_photo'] ?>" alt="User Photo">
      </div>
      <div class="user-account">
        <label for="account">ID Number:</label>
        <span id="account"><?php echo $idNumber ?></span>
      </div>

      <div class="user-account">
        <label for="account">Full Name:</label>
        <span id="account"><?php echo $userDetails['full_name'] ?></span>
      </div>
      
      <div class="user-email">
        <label for="email">Email:</label>
        <span id="email"><?php echo $userDetails['email'] ?></span>
      </div>
      <div class="user-mobile">
        <label for="mobile">Mobile Number:</label>
        <span id="mobile"><?php echo $userDetails['phone_number'] ?></span>
      </div>
    </div>
  </div>
  <?php } else { 
    header('Location: ../auth/login.php');
  } ?>
  <?php include('../includes/footer.php'); ?>
</body>
</html>
