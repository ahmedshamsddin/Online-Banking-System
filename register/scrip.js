document.addEventListener("DOMContentLoaded", function () {
  var registerForm = document.getElementById("registerForm");
  var errorMessage = document.getElementById("errorMessage");
  var successMessage = document.getElementById("successMessage");

  registerForm.addEventListener("submit", function (event) {
    event.preventDefault();

    var username = document.getElementById("username").value;
    var firstName = document.getElementById("firstName").value;
    var lastName = document.getElementById("lastName").value;
    var password = document.getElementById("password").value;
    var email = document.getElementById("email").value;
    var idNumber = document.getElementById("idNumber").value;
    var day = document.getElementById("day").value;
    var month = document.getElementById("month").value;
    var year = document.getElementById("year").value;
    var telephone = document.getElementById("telephone").value;

    // Perform form validation
    if (
      username.trim() === "" ||
      firstName.trim() === "" ||
      lastName.trim() === "" ||
      password.trim() === "" ||
      email.trim() === "" ||
      idNumber.trim() === "" ||
      day.trim() === "" ||
      month.trim() === "" ||
      year.trim() === "" ||
      telephone.trim() === ""
    ) {
      errorMessage.innerText = "Please fill in all the required fields.";
      successMessage.innerText = "";
    } else {
      // Registration successful, display a success message and apply green color
      errorMessage.innerText = "";
      successMessage.innerText = "Registration successful! Please login.";
      successMessage.classList.add("success");
      registerForm.reset();
    }
  });
});
