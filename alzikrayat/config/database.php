<?php
/**
 * Database Singleton Class
 * Manages the PDO connection to MySQL without third-party ORMs.
 */
class Database {
    private static $instance = null;
    private $conn;

    private function __construct() {
        $host = 'localhost';
        $db_name = 'alzikrayat_db';
        $username = 'root';
        $password = ''; // Default XAMPP password is empty

        try {
            $this->conn = new PDO("mysql:host=" . $host . ";dbname=" . $db_name, $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
    }

    // Get the single instance of the database connection
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    // Get the active PDO connection
    public function getConnection() {
        return $this->conn;
    }
}
?>