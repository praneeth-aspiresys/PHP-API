<?php
// PHP Project - Main Entry Point

require_once './app.php';
require_once './routeController.php';




// index.php
$request = $_SERVER['REQUEST_URI'];
 $routeConfig = new routeController();
 $routeConfig :: route();
?>