<!DOCTYPE html>
<html>
<head>
  <title>Loan-Application-Form</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="../static/css/loan.css">
  <link rel="stylesheet" type="text/css" href="../static/css/navbar.css">
</head>
<body>
<?php include ('../includes/header.php'); ?>

<?php

require '../libraries/DB.php';
require '../libraries/User.php';

function userApplication () {
  $db = new DB();
  $db = $db->connect();
  $sql = "SELECT * FROM loan_applications WHERE user_id = ?";
  $stmt = $db->prepare($sql);
  if (!$stmt->execute(array($_SESSION['user_id']))) {
      $stmt = null;
      exit();
  }
  $application = $stmt->fetch(PDO::FETCH_ASSOC);
  $color = $application['status'] == "pending" ? "warning" : ($application['status'] == "approved" ? "success" : "danger");
  if (count($application) > 0) {
    return [$application['status'], $color, $application['result']];
  } else {
    return false;
  }
}

if (isset($_POST['submit'])) {
  function applyLoan ($fileNameNew) {
    
    $user = new User();
    $userId = $_SESSION['user_id'];
    $fullName = $user->getUser($userId)['full_name'];

    $db = new DB();
    $db = $db->connect();
    $sql = "INSERT INTO loan_applications (applicant_name, user_id, file_name, application_date) VALUES (?, ?, ?, NOW())";
    $stmt = $db->prepare($sql);
    if (!$stmt->execute(array($fullName, $_SESSION['user_id'], $fileNameNew))) {
        $stmt = null;
        exit();
    }
  }

    $file = $_FILES['file'];
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    $allowed = array('pdf');
    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 1000000) {
                $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                $fileDestination = '../upload/loan_applications/' . $fileNameNew;
                applyLoan($fileNameNew);
                move_uploaded_file($fileTmpName, $fileDestination);
                echo '<div class="alert alert-success mt-2 text-center" role="alert">Your form was successfully uploaded</div>';
            } else {
                echo '<div class="alert alert-danger mt-2 text-center" role="alert">Your file is too big</div>';
            }
        } else {
            echo '<div class="alert alert-danger mt-2 text-center" role="alert">There was an error uploading your file</div>';
        }
    } else {
        echo '<div class="alert alert-danger mt-2 text-center" role="alert">You cannot upload files of this type</div>';
    }

    
}
?>


<?php if (isset($_SESSION['user_id'])) { ?>
        <?php $application = userApplication();
              if (is_array($application)) { 
        ?>
          <div class="container">
            <div class="row">
              <div class="col-md-12">
                Your application status is: <span class="text-<?php echo $application[1]?>"><?php echo ucfirst($application[0]) ?></span><br>

                <?php if ($application[0] == "approved" || $application[0] == "rejected") { ?>
                  <h3>Result:</h3> <?php echo $application[2] ?>
                <?php } ?>
              </div>
            </div>
          </div>
        <?php } else { ?>
          <?php include ('inc/loan-form.php'); ?>
      <?php } ?>
  <?php
    } else {
      header('Location: ../auth/login.php');
    } 
  ?>
  <?php include ('../includes/footer.php'); ?>
  <script src="script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>

