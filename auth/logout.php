<?php
require_once '../libraries/Log.php';
Log::log("logout", $_SESSION['username'], 1, "logged_out");
session_start();
session_unset();
session_destroy();

header("location: login.php");  
?>