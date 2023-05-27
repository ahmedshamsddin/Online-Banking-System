<!DOCTYPE html>
<html>
  <head>
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
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
        <li><a href="dashboard.php">Home</a></li>
        <li><a href="users.php">Users</a></li>
        <li><a href="transactions.php">Transactions</a></li>
        <li><a href="logs.php">Logs</a></li>
        <li><a href="applications.php">Applications</a></li>
      </ul>
    </nav>
