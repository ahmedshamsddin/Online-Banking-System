<?php
    class LoginController extends DB {
        private $username;
        private $password;

        public function __construct($username, $password)
        {
            $this->username = $username;
            $this->password = $password;
        }

        public function checkInput () {
            // Check if user is found in database
            $stmt = $this->connect()->prepare('SELECT username FROM users WHERE username = ? OR email = ?;');
            if (!$stmt->execute(array($this->username, $this->username))) {
                $stmt = null;
                exit();
            }
            // If user is found, check if password is correct
            if ($stmt->rowCount() > 0) {
                $stmt = $this->connect()->prepare('SELECT pwd_hash FROM users WHERE username = ? OR email = ?;');
                if (!$stmt->execute(array($this->username, $this->username))) {
                    $stmt = null;
                    exit();
                }
                $hash = $stmt->fetchAll(PDO::FETCH_ASSOC)[0]["pwd_hash"];
                // Return the result of the password check
                /*if (password_verify($this->password, $hash)) {
                    $stmt = "UPDATE users SET last_login = ?, login_attempts = ? WHERE username = ? OR email = ?;";
                    $stmt = $this->connect()->prepare($stmt);
                    if (!$stmt->execute(array(date("Y-m-d H:i:s"), 0, $this->username, $this->username))) {
                        $stmt = null;
                        exit();
                    }
                    $stmt = null;
                    return "password_correct";
                } else {
                    $stmt = "UPDATE users SET login_attempts = login_attempts + 1 WHERE username = ? OR email = ?;";
                    if (!$stmt->execute(array($this->username, $this->username))) {
                        $stmt = null;
                        exit();
                    }
                    $stmt = null;
                    return "incorrect_password";
                }*/
                $stmt = "SELECT login_attempts FROM users WHERE username = ? OR email = ?;";
                $stmt = $this->connect()->prepare($stmt);
                if (!$stmt->execute(array($this->username, $this->username))) {
                    $stmt = null;
                    exit();
                }

                $login_attempts = $stmt->fetchAll(PDO::FETCH_ASSOC)[0]["login_attempts"];
                $stmt = null;

                if ($login_attempts < 3) {
                    if (password_verify($this->password, $hash)) {
                        $stmt = "UPDATE users SET last_login = ?, login_attempts = ? WHERE username = ? OR email = ?;";
                        $stmt = $this->connect()->prepare($stmt);
                        if (!$stmt->execute(array(date("Y-m-d H:i:s"), 0, $this->username, $this->username))) {
                            $stmt = null;
                            exit();
                        }
                        $stmt = null;
                        return "password_correct";
                    } else {
                        $stmt = "UPDATE users SET login_attempts = login_attempts + 1 WHERE username = ? OR email = ?;";
                        $stmt = $this->connect()->prepare($stmt);
                        if (!$stmt->execute(array($this->username, $this->username))) {
                            $stmt = null;
                            exit();
                        }
                        $stmt = null;
                        return "incorrect_password";
                    }
                } else {
                    return "locked_account";
                }
            // If user is not found, return "no_user_found"
            } else {
                $stmt = null;
                return "no_user_found";
            }
        }
        // Login the user
        public function login () {
            // Start a session
            session_start();
            // Get the user's ID
            $stmt = $this->connect()->prepare('SELECT user_id FROM users WHERE username = ? OR email = ?;');
            if (!$stmt->execute(array($this->username, $this->username))) {
                $stmt = null;
                exit();
            }
            // Set the session variables
            $user_id = $stmt->fetchAll(PDO::FETCH_ASSOC)[0]['user_id'];
            $_SESSION['user_id'] = $user_id;
            $_SESSION['username'] = $this->username;
            // Redirect the user to the homepage
            header('location: ../homepage/index.php');
        }
    }
?>