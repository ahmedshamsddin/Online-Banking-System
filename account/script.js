document.addEventListener("DOMContentLoaded", function () {
  // Retrieve account information from the server or database
  // For demonstration purposes, we'll use static data
  var account = {
    accountId: "123456789",
    userId: "987654321",
    accountNumber: "1234567890",
    accountType: "Savings Account",
    balance: "$1,000.00",
    isActive: "Active",
  };

  // Update the account information on the page
  document.getElementById("accountId").textContent = account.accountId;
  document.getElementById("userId").textContent = account.userId;
  document.getElementById("accountNumber").textContent = account.accountNumber;
  document.getElementById("accountType").textContent = account.accountType;
  document.getElementById("balance").textContent = account.balance;
  document.getElementById("isActive").textContent = account.isActive;
});
