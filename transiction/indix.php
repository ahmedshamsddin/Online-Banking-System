<!DOCTYPE html>
<html>
<head>
  <title>Money Transfer - Banking System</title>
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
    <h1>Money Transfer</h1>
    <form id="transactionForm">
      <div class="form-group">
        <label for="accountId">Account ID:</label>
        <input type="text" id="accountId" name="accountId" required>
      </div>
      <div class="form-group">
        <label for="fullName">Full Name:</label>
        <input type="text" id="fullName" name="fullName" required>
      </div>
      <div class="form-group">
        <label for="bankName">Bank Name:</label>
        <input type="text" id="bankName" name="bankName" required>
      </div>
      <div class="form-group">
        <label for="amount">Amount:</label>
        <input type="number" id="amount" name="amount" required>
      </div>
      <div class="form-group">
        <label for="description">Description:</label>
        <textarea id="description" name="description" rows="3" required></textarea>
      </div>
      <button type="submit" class="send-button">Send</button>
    </form>
    <div id="receipt" class="receipt-container"></div>
  </div>

  <script src="script.js"></script>
</body>
</html>
