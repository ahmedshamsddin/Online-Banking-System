<?php
require_once 'User.php';
class Transaction extends DB {
    private $accountId;
    private $userId;

    public function __construct ($userId) {
        $this->accountId = (new User())->getAccount($userId)['account_id'];
    }

    public function getTransactions () {
        $db = $this->connect();
        $sql = "SELECT * FROM transactions WHERE sender_account_id = ? OR receiver_account_id = ? ORDER BY transaction_date ASC";
        $stmt = $db->prepare($sql);
        if (!$stmt->execute(array($this->accountId, $this->accountId))) {
            $stmt = null;
            exit();
        }
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}