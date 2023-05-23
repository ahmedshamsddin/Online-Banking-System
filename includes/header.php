<?php session_start(); ?>
       <nav class="navbar navbar-expand-lg navbar-light bg-light">
       <a class="navbar-brand" href="../homepage/index.php" style="color : #C0392B;"><b>turkish</b></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
    <?php if (isset($_SESSION['user_id'])) { ?>
              <li class="nav-item">
                <a class="nav-link" href="../transaction/index.php" style="color : #C0392B;"><b>Transfer Money</b></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../transaction-history/index.php" style="color : #C0392B;"><b>Transaction History</b></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../loan-page/index.php" style="color : #C0392B;"><b>Apply For Loan</b></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../account/index.php" style="color : #C0392B;"><b>Account</b></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../profile/index.php" style="color : #C0392B;"><b>Profile</b></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../auth/logout.php" style="color : #C0392B;"><b>Logout</b></a>
              </li>
              <?php } else { ?>
              <li class="nav-item">
                <a class="nav-link" href="../auth/login.php" style="color : #C0392B;"><b>Login</b></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../auth/register.php" style="color : #C0392B;"><b>Register</b></a>
              </li>
              <?php } ?>
    </ul>
  </div>
</nav>