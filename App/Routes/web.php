<?php

use App\Controllers\HomeController;
use App\Controllers\UserController;
use App\Core\Router;

// home controller
Router::add('GET', '/', [HomeController::class, 'index']);

// surf ui 
Router::add('GET', '/home', [HomeController::class, 'index']);
Router::add('GET', '/about', [HomeController::class, 'about']);
Router::add('GET', '/courses', [HomeController::class, 'courses']);
Router::add('GET', '/trainers', [HomeController::class, 'trainers']);
Router::add('GET', '/events', [HomeController::class, 'events']);
Router::add('GET', '/contact', [HomeController::class, 'contact']);
Router::add('GET', '/price', [HomeController::class, 'price']);


// user controller 
Router::add('GET', '/register', [UserController::class, 'register']);
Router::add('GET', '/login', [UserController::class, 'login']);
Router::add('GET', '/logout', [UserController::class, 'logout']);
//
Router::add('GET', '/dashboard', [UserController::class, 'dashboard']);

?>