<?php
require_once 'DB.php';
require_once 'Encryption.php';
class User extends DB {
    public function getAccount ($userId) {
        $db = $this->connect();
        $sql = "SELECT * FROM accounts WHERE user_id = ?";
        $stmt = $db->prepare($sql);
        if (!$stmt->execute(array($userId))) {
            $stmt = null;
            exit();
        }
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getUser ($userId) {
        $db = $this->connect();
        $sql = "SELECT * FROM users WHERE user_id = ?";
        $stmt = $db->prepare($sql);
        if (!$stmt->execute(array($userId))) {
            $stmt = null;
            exit();
        }
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
}