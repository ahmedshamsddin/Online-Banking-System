<!DOCTYPE html>
<html>
<head>
  <title>Transaction History - Banking System</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
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
  <div class="transaction-container">
    <h1>Transaction History</h1>
    <table id="transactionTable">
      <thead>
        <tr>
          <th>Transaction ID</th>
          <th>Account ID</th>
          <th>Transaction Type</th>
          <th>Amount</th>
          <th>Date</th>
          <th>Description</th>
        </tr>
      </thead>
      <tbody>
        <!-- Transaction records will be dynamically added here -->
      </tbody>
    </table>
  </div>

  <script src="script.js"></script>
</body>
</html>
