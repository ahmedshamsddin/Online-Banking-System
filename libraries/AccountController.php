<?php 
require_once 'Encryption.php';

class AccountController extends DB {
    public static function generateIBAN ($accountNumber) {
        // Construct the Turkish IBAN structure
        $bankCode = "0010";
        $branchCode = "0001";
        $ibanStructure = 'TR' . '00' . $bankCode . $branchCode . $accountNumber;

        // Remove non-numeric characters from the IBAN structure
        $ibanStructure = preg_replace('/[^0-9]/', '', $ibanStructure);

        // Calculate the checksum
        $mod = bcmod($ibanStructure, '97');
        $checksum = str_pad(98 - intval($mod), 2, '0', STR_PAD_LEFT);

        // Format the Turkish IBAN with the checksum
        $iban = 'TR' . $checksum . $bankCode . $branchCode . $accountNumber;

        return $iban;
    }
    
    public function createBankAccount ($userId, $idNumber, $accountType) {
        $encryption = new Encryption();
        // I will use the encrypted ID number as the account number
        $accountNumber = $idNumber;
        // Generate the IBAN
        $iban = $this->generateIBAN($accountNumber);
        // Encrypt the IBAN and the account number
        $encryptedIBAN = $encryption->encrypt($iban);
        $encryptedAccountNumber = $encryption->encrypt($accountNumber);

        // Hash the iban
        $hashedIBAN = hash('sha256', $iban);

        // Insert the account into the database
        $stmt = $this->connect()->prepare('INSERT INTO accounts (user_id, account_number, account_type, iban, iban_hash) VALUES (?, ?, ?, ?, ?);');
    
        if (!$stmt->execute(array($userId, $encryptedAccountNumber, $accountType, $encryptedIBAN, $hashedIBAN))) {
            $stmt = null;
            exit();
        }
    }
}
?>