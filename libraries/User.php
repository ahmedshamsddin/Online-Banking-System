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

    public function getAllUsers () {
        $db = $this->connect();
        $sql = "SELECT * FROM users";
        $stmt = $db->prepare($sql);
        if (!$stmt->execute()) {
            $stmt = null;
            exit();
        }
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getNumberUsers () {
        $db = $this->connect();
        $sql = "SELECT COUNT(*) FROM users";
        $stmt = $db->prepare($sql);
        if (!$stmt->execute()) {
            $stmt = null;
            exit();
        }
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['COUNT(*)'];
    }

    public function toggleAccount ($lockOrUnlock, $userId) {
        $db = $this->connect();
        if ($lockOrUnlock == "lock") {
            $sql = "UPDATE users SET is_locked = 1 WHERE user_id = ?";
            $stmt = $db->prepare($sql);
            if (!$stmt->execute(array($userId))) {
                $stmt = null;
                exit();
            }
            $stmt = null;
        } else {
            $sql = "UPDATE users SET is_locked = 0 WHERE user_id = ?";
            $stmt = $db->prepare($sql);
            if (!$stmt->execute(array($userId))) {
                $stmt = null;
                exit();
            }
            $stmt = null;
        }
    }
}