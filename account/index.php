<!DOCTYPE html>
<html>
<head>
  <title>Account Details - Banking System</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="../static/css/account.css">
  <link rel="stylesheet" type="text/css" href="../static/css/navbar.css">
</head>
<body>
<?php include('../includes/header.php'); ?>
<?php 
  // Check if the user is logged in
  if (isset($_SESSION['user_id'])) { ?>

  <?php
    // Include the database configuration file
    require_once '../libraries/User.php';
    // Include the Encryption file
    require_once '../libraries/Encryption.php';
    // Initialize the User object and decrypt the account number and IBAN
    $account = new User();
    $accountDetails = $account->getAccount($_SESSION['user_id']);
    $decryptedAccountNumber = Encryption::decrypt($accountDetails['account_number']);
    $decryptedIBAN = Encryption::decrypt($accountDetails['iban']);
  ?>

  <div class="account-container">
    <h1>Account Details</h1>
    <div class="account-info">
      <div class="account-field">
        <label for="accountId">Account Number:</label>
        <span id="accountId"><?php echo $decryptedAccountNumber ?></span>
      </div>
      <div class="account-field">
        <label for="userId">IBAN:</label>
        <span id="userId"><?php echo $decryptedIBAN ?></span>
      </div>
      <div class="account-field">
        <label for="accountType">Account Type:</label>
        <span id="accountType"><?php echo $accountDetails['account_type'] ?></span>
      </div>
      <div class="account-field">
        <label for="balance">Balance:</label>
        <span id="balance"><?php echo $accountDetails['balance'] ?></span>
      </div>
      <div class="account-field">
        <label for="isActive">Status:</label>
        <span id="isActive">Active</span>
      </div>
    </div>
  </div>
  <?php } else { 
    header('Location: ../auth/login.php');
  } ?>
<?php include('../includes/footer.php'); ?>
</body>
</html>
