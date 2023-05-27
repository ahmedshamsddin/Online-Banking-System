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

    $db = new DB();
    $db = $db->connect();
    $sql = "SELECT * FROM loan_applications WHERE status = 'pending'";
    $stmt = $db->prepare($sql);

    if (!$stmt->execute()) {
        $stmt = null;
        exit();
    }

    function changeLoanStatus ($applicationId, $status, $result) {
        $db = new DB();
        $db = $db->connect();
        $sql = "UPDATE loan_applications SET status = ?, result = ?  WHERE application_id = ?";
        $stmt = $db->prepare($sql);
        if (!$stmt->execute(array($status, $result, $applicationId))) {
            $stmt = null;
            exit();
        }
        $_SESSION["FLASH_SUCCESS"] = "Application status updated";
        header("Location: applications.php");
    }

    if (isset($_POST['submit'])) {
        $applicationId = $_POST['applicationId'];
        $status = htmlspecialchars($_POST['status']);
        $result = htmlspecialchars($_POST['result']);
        changeLoanStatus($applicationId, $status, $result);
    }

    $applications = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include 'includes/header.php'; ?>
<div class="container">
<?php
    if (isset($_SESSION["FLASH_SUCCESS"])) {
    // Check if a flash message is set and display it
    echo "<div class='alert alert-success' role='alert'>" .
        $_SESSION["FLASH_SUCCESS"] .
        "</div>";
    unset($_SESSION["FLASH_SUCCESS"]);
} ?>
    <h4>Loan Applications</h4>

    <table class="table" id="users">
  <thead>
    <tr>
        <th scope="col">Name</th>
        <th scope="col">Date Submitted</th>
        <th scope="col">Status</th>
        <th scope="col">Form</th>
        <th scope="col"></th>
        <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    <?php for ($i = 0; $i < count($applications); $i++) { ?>
        <div class="modal fade" id="modalApprove" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Approve Application</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form method="POST">
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Reason for Approval</label>
                            <textarea class="form-control" name="result" required rows="3"></textarea>
                            <input type="hidden" name="applicationId" value="<?php echo $applications[$i]['application_id']; ?>">
                            <input type="hidden" name="status" value="approved">
                        </div>
                </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="submit" class="btn btn-success">Submit</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal fade" id="modalReject" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Reject Application</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form method="POST">
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Reason for Rejection</label>
                            <textarea class="form-control" name="result" required rows="3"></textarea>
                            <input type="hidden" name="applicationId" value="<?php echo $applications[$i]['application_id']; ?>">
                            <input type="hidden" name="status" value="rejected">
                        </div>
                </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="submit" class="btn btn-danger">Submit</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
    <tr>  
      <td><?php echo $applications[$i]["applicant_name"]; ?></td>
      <td><?php echo $applications[$i]["application_date"]; ?></td>
      <td><?php echo $applications[$i]["status"]; ?></td>
      <td><a href="<?php echo "../upload/loan_applications/" . $applications[$i]['file_name']; ?>"><button class="btn btn-primary">Click</button></a></td>
      <td><button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalApprove">Approve</button></td>
      <td><button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalReject">Reject</button></td>
    </tr>
    <tr>
    <?php } ?>
  </tbody>
</table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</body>
</html>