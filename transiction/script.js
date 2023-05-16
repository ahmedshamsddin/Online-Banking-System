document.addEventListener("DOMContentLoaded", function () {
  var transactionForm = document.getElementById("transactionForm");
  var receiptContainer = document.getElementById("receipt");

  transactionForm.addEventListener("submit", function (event) {
    event.preventDefault();

    var accountId = document.getElementById("accountId").value;
    var fullName = document.getElementById("fullName").value;
    var bankName = document.getElementById("bankName").value;
    var amount = document.getElementById("amount").value;
    var description = document.getElementById("description").value;

    // Perform transaction logic here
    // ...

    // Display receipt
    var receiptHTML = `
        <h2>Transaction Receipt</h2>
        <p><strong>Account ID:</strong> ${accountId}</p>
        <p><strong>Full Name:</strong> ${fullName}</p>
        <p><strong>Bank Name:</strong> ${bankName}</p>
        <p><strong>Amount:</strong> ${amount}</p>
        <p><strong>Description:</strong> ${description}</p>
      `;
    receiptContainer.innerHTML = receiptHTML;
  });
});
