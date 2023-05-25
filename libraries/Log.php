<?php
require_once 'DB.php';
class Log {
    public static function log ($type, $username, $success, $result) {
        $db = (new DB())->connect();
        $stmt = $db->prepare('INSERT INTO logs (username, ip_address, timestamp, success, user_agent, result, type) VALUES (?, ?, ?, ?, ?, ?, ?);');
        if (!$stmt->execute(array($username, $_SERVER['REMOTE_ADDR'], date("Y-m-d H:i:s"), $success, $_SERVER['HTTP_USER_AGENT'], $result, $type))) {
            $stmt = null;
            exit();
        }
        $stmt = null;
    }

    public static function clearLogs () {
        $db = (new DB())->connect();
        $stmt = $db->prepare('DELETE FROM logs;');
        if (!$stmt->execute()) {
            $stmt = null;
            exit();
        }
        $stmt = null;
    }
}