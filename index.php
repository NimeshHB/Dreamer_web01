<?php
// Start session
session_start();
session_regenerate_id(true);

//autoloader
require_once __DIR__ . '/App/Core/Autoloader.php';

//router
use App\Core\Router;

// Initialize the router
Router::init();

?>