<?php
class Database {
    private $host = "localhost:3307";
    private $db_name = "internet_application";
    private $username = "root";
    private $password = "oliviamumbi2010";
    public $conn;
    public function getConnection() {
        $this->conn = null;
        try {
            
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connection successful";
        } catch(PDOException $exception) {
            
            echo "Connection error: " . $exception->getMessage() . "<br>";
        }
        return $this->conn;
    }
}
