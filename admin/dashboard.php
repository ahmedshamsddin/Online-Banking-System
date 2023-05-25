<?php
  session_start();
  if (isset($_SESSION['user_id'])) {
    session_unset();
    session_destroy();
    header("Location: ../auth/login.php");
    exit();
  }

  if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
  }

  require_once '../libraries/User.php';
  require_once '../libraries/Transaction.php';
  require_once '../libraries/DB.php';

  function getTransactionsToday () {
    $db = (new DB())->connect();
    $sql = "SELECT * FROM transactions /*WHERE transaction_date >= CURDATE() ORDER BY transaction_date ASC*/";
    $stmt = $db->prepare($sql);
    if (!$stmt->execute()) {
        $stmt = null;
        exit();
    }
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return [$result, count($result)];
}

  $numberOfUsers = (new User())->getNumberUsers();
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
          <p><a href="#transactions">View All Transactions</a></p>
        </div>
        <div class="dashboard-card">
          <h2>Login Attempt Log</h2>
          <p><a href="#loginAttempts">Track Login Attempts</a></p>
        </div>
      </section>
    </div>
    <script>
      // JavaScript code to fetch data and update the dashboard
      // Fetch user count from an API endpoint and update the count
      fetch("/api/user-count")
        .then((response) => response.json())
        .then((data) => {
          const userCountElement = document.querySelector("#userCount");
          userCountElement.textContent = data.count;
        });
      // Fetch transaction count from an API endpoint and update the count
      fetch("/api/transaction-count")
        .then((response) => response.json())
        .then((data) => {
          const transactionCountElement =
            document.querySelector("#transactionCount");
          transactionCountElement.textContent = data.count;
        });
    </script>
  </body>
</html>