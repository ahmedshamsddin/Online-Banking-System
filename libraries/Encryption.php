<?php
    require_once __DIR__ . '/../vendor/autoload.php';

    $dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
    $dotenv->load();
    
    class Encryption {

        // Function to encrypt the data
        public static function encrypt($data) {
            $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('AES-256-CBC'));
            $encryptedData = openssl_encrypt($data, 'AES-256-CBC', $_ENV['KEY'], 0, $iv);
            //return base64_encode($iv . $encryptedData);
            return $iv . $encryptedData;
        }

        // Function to decrypt the data
        public static function decrypt($encryptedData) {
            //$encryptedData = base64_decode($encryptedData);
            $iv = substr($encryptedData, 0, openssl_cipher_iv_length('AES-256-CBC'));
            $encryptedData = substr($encryptedData, openssl_cipher_iv_length('AES-256-CBC'));
            $decryptedData = openssl_decrypt($encryptedData, 'AES-256-CBC', $_ENV['KEY'], 0, $iv);
            return $decryptedData;
        }

        public static function compare ($data, $encryptedData) {
            $decryptedData = self::decrypt($encryptedData);
            return $data === $decryptedData;
        }
    }
?>