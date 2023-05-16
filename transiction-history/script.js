document.addEventListener("DOMContentLoaded", function () {
  // Fetch transaction data from server or local storage
  var transactions = [
    {
      id: 1,
      accountId: 123456789,
      type: "Deposit",
      amount: 1000,
      date: "2023-05-15",
      description: "Initial deposit",
    },
    {
      id: 2,
      accountId: 123456789,
      type: "Withdrawal",
      amount: 500,
      date: "2023-05-16",
      description: "ATM withdrawal",
    },
    // Add more transaction objects as needed
  ];

  // Get the transaction table body
  var tbody = document.querySelector("#transactionTable tbody");

  // Populate the transaction table
  transactions.forEach(function (transaction) {
    var row = document.createElement("tr");
    row.innerHTML = `
        <td>${transaction.id}</td>
        <td>${transaction.accountId}</td>
        <td>${transaction.type}</td>
        <td>${transaction.amount}</td>
        <td>${transaction.date}</td>
        <td>${transaction.description}</td>
      `;
    tbody.appendChild(row);
  });
});
