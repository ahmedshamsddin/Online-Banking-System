<?php
use function PHPSTORM_META\type;
    // Require the necessary files
    require_once 'DB.php';
    require_once 'AccountController.php';
    require_once 'Encryption.php';

    class RegisterController extends DB {
        // Properties of the RegisterController class
        private $username;
        private $fullName;
        private $password;
        private $repeatPassword;
        private $email;
        private $idNumber;
        private $dob;
        private $phoneNumber;
        private $occupation;
        private $personalPhoto;
        
        // Constructor for the RegisterController class
        public function __construct($username, $fullName, $password, $repeatPassword, $email, $idNumber, $dob, $phoneNumber, $occupation, $personalPhoto) {
            $this->username = $username;
            $this->fullName = $fullName;
            $this->password = $password;
            $this->repeatPassword = $repeatPassword;
            $this->email = $email;
            $this->idNumber = $idNumber;
            $this->dob = $dob;
            $this->phoneNumber = $phoneNumber;
            $this->occupation = $occupation;
            $this->personalPhoto = $personalPhoto;
        }
        // Check if any of the inputs are empty
        private function emptyInput () {
            return empty($this->username) 
                || empty($this->email) 
                || empty($this->password) 
                || empty($this->repeatPassword)
                || empty($this->fullName)
                || empty($this->idNumber)
                || empty($this->dob)
                || empty($this->phoneNumber)
                || empty($this->occupation)
                 ? true : false; 
        }
        // Check if the passwords match
        private function passwordsNotMatching () {
            return strcmp($this->password, $this->repeatPassword) !== 0 ? true : false;
        }
        // Check if the email is invalid
        private function invalidEmail () {
            $tmp_email = filter_var($this->email, FILTER_SANITIZE_EMAIL);
            return !filter_var($tmp_email, FILTER_VALIDATE_EMAIL) ? true : false;
        }
        // Check if the password is invalid
        private function invalidPassword () {
            $uppercase = preg_match("@[A-Z]@", $this->password);
            $lowercase = preg_match("@[a-z]@", $this->password);
            $number    = preg_match("@[0-9]@", $this->password);
            $specialChars = strpbrk($this->password, "!@#$%^&*()+=[]';,./{}|:<>?~");

            return (!$uppercase 
                || !$lowercase 
                || !$number 
                || !$specialChars 
                || strlen($this->password) < 8) ? true : false;
            
        }
        // Check if the phone number is invalid
        private function invalidPhoneNumber () {
            $regex = "/^(\+90|0)?\s*(\(\d{3}\)[\s-]*\d{3}[\s-]*\d{2}[\s-]*\d{2}|\(\d{3}\)[\s-]*\d{3}[\s-]*\d{4}|\(\d{3}\)[\s-]*\d{7}|\d{3}[\s-]*\d{3}[\s-]*\d{4}|\d{3}[\s-]*\d{3}[\s-]*\d{2}[\s-]*\d{2})$/";
            return preg_match($regex, $this->phoneNumber) !== 1 ? true : false;
        }
        // Check if the date of birth is invalid
        private function invalidDOB () {
            $regex = "/^([0-2][0-9]|(3)[0-1])(\/)(((0)[0-9])|((1)[0-2]))(\/)\d{4}$/";
            /*return preg_match($regex, $this->dob) !== 1 ? true : false;*/
            if (preg_match($regex, $this->dob) !== 1) {
                return true;
            } else {
                return $this->age() == true ? true : false;
            }
        }
        // Check if user is not 18 years old or older
        private function age() {
            $birthDate = $this->dob;
            //explode the date to get month, day and year
            $birthDate = explode("/", $birthDate);
            //get age from date or birthdate
            $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
                    ? ((date("Y") - $birthDate[2]) - 1)
                    : (date("Y") - $birthDate[2]));

            return $age < 18 ? true : false;
        }
        // Check if the ID number is invalid
        private function invalidIDNumber () {
            if (!is_numeric($this->idNumber)) {
              return true;
            }
        
            $id = (int) $this->idNumber;
        
            if ($id < 10000000000) {
              return true;
            }
        
            $digits = [];
            $tmp = $id;
        
            while ($tmp > 0) {
              $digits[] = $tmp % 10;
              $tmp = floor($tmp / 10); 
            }
        
            $digits = array_reverse($digits);
        
            $A = $digits[0] + $digits[2] + $digits[4] + $digits[6] + $digits[8];
            $B = $digits[1] + $digits[3] + $digits[5] + $digits[7];
        
            if ($digits[9] !== (7 * $A - $B) % 10) {
              return true;
            }
        
            $C = array_sum(array_slice($digits, 0, 10));
            if ($digits[10] !== $C % 10) {
              return true;
            }
        
            return false;
        }
        // Check if the user already exists in the database
        private function userAlreadyExists () {
            $stmt = $this->connect()->prepare('SELECT username FROM users WHERE username = ? OR email = ?;');
            if (!$stmt->execute(array($this->username, $this->email))) {
                $stmt = null;
                exit();
            }
            return ($stmt->rowCount() > 0) ? true : false;
        }
        // Check if phone number already exists in the database
        private function phoneAlreadyExists () {
            $phoneNumber = str_replace(' ', '', $this->phoneNumber);
            $stmt = $this->connect()->prepare('SELECT phone_number FROM users WHERE phone_number = ?');
            if (!$stmt->execute(array($phoneNumber))) {
                $stmt = null;
                exit();
            }
            return ($stmt->rowCount() > 0) ? true : false;
        }
        private function idNumberAlreadyExists () {
            $stmt = $this->connect()->prepare('SELECT id_number FROM users');
            if (!$stmt->execute()) {
                $stmt = null;
                exit();
            }
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($results as $result) {
                if (Encryption::compare($this->idNumber, $result['id_number'])) {
                    return true;
                }
            }

            return false;
        }

        private function checkPersonalPhoto () {
            if (is_uploaded_file($this->personalPhoto['tmp_name'])) {
                $personalPhotoName = $this->personalPhoto['name'];
                $personalPhotoTmpName = $this->personalPhoto['tmp_name'];
                $personalPhotoSize = $this->personalPhoto['size'];
                $personalPhotoError = $this->personalPhoto['error'];
                $personalPhotoType = $this->personalPhoto['type'];
                
                $personalPhotoExt = explode('.', $personalPhotoName);
                $personalPhotoActualExt = strtolower(end($personalPhotoExt));
                
                $allowed = array('jpg', 'jpeg', 'png');
                
                if (in_array($personalPhotoActualExt, $allowed)) {
                  if ($personalPhotoError === 0) {
                    if ($personalPhotoSize < 5000000) {
                        /*$personalPhotoNameNew = uniqid('', true) . "." . $personalPhotoActualExt;
                        $personalPhotoDestination = '../upload/profile_picture/' . $personalPhotoNameNew;
                        move_uploaded_file($personalPhotoTmpName, $personalPhotoDestination);*/
                        return "valid";
                    } else {
                      return 'Your photo is too big!';
                    }
                  } else {
                    return 'There was an error uploading your photo!';
                  }
                } else {
                  return 'You cannot upload files of this type!';
                }
            } else {
              return 'You did not upload a photo!';
            }
        }

        private function uploadPersonalPhoto () {
            $personalPhotoName = $this->personalPhoto['name'];
            $personalPhotoTmpName = $this->personalPhoto['tmp_name'];
            
            $personalPhotoExt = explode('.', $personalPhotoName);
            $personalPhotoActualExt = strtolower(end($personalPhotoExt));

            $personalPhotoNameNew = uniqid('', true) . "." . $personalPhotoActualExt;
            $personalPhotoDestination = '../upload/profile_picture/' . $personalPhotoNameNew;
            move_uploaded_file($personalPhotoTmpName, $personalPhotoDestination);
            return $personalPhotoNameNew;
        } 

        // Check if the all input is valid
        private function validInput () {
            $errors = [];
            if ($this->userAlreadyExists() == true || $this->phoneAlreadyExists() == true || $this->idNumberAlreadyExists() == true) {
                array_push($errors, "You are already associated with an existing account");
                return $errors;
            }
            if ($this->emptyInput() == true) {
                array_push($errors, "Input empty");
            }
            if ($this->invalidEmail() == true) {
                array_push($errors, "Invalid email");
            }
            if ($this->invalidPassword() == true) {
                array_push($errors, "Invalid password (Password must be: at least 8 characters, 1 capital letter, 1 small letter, 1 digit, 1 special character)");
            }
            if ($this->passwordsNotMatching() == true) {
                array_push($errors, "Passwords do not match");
            }
            if ($this->invalidPhoneNumber() == true) {
                array_push($errors, "Invalid phone number format");
            }
            if ($this->invalidDOB() == true) {
                array_push($errors, "Invalid date. Date must be in the format DD/MM/YYYY and you must be 18 years old or older");
            }
            if ($this->invalidIDNumber() == true) {
                array_push($errors, "This ID number is invalid");
            }
            if ($this->checkPersonalPhoto() != "valid") {
                array_push($errors, $this->checkPersonalPhoto());
            }
            return $errors;
        }
        // Get the user's ID
        private function getUserId () {
            $stmt = $this->connect()->prepare('SELECT user_id FROM users WHERE username = ?');
            if (!$stmt->execute(array($this->username))) {
                $stmt = null;
                exit();
            }
            return $stmt->fetchAll(PDO::FETCH_ASSOC)[0]['user_id'];
        }

        // Register the user
        public function registerUser () {
            // Create a new AccountController object
            $newAccount = new AccountController();
            // Create a new Encryption object
            $encryption = new Encryption();
            // Check if the all input is valid
            if (count($this->validInput()) == 0) {
                // Insert the user into the database
                $stmt = $this->connect()->prepare('INSERT INTO users (username, pwd_hash, email, full_name, dob, phone_number, id_number, personal_photo) VALUES (?, ?, ?, ?, ?, ?, ?, ?);');
                // Hash the password
                $hashed_pwd = password_hash($this->password, PASSWORD_DEFAULT);
                // Encrypt the ID number
                $encryptedIDNumber = $encryption->encrypt($this->idNumber);

                // Change date format to YYYY-MM-DD for MySQL
                $formattedDOB = str_replace('/', '-', $this->dob);
                $formattedDOB = date('Y-m-d', strtotime($formattedDOB));

                // Remove spaces from phone number
                $formattedPhoneNumber = str_replace(' ', '', $this->phoneNumber);

                // Upload the personal photo
                $personalPhotoNameNew = $this->uploadPersonalPhoto();

                if (!$stmt->execute(array($this->username, $hashed_pwd, $this->email, $this->fullName, $formattedDOB, $formattedPhoneNumber, $encryptedIDNumber, $personalPhotoNameNew))) {
                    $stmt = null;
                    exit();
                }

                $accountType = "";
                if ($this->occupation == "student") {
                    $accountType = "savings";
                } else if ($this->occupation == "employee") {
                    $accountType = "current";
                } else if ($this->occupation == "businessman") {
                    $accountType = "business";
                }

                // Create a new bank account for the user
                $newAccount->createBankAccount($this->getUserId(), $this->idNumber, $accountType);
                // Empty array means no errors and all operations were successful
                return [];
            } else {
                return $this->validInput();
            }
        }
    }
?>