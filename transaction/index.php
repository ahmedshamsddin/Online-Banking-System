<!DOCTYPE html>
<html>
<head>
  <title>Money Transfer - Banking System</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="../static/css/transaction.css">
  <link rel="stylesheet" type="text/css" href="../static/css/navbar.css">
</head>
<body>
<?php include('../includes/header.php'); ?>
<?php if (isset($_SESSION['user_id'])) { ?>

  <?php
    if (isset($_POST['submit'])) {
      $iban = $_POST['iban'];
      $amount = $_POST['amount'];
      
      if (empty($_POST['description'])) {
        $description = "No description provided";
      } else {
        $description = $_POST['description'];
      }

      $print_reciept = $_POST['print'] ?? null;

      require_once '../libraries/TransactionController.php';
      require_once '../libraries/Reciept.php';
      require_once '../libraries/Log.php';

      $reciept_name = uniqid('', true) . '.pdf'; 
      $transaction = new TransactionController($_SESSION['user_id'], $iban, $amount, $description, $reciept_name);
      // If the transfer method output is not  true, display an error message
      if ($transaction->validInput() == "Invalid IBAN") {
          // Log the error
          Log::log("transaction", $_SESSION['username'], 0, "iban_invalid");
          echo '<div class="alert alert-danger mt-2 text-center" role="alert">IBAN Invalid</div>';
      } elseif ($transaction->validInput() == "Insufficient balance") {
        Log::log("transaction", $_SESSION['username'], 0, "insufficient_balance");
        echo '<div class="alert alert-danger mt-2 text-center" role="alert">Insufficient Balance</div>';
      }else {
        
        $transaction->transfer();
        if ($print_reciept == 'print') {
          Log::log("transaction", $_SESSION['username'], 1, "transaction_success");
          $reciept = new Reciept(true, $reciept_name);
          $reciept->generateReciept($iban, $amount, $description, date("Y-m-d H:i:s"));
        } else {
          Log::log("transaction", $_SESSION['username'], 1, "transaction_success");
          $reciept = new Reciept(false, $reciept_name);
          $reciept->generateReciept($iban, $amount, $description, date("Y-m-d H:i:s"));
          echo '<div class="alert alert-success mt-2 text-center" role="alert">Transaction Successfull!</div>';
        }
      }
      
    }
  ?>

  <div class="transaction-container">
    <h1>Money Transfer</h1>
    <form id="transactionForm" method="POST" action="">
      <div class="form-group">
        <label for="accountId">IBAN:</label>
        <input type="text" id="iban" name="iban" required>
      </div>
      <div class="form-group">
        <label for="amount">Amount:</label>
        <input type="number" id="amount" name="amount" required>
      </div>
      <div class="form-group">
        <label for="description">Description: (optional)</label>
        <textarea id="description" min="0" name="description" rows="3"></textarea>
      </div>
      <div class="form-group">
        <input type="checkbox" value="print" name="print">
        <label for="termsAgreement">Print reciept</label>
      </div>

      <button type="submit" name="submit" class="send-button">Transfer</button>
    </form>
  </div>
  <?php } else { 
    header('Location: ../auth/login.php');
  } ?>
  <?php include('../includes/footer.php'); ?>
</body>
</html>
