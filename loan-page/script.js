document.addEventListener("DOMContentLoaded", function () {
  var loanForm = document.getElementById("loanForm");
  var errorMessage = document.getElementById("errorMessage");
  var successMessage = document.getElementById("successMessage");

  loanForm.addEventListener("submit", function (event) {
    event.preventDefault();

    // Perform validation checks
    var isValid = validateForm();
    if (isValid) {
      // Display success message
      successMessage.textContent = "Loan application submitted successfully.";
      successMessage.style.display = "block";

      // Clear form inputs
      loanForm.reset();
    }
  });

  function validateForm() {
    var isValid = true;

    // Perform validation checks here
    // You can add your custom validation logic for each field

    // Example: Check if the Full Name field is empty
    var fullNameInput = document.getElementById("fullName");
    if (fullNameInput.value.trim() === "") {
      showError(fullNameInput, "Please enter your full name.");
      isValid = false;
    } else {
      hideError(fullNameInput);
    }

    // Add more validation checks for other fields

    return isValid;
  }

  function showError(inputElement, errorMessageText) {
    var errorElement = inputElement.nextElementSibling;
    errorElement.textContent = errorMessageText;
    errorElement.style.display = "block";
  }

  function hideError(inputElement) {
    var errorElement = inputElement.nextElementSibling;
    errorElement.textContent = "";
    errorElement.style.display = "none";
  }
});
