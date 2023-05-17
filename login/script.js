document
  .getElementById("loginForm")
  .addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent the form from submitting normally

    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;

    // Perform your login logic here
    // You can send an AJAX request to a server-side script to handle the login

    // For example, you can log the entered username and password to the console
    console.log("Username:", username);
    console.log("Password:", password);
  });
