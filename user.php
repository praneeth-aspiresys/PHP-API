<?php
require_once './db.php';

interface curdOperations{
    public function handleGet();
    public function handlePost(array $input);
    public function handlePut(array $input);
    public function handleDelete(array $input);
    function userValidation(array $input);
}

class user implements curdOperations
{
    function __construct() {
      
        header("Content-Type: application/json");
    require_once './config.php';
    $method = $_SERVER['REQUEST_METHOD'];
    $input = json_decode(file_get_contents('php://input'), true);

    switch ($method) {
        case 'GET':
          $this->handleGet();
            break;
        case 'POST':
            $this->handlePost($input);
            break;
        case 'PUT':
            $this->handlePut( $input);
            break;
        case 'DELETE':
            $this->handleDelete( $input);
            break;
        default:
            echo json_encode(['message' => 'Invalid request method']);
            break;
    }
    }
   

    public function handleGet() {
        $sql = "SELECT * FROM userInfo";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($result);
    }

    function handlePost( $input) {
        $sql = "INSERT INTO userInfo (name, email,city) VALUES (:name, :email,:city)";
        $params = ['name' => $input['name'], 'email' => $input['email'],'city'=> $input['city']];
       $db = new DBConfig();
      $data = $db->executeQuery($sql,$params);
      echo json_encode([error,'message' => 'User updated successfully']);
    }

    function handlePut( $input) {
        
        $sql = "UPDATE userInfo SET name = :name, email = :email,city = :city WHERE id = :id";
        $params=['name' => $input['name'], 'email' => $input['email'],'city'=> $input['city'],'id'=>$input['id']];
       
           
           
        try {
            $valid= $this->userValidation($input);

        
            if($valid['error']){
             throw new Exception($valid['message']);
            }
  
        $db = new DBConfig();
        $data = $db->executeQuery($sql,$params);
       
        echo json_encode([
        "success" => true,
        "error" => [
            "code" => '200',
            "message" =>'User updated successfully'
        ]
    ]);
        } catch (\Throwable $e) {
          
            $code = $e->getCode() ?: 500; // Use exception code or default to 500
    http_response_code($code);
    
    echo json_encode([
        "success" => false,
        "error" => [
            "code" => $code,
            "message" => $e->getMessage()
        ]
    ]);
        }
       
    }

    function handleDelete( $input) {
        $sql = "DELETE FROM userInfo WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $input['id']]);
        echo json_encode(['message' => 'User deleted successfully']);
    }

    function  userValidation($input){
      
        if(!filter_var( $input['email'],FILTER_VALIDATE_EMAIL) && $input['email'] === null || $input['email'] === ""){
         return ['error'=>true,'message'=> 'email is not valid..!!'];
        }elseif($input['name'] === null || $input['name'] === ""){
       return ['error'=>true,'message'=> 'name is not valid..!!'];
        }
        else{
             return ['error'=>false,'message'=> ''];
        }
    }
}
?>