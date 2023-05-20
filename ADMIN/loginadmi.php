<?php
  // Check if the form is submitted
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the entered username and password
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the username and password match the admin credentials
    if ($username === 'admin' && $password === 'adminpassword') {
      // Authentication successful, redirect to the admin dashboard
      header('Location: admin_dashboard.php');
      exit();
    } else {
      // Invalid credentials, redirect back to the login page with an error
      header('Location: login.php
