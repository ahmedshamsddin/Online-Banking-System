<?php
    require_once __DIR__ . '/../vendor/autoload.php';

    $dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
    $dotenv->load();

    class DB {
        public function connect () {
            try {
                $db = new PDO('mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_DATABASE'] . ';', $_ENV['DB_USER'], $_ENV['DB_PASS']);
                return $db;
            } catch (PDOException $e) {
                print "Error!!:" . $e->getMessage() . "<br>";
                die();
            }
        }
    }
?>