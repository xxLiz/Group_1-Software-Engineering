<?php
require __DIR__.'/vendor/autoload.php';

class DatabaseConnection {
    private $conn;
    public function __construct() {
        $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
        $dotenv->load();

        // Database configuration
        $servername = $_ENV['DB_HOST'];
        $port = $_ENV['DB_PORT'];
        $username = $_ENV['DB_USER_NAME'];
        $password = $_ENV['DB_PASSWORD'];
        $dbname = $_ENV['DB'];

        // Create connection
        $this->conn = new \mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getConnection() {
        return $this->conn;
    }

    public function closeConnection() {
        $this->conn->close();
    }
}

