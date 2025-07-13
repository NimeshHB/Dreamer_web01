<?php
// Start session
session_start();

//autoloader
require_once __DIR__ . '/App/Core/Autoloader.php';

//router
use App\Core\Router;

// Initialize the router
Router::init();

?>