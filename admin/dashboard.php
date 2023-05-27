<?php
  session_start();
  // Check if a user account is already logged in
  if (isset($_SESSION['user_id'])) {
    session_unset();
    session_destroy();
    header("Location: ../auth/login.php");
    exit();
  }
  // Check if no admin account is already logged in
  if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
  }

  require_once '../libraries/User.php';
  require_once '../libraries/Transaction.php';
  require_once '../libraries/DB.php';
  // Function to get the number of transactions today
  function getTransactionsToday () {
    $db = (new DB())->connect();
    $sql = "SELECT * FROM transactions WHERE transaction_date >= CURDATE()";
    $stmt = $db->prepare($sql);
    if (!$stmt->execute()) {
        $stmt = null;
        exit();
    }
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return [$result, count($result)];
}
  // Initialize the User object and get the number of users
  $numberOfUsers = (new User())->getNumberUsers();
  // User the getTransactionsToday function to get the number of transactions
  $numberOfTransactions = getTransactionsToday()[1];
?>

<?php include 'includes/header.php'; ?>
    <div class="container">
      <section id="home">
        <h2>Welcome to the Admin Dashboard</h2>
        <div class="dashboard-card user-card">
          <h2>Number of Users Registered</h2>
          <p id="userCount"><?php echo $numberOfUsers ?></p>
          <p><a href="users.php">View All Users</a></p>
        </div>
        <div class="dashboard-card transaction-card">
          <h2>Number of Transactions Today</h2>
          <p id="transactionCount"><?php echo $numberOfTransactions ?></p>
          <p><a href="transactions.php">View All Transactions</a></p>
        </div>
        <div class="dashboard-card">
          <h2>Login Attempt Log</h2>
          <p><a href="logs.php">Track Login Attempts</a></p>
        </div>
        <div class="dashboard-card user-card">
          <h2>Pending Loan Applications</h2>
          <p><a href="applications.php">View All Pending Applications</a></p>
        </div>
      </section>
    </div>
  </body>
</html>