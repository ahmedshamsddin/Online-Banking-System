<!DOCTYPE html>
<html>
<head>
  <title>Account Details - Banking System</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
nav class="navbar navbar-expand-md navbar-light bg-light">
      <a class="navbar-brand" href="index.php" style="color : #C0392B;"><b>turkish</b></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav ml-auto">
              
              <li class="nav-item">
                <a class="nav-link" href="createuser.php" style="color : #C0392B;"><b>Create User</b></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="transfermoney.php" style="color : #C0392B;"><b>Transfer Money</b></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="transactionhistory.php" style="color : #C0392B;"><b>Transaction History</b></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="transactionhistory.php" style="color : #C0392B;"><b>loan</b></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="transactionhistory.php" style="color : #C0392B;"><b>profile</b></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="transactionhistory.php" style="color : #C0392B;"><b>logout</b></a>
              </li>
          </div>
       </nav>
  <div class="account-container">
    <h1>Account Details</h1>
    <div class="account-info">
      <div class="account-field">
        <label for="accountId">Account ID:</label>
        <span id="accountId">123456789</span>
      </div>
      <div class="account-field">
        <label for="userId">User ID:</label>
        <span id="userId">987654321</span>
      </div>
      <div class="account-field">
        <label for="accountNumber">Account Number:</label>
        <span id="accountNumber">1234567890</span>
      </div>
      <div class="account-field">
        <label for="accountType">Account Type:</label>
        <span id="accountType">Savings Account</span>
      </div>
      <div class="account-field">
        <label for="balance">Balance:</label>
        <span id="balance">$1,000.00</span>
      </div>
      <div class="account-field">
        <label for="isActive">Status:</label>
        <span id="isActive">Active</span>
      </div>
    </div>
  </div>

  <script src="script.js"></script>
</body>
</html>
