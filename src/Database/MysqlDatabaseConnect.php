<?php
namespace App\Database;

use PDO;
use App\Contracts\Database\DatabaseConnectInterface;

class MysqlDatabaseConnect extends Database   implements DatabaseConnectInterface{
    private static $instance;
    private $pdo;

    private function __construct() {
        // Private constructor to prevent instantiation
        $host = 'your_database_host';
        $dbname = 'your_database_name';
        $username = 'your_username';
        $password = 'your_password';

        // Create a PDO instance
        $this->pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        // Set PDO to throw exceptions for errors
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function getConnection() {
        return $this->pdo;
    }

    private function __clone() {
        // Private clone method to prevent cloning of the instance
    }

    private function __wakeup() {
        // Private unserialize method to prevent unserializing of the instance
    }

}