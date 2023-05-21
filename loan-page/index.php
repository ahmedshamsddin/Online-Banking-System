<!DOCTYPE html>
<html>
<head>
  <title>Loan-Application-Form</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="../static/css/loan.css">
  <link rel="stylesheet" type="text/css" href="../static/css/navbar.css">
</head>
<body>
<?php include('../includes/header.php'); ?>
<?php if (isset($_SESSION['user_id'])) { ?>
<div class="form-group">
          <label for="loanTerm">Loan Term:</label>
          <input type="number" id="loanTerm" min="0" name="loanTerm" required>
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
  <?php } else { 
    header('Location: ../auth/login.php');
  } ?>
  <?php include('../includes/footer.php'); ?>
  <script src="script.js"></script>
</body>
</html>

