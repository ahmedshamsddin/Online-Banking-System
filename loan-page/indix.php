<!DOCTYPE html>
<html>
<head>
  <title>Loan-Application-Form</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
nav class="navbar navbar-expand-md navbar-light bg-light">
      <a class="navbar-brand" href="index.php" style="color : #C0392B;"><b>turkish</b></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav ml-auto">
              
              <li class="nav-item">
                <a class="nav-link" href="createuser.php" style="color : #C0392B;"><b>Create User</b></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="transfermoney.php" style="color : #C0392B;"><b>Transfer Money</b></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="transactionhistory.php" style="color : #C0392B;"><b>Transaction History</b></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="transactionhistory.php" style="color : #C0392B;"><b>loan</b></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="transactionhistory.php" style="color : #C0392B;"><b>profile</b></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="transactionhistory.php" style="color : #C0392B;"><b>logout</b></a>
              </li>
          </div>
       </nav>
<div class="form-group">
          <label for="loanTerm">Loan Term:</label>
          <input type="number" id="loanTerm" name="loanTerm" required>
        </div>
        <div class="form-group">
          <label for="interestRateType">Preferred Interest Rate Type:</label>
          <select id="interestRateType" name="interestRateType" required>
            <option value="fixed">Fixed</option>
            <option value="variable">Variable</option>
          </select>
        </div>
      </fieldset>

      <fieldset>
        <legend>Financial Information</legend>
        <div class="form-group">
          <label for="bankAccounts">Current Bank Accounts:</label>
          <textarea id="bankAccounts" name="bankAccounts" required></textarea>
        </div>
        <div class="form-group">
          <label for="otherLoansDebts">Other Loans or Debts:</label>
          <textarea id="otherLoansDebts" name="otherLoansDebts" required></textarea>
        </div>
        <div class="form-group">
          <label for="monthlyExpenses">Monthly Expenses:</label>
          <textarea id="monthlyExpenses" name="monthlyExpenses" required></textarea>
        </div>
        <div class="form-group">
          <label for="assets">Assets:</label>
          <textarea id="assets" name="assets" required></textarea>
        </div>
      </fieldset>

      <fieldset>
        <legend>Supporting Documents</legend>
        <div class="form-group">
          <label for="identificationProof">Identification Proof:</label>
          <input type="file" id="identificationProof" name="identificationProof" required>
        </div>
        <div class="form-group">
          <label for="incomeProof">Proof of Income:</label>
          <input type="file" id="incomeProof" name="incomeProof" required>
        </div>
        <div class="form-group">
          <label for="bankStatements">Bank Statements:</label>
          <input type="file" id="bankStatements" name="bankStatements" required>
        </div>
        <div class="form-group">
          <label for="additionalDocuments">Additional Documents:</label>
          <input type="file" id="additionalDocuments" name="additionalDocuments" required multiple>
        </div>
      </fieldset>

      <div class="form-group">
        <input type="checkbox" id="termsAgreement" required>
        <label for="termsAgreement">I agree to the terms and conditions of the loan application.</label>
      </div>

      <button type="submit" class="submit-button">Submit Application</button>
    </form>
  </div>

  <script src="script.js"></script>
</body>
</html>

