<!DOCTYPE html>
<html>
<head>
  <title>Transaction History - Banking System</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="../static/css/transaction-history.css">
  <link rel="stylesheet" type="text/css" href="../static/css/navbar.css">
</head>
<body>
<?php include('../includes/header.php'); ?>
<?php if (isset($_SESSION['user_id'])) { ?>
  <?php 
    require_once '../libraries/Transaction.php';
    $transaction = new Transaction($_SESSION['user_id']);
    $transactions = $transaction->getTransactions();  
  ?>
  <div class="transaction-container">
    <h1>Transaction History</h1>
    <table id="transactionTable">
      <thead>
        <tr>
          <th>Transaction ID</th>
          <th>Amount</th>
          <th>Date</th>
          <th>Description</th>
        </tr>
      </thead>
      <tbody>
        <?php if (count($transactions) == 0) { ?>
          <tr>
            <td colspan="4" class="text-center">No transactions found</td>
          </tr>
        <?php } else { ?>
        <?php for ($i=0; $i < count($transactions); $i++) { ?>
          <tr>
            <td><?php echo $transactions[$i]['transaction_id'] ?></td>
            <td><?php echo $transactions[$i]['amount'] ?></td>
            <td><?php echo $transactions[$i]['transaction_date'] ?></td>
            <td><?php echo $transactions[$i]['description'] ?></td>
          </tr>
        <?php } ?>
        <?php } ?>
      </tbody>
    </table>
  </div>
  <?php } else { 
    header('Location: ../auth/login.php');
  } ?>
  <?php include('../includes/footer.php'); ?>
  
</body>
</html>
