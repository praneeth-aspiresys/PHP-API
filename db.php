<?php
include './config.php';

class DBConfig{
   public  $pdo;
    public function __construct(){
       
       
       
}
public function executeQuery($query,$params){
    $config = require './config.php';
     try {
            
   $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
   $stmt = $pdo->prepare($query);
        $stmt->execute($params);
  echo json_encode(['message' => 'User created successfully']);
    echo('DB connection success');
} catch (PDOException $e) {
     throw new Exception("Database connection failed", 500);
    die("Connection failed: " . $e->getMessage());
    
}
    
}

}
?>