<?php
require_once 'DB.php';
require_once 'Transaction.php';
require_once 'User.php';
class TransactionController extends DB {

    private $id;
    private $senderId;
    private $iban;
    private $amount;
    private $description;

    // Constructor for the TransactionController class
    public function __construct ($senderId, $iban, $amount, $description) {
        $this->senderId = $senderId;
        $this->iban = $iban;
        $this->amount = $amount;
        $this->description = $description;
        $this->id = (new User())->getAccount($senderId)['account_id'];
    }

    // Get reciever account id from iban
    private function getRecieverAccount () {
        $hash = hash('sha256', $this->iban);
        $db = $this->connect();
        $sql = "SELECT account_id FROM accounts WHERE iban_hash = ?";
        $stmt = $db->prepare($sql);
        if (!$stmt->execute(array($hash))) {
            $stmt = null;
            exit();
        }
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt = null;
        return count($result) > 0 ? $result[0]['account_id'] : false;
    } 
    // Check if the IBAN exists in the database
    private function checkIBAN () {
        $hash = hash('sha256', $this->iban);
        $db = $this->connect();
        $sql = "SELECT account_id, iban_hash FROM accounts WHERE iban_hash = ?";
        $stmt = $db->prepare($sql);
        if (!$stmt->execute(array($hash))) {
            $stmt = null;
            exit();
        }
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($result) > 0) {
            if ($result[0]['account_id'] == $this->id) {
                return false;
            } else {
                return true;
            }
        }
    }
    // Check if the sender has enough balance to transfer the amount
    private function checkBalance () {
        if ($this->amount <= 0) {
            return false;
        }

        $db = $this->connect();
        $sql = "SELECT balance FROM accounts WHERE account_id = ?";
        $stmt = $db->prepare($sql);
        if (!$stmt->execute(array($this->id))) {
            $stmt = null;
            exit();
        }
        $balance = $stmt->fetchAll(PDO::FETCH_ASSOC)[0]['balance'];
        $stmt = null;
        return $balance >= $this->amount ? true : false;
    }

    public function validInput() {
        if (!$this->checkIBAN()) {
            return "Invalid IBAN";
        }

        if (!$this->checkBalance()) {
            return "Insufficient balance";
        }

        return "Success";
    }

    // Transfer the amount from the sender to the reciever
    public function transfer () {
        // Add transaction to the database
        $db = self::connect();
        $sql = "INSERT INTO transactions (sender_account_id, receiver_account_id, amount, transaction_date, description) VALUES (?, ?, ?, ?, ?)";
        $stmt = $db->prepare($sql);
        if (!$stmt->execute(array($this->id, $this->getRecieverAccount(), $this->amount, date("Y-m-d H:i:s"), $this->description))) {
            $stmt = null;
            exit();
        }

        // Update sender balance
        $sql = "UPDATE accounts SET balance = balance - ? WHERE user_id = ?";
        $stmt = $db->prepare($sql);
        if (!$stmt->execute(array($this->amount, $this->senderId))) {
            $stmt = null;
            exit();
        }

        // Update reciever balance
        $sql = "UPDATE accounts SET balance = balance + ? WHERE account_id = ?";
        $stmt = $db->prepare($sql);
        if (!$stmt->execute(array($this->amount, $this->getRecieverAccount()))) {
            $stmt = null;
            exit();
        }

        $stmt = null;
    }
}

?>