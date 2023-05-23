<?php
  require_once '../libraries/Encryption.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">    <link rel="stylesheet" type="text/css" href="../static/css/homepage.css">
    <link rel="stylesheet" type="text/css" href="../static/css/navbar.css">

    <title>Basic Banking System</title>
  </head>

  <body>
<?php include('../includes/header.php'); ?>
      <div class="container-fluid">
      <!-- Introduction section -->
            <div class="row intro py-1" style="background-color : #BA0C2F;">
              <div class="col-sm-12 col-md">
                <div class="heading text-center my-5">
                  <h3>Welcome to</h3>
                  <h1>turkish BANK</h1>
                </div>
              </div>
              <div class="col-sm-12 col-md img text-center">
                <img src="../static/img/bank.png" class="img-fluid pt-2">
              </div>
            </div>

      <!-- Activity section -->
            <div class="row activity text-center">
                  <div class="col-md act">
                    <img src="../static/img/user.jpg" class="img-fluid">
                    <br>
                    <a href="../loan-page/index.php"><button style="background-color : #2785C4;">Apply for loan</button></a>
                  </div>
                  <div class="col-md act">
                    <img src="../static/img/transfer.jpg" class="img-fluid">
                    <br>
                    <a href="../transaction/index.php"><button style="background-color : #2785C4;">Make a Transaction</button></a>
                  </div>
                  <div class="col-md act">
                    <img src="../static/img/history.jpg" class="img-fluid">
                    <br>
                    <a href="../transaction-history/index.php"><button style="background-color : #2785C4;">Transaction History</button></a>
                  </div>
            </div>
      </div>
<?php include('../includes/footer.php'); ?>
  </body>
</html>