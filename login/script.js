// script.js

document
  .getElementById("loginForm")
  .addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent form submission

    // Get form values
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;

    // Perform login validation (replace with your own logic)
    if (username === "admin" && password === "password") {
      alert("Login successful!");
      // Redirect to dashboard or desired page
      // window.location.href = 'dashboard.html';
    } else {
      alert("Invalid username or password. Please try again.");
    }
  });
