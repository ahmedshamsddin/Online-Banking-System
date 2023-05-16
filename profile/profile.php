<!DOCTYPE html>
<html>
<head>
  <title>User Profile - Banking System</title>
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
  <div class="profile-container">
    <h1>User Profile</h1>
    <div class="user-info">
    <div class="user-photo">
        
        <img id="photo" src="1.jpg" alt="User Photo">
      </div>
      <div class="user-account">
        <label for="account">Account:</label>
        <span id="account">John Doe</span>
      </div>
      
      <div class="user-email">
        <label for="email">Email:</label>
        <span id="email">johndoe@example.com</span>
      </div>
      <div class="user-mobile">
        <label for="mobile">Mobile Number:</label>
        <span id="mobile">123-456-7890</span>
      </div>
      <div class="user-iban">
        <label for="mobile">iban:</label>
        <span id="mobile">123-456-7890</span>
      </div>
    </div>
  </div>
</body>
</html>
