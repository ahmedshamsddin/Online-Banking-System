<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="navbar.css">

    <title>Basic Banking System</title>
  </head>

  <body>
 
 <nav class="navbar navbar-expand-md navbar-light bg-light">
      <a class="navbar-brand" href="index.php" style="color : #C0392B;"><b>turkish</b></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav ml-auto">
              
              <li class="nav-item">
                <a class="nav-link" href="createuser.php" style="color : #C0392B;"><b>Create User</b></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="transfermoney.php" style="color : #C0392B;"><b>Transfer Money</b></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="transactionhistory.php" style="color : #C0392B;"><b>Transaction History</b></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="transactionhistory.php" style="color : #C0392B;"><b>loan</b></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="transactionhistory.php" style="color : #C0392B;"><b>profile</b></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="transactionhistory.php" style="color : #C0392B;"><b>logout</b></a>
              </li>
          </div>
       </nav>
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
                <img src="img/bank.png" class="img-fluid pt-2">
              </div>
            </div>

      <!-- Activity section -->
            <div class="row activity text-center">
                  <div class="col-md act">
                    <img src="img/user.jpg" class="img-fluid">
                    <br>
                    <a href="createuser.php"><button style="background-color : #2785C4;">Create a User</button></a>
                  </div>
                  <div class="col-md act">
                    <img src="img/transfer.jpg" class="img-fluid">
                    <br>
                    <a href="transictiuon/indix.php"><button style="background-color : #2785C4;">Make a Transaction</button></a>
                  </div>
                  <div class="col-md act">
                    <img src="img/history.jpg" class="img-fluid">
                    <br>
                    <a href="transiction-history"><button style="background-color : #2785C4;">Transaction History</button></a>
                  </div>
            </div>
      </div>
      <footer class="text-center mt-5 py-2">
        <p>&copy 2023. Made by <b>AZIZ KANJO</p>
      </footer>
      
  </body>
</html>