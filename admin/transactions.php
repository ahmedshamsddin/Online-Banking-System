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

    require_once '../libraries/DB.php';
    require_once '../libraries/User.php';
    // Function to get the full name of a user using their account id
    function getUserFullname ($accountId) {
        $db = (new DB())->connect();
        $sql = "SELECT accounts.account_id, users.full_name FROM accounts INNER JOIN users ON accounts.user_id = users.user_id WHERE accounts.account_id = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$accountId]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user['full_name'];
    }

    $db = (new DB())->connect();
    $sql = "SELECT * FROM transactions ORDER BY transaction_date DESC";
    $stmt = $db->prepare($sql);
    
    if (!$stmt->execute()) {
        $stmt = null;
        exit();
    }
    $transactions = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include("includes/header.php"); ?>
<div class="container">
    <h3>Transactions</h3>

    <table class="table">
        <thead>
            <tr>
                <th>Sender</th>
                <th>Reciever</th>
                <th>Amount</th>
                <th>Date</th>
                <th>Description</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($transactions as $transaction): ?>
                <tr>
                    <td><?php echo getUserFullname($transaction['sender_account_id']) ?></td>
                    <td><?php echo getUserFullname($transaction['receiver_account_id']) ?></td>
                    <td><?php echo $transaction['amount'] ?> TL</td>
                    <td><?php echo $transaction['transaction_date'] ?></td>
                    <td><?php echo $transaction['description'] ?></td>
                    <td><button class="btn btn-primary" onclick="location.href='../reciepts/<?php echo $transaction['reciept'] ?>'">Reciept</button></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
</div>
</body></html>