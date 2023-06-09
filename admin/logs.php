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
  require_once '../libraries/Log.php';
  // Check if the clear_logs button was clicked
    if (isset($_POST['clear_logs'])) {
        // Use the clearLogs function from the Log class to clear the logs
        Log::clearLogs();
        $_SESSION['FLASH_SUCCESS'] = "Logs cleared successfully";
        header("Location: logs.php");
        exit();
    }
    // Get all the logs from the database
  $db = (new DB())->connect();
    $sql = "SELECT * FROM logs";
    $stmt = $db->prepare($sql);

    if (!$stmt->execute()) {
        $stmt = null;
        exit();
    }

    $logs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include("includes/header.php"); ?>

<div class="container">
<?php
//   Check if a flash message is set and display it
    if (isset($_SESSION['FLASH_SUCCESS'])) {
        echo "<div class='alert alert-success'>" . $_SESSION['FLASH_SUCCESS'] . "</div>";
        unset($_SESSION['FLASH_SUCCESS']);
    }
?>
<h3>Logs</h3> 
<form method="POST">
    <button type="submit" class="btn btn-danger" name="clear_logs">Clear Logs</button>
</form>
<table class="table">

<thead>
    <tr>
        <th>Type</th>
        <th>Username</th>
        <th>IP </th>
        <th>Timestamp</th>
        <th>User-Agent</th>
        <th>Success/Fail</th>
        <th>Result</th>
    </tr>
</thead>
<tbody>
    <?php foreach ($logs as $log) { ?>
        <tr>
            <td><?php echo $log['type']; ?></td>
            <td><?php echo $log['username']; ?></td>
            <td><?php echo $log['ip_address']; ?></td>
            <td><?php echo $log['timestamp']; ?></td>
            <td><?php echo $log['user_agent']; ?></td>
            <td><?php echo $log['success'] == 1 ? "Success" : "Fail";  ?></td>
            <td><?php echo $log['result']; ?></td>
        </tr>
    <?php } ?>
</tbody>
</table>
</div>

</body></html>