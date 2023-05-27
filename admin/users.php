<?php
session_start();
    // Check if a user account is already logged in
if (isset($_SESSION["user_id"])) {
    session_unset();
    session_destroy();
    header("Location: ../auth/login.php");
    exit();
}
    // Check if no admin account is already logged in
if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit();
}

require_once "../libraries/User.php";
require_once "../libraries/Encryption.php";
  // Check if the admin is trying to lock an account
if (isset($_POST["lock"])) {
    $userId = $_POST["userId"];
    // Use the toggleAccount function from the User class to lock the account
    (new User())->toggleAccount("lock", $userId);
    $_SESSION["FLASH_SUCCESS"] = "Account locked successfully";
}
// Check if the admin is trying to unlock an account
if (isset($_POST["unlock"])) {
    $userId = $_POST["userId"];
    // Use the toggleAccount function from the User class to unlock the account
    (new User())->toggleAccount("unlock", $userId);
    $_SESSION["FLASH_SUCCESS"] = "Account unlocked successfully";
}
// use the getAllUsers function from the User class to get all the users
$users = (new User())->getAllUsers();
?>

<?php include "includes/header.php"; ?>

<div class="container">
  
<?php if (isset($_SESSION["FLASH_SUCCESS"])) {
  // Check if a flash message is set and display it
    echo "<div class='alert alert-success' role='alert'>" .
        $_SESSION["FLASH_SUCCESS"] .
        "</div>";
    unset($_SESSION["FLASH_SUCCESS"]);
} ?>

<input type="text" id="myInput" class="input-group" onkeyup="search()" placeholder="Search by ID or Full Name">
<table class="table" id="users">
  <thead>
    <tr>
        <th scope="col">ID Number</th>
        <th scope="col">Full Name</th>
        <th scope="col">Email</th>
        <th scope="col">Phone Number</th>
        <th scope="col">Last Login</th>
        <th scope="col"></th>
        <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    <?php for ($i = 0; $i < count($users); $i++) { ?>
        <?php $account = (new User())->getAccount($users[$i]["user_id"]); ?>
            <div class="modal fade" id="modal<?php echo $i; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Account Details</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <p><?php echo "Account Number: " .
                        Encryption::decrypt($account["account_number"]); ?></p>
                    <p><?php echo "IBAN Number: " .
                        Encryption::decrypt($account["iban"]); ?></p>
                    <p><?php echo "Current Balance: " .
                        $account["balance"] .
                        " TL"; ?></p>
                    <p><?php echo "Acount Type: " .
                        ucfirst($account["account_type"]); ?></p>
                </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
    <tr>  
        <td scope="row"><?php echo Encryption::decrypt(
            $users[$i]["id_number"]
        ); ?></td>
      <td><?php echo $users[$i]["full_name"]; ?></td>
      <td><?php echo $users[$i]["email"]; ?></td>
      <td><?php echo $users[$i]["phone_number"]; ?></td>
      <td><?php echo $users[$i]["last_login"]; ?></td>
      <td><button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal<?php echo $i; ?>">Account Details</button></td>  
       <?php if ($users[$i]["is_locked"] === 0) { ?>
        <form method="POST">
        <td><button class="btn btn-danger" type="submit" name="lock">Lock</button></td>
        <input type="hidden" name="userId" value="<?php echo $users[$i][
            "user_id"
        ]; ?>">
        </form>
        <?php } else { ?>
            <form method="POST">
        <td><button class="btn btn-warning" type="submit" name="unlock">Unlock</button></td>
        <input type="hidden" name="userId" value="<?php echo $users[$i][
            "user_id"
        ]; ?>">
        </form>
        <?php } ?>
    </tr>
    <tr>
    <?php } ?>
  </tbody>
</table>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<script>
function search() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("users");
  tr = table.getElementsByTagName("tr");
  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    if (!isNaN(input.value)) {
        td = tr[i].getElementsByTagName("td")[0];
    } else {
        td = tr[i].getElementsByTagName("td")[1];
    }
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>
</body>
</html>