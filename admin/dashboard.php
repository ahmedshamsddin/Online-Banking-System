<?php
  session_start();
  session_regenerate_id();
  if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Admin Dashboard</title>
    <style>
      /* CSS styles for the dashboard */
      body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
      }
      header {
        background-color: #333;
        color: #fff;
        padding: 10px;
      }
      h1 {
        margin: 0;
      }
      nav {
        background-color: #f4f4f4;
        padding: 10px;
      }
      nav ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
      }
      nav ul li {
        display: inline;
        margin-right: 10px;
      }
      .container {
        margin: 20px;
      }
      .dashboard-card {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        transition: transform 0.3s ease-in-out;
      }
      .dashboard-card:hover {
        transform: translateY(-5px);
      }
      .dashboard-card h2 {
        margin-top: 0;
        margin-bottom: 10px;
        font-size: 18px;
      }
      .dashboard-card p {
        margin: 0;
        font-size: 24px;
        font-weight: bold;
      }
      .dashboard-card.user-card {
        background-color: #b8d8d8;
      }
      .dashboard-card.transaction-card {
        background-color: #d8b8b8;
      }
      .dashboard-card.user-card p,
      .dashboard-card.transaction-card p {
        color: #fff;
      }
      .dashboard-card a {
        text-decoration: none;
        color: #333;
      }
      .dashboard-card a:hover {
        text-decoration: underline;
      }
    </style>
  </head>
  <body>
    <header>
      <h1>Admin Dashboard</h1>
      <button><a href="logout.php">Logout</a></button>
    </header>
    <nav>
      <ul>
        <li><a href="#home">Home</a></li>
        <li><a href="#users">Users</a></li>
        <li><a href="#transactions">Transactions</a></li>
        <li><a href="#loginAttempts">Login Attempts</a></li>
      </ul>
    </nav>
    <div class="container">
      <section id="home">
        <h2>Welcome to the Admin Dashboard</h2>
        <div class="dashboard-card user-card">
          <h2>Number of Users Registered</h2>
          <p id="userCount">0</p>
          <p><a href="#users">View All Users</a></p>
        </div>
        <div class="dashboard-card transaction-card">
          <h2>Number of Transactions Today</h2>
          <p id="transactionCount">0</p>
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