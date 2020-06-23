<?php

// config.phpとは別のDBコネクト例
class DB {
    private $con;
    private $host = "localhost";
    private $dbname = "workout";
    private $user = "root";
    private $password = "root";

    public function __construct() {
      $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->dbname;
      
      try {
        $this->con = new PDO($dsn, $this->user, $this->password);
        $this->con->setAttribute(PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION);
        echo "Connection Succesful";
      } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage(); 
      }
    }

    public function viewData() {
        $query = "SELECT name FROM user";
        $stmt = $this->con->prepare($query);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function searchData($name) {
        $query = "SELECT name FROM user WHERE name LIKE :name";
        $stmt = $this->con->prepare($query);
        $stmt->execute(["name" => "%" . $name . "%"]);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
}