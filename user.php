<?php
require_once './db.php';

class user
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
        $sql = "UPDATE users SET name = :name, email = :email,city = :city WHERE id = :id";
        $params=['name' => $input['name'], 'email' => $input['email'],'city'=> $input['city'],'id'=>$input['id']];
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        echo json_encode(['message' => 'User updated successfully']);
    }

    function handleDelete( $input) {
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $input['id']]);
        echo json_encode(['message' => 'User deleted successfully']);
    }
}
?>