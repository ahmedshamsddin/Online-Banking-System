document.addEventListener("DOMContentLoaded", function () {
  // Retrieve user information from the server or database
  // For demonstration purposes, we'll use static data
  var user = {
    account: "John Doe",
    photo: "user_photo.jpg",
    email: "johndoe@example.com",
    mobile: "123-456-7890",
  };

  // Update the user information on the page
  document.getElementById("account").textContent = user.account;
  document.getElementById("photo").src = user.photo;
  document.getElementById("email").textContent = user.email;
  document.getElementById("mobile").textContent = user.mobile;
});
