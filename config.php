<?php
$host = "localhost";
$user = "localconnect";
$password = "Test@123";
$dbname = "logvalues";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo('DB connection success');
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>