<?php

use App\Controllers\ApiController;
use App\Core\Router;

Router::add('GET', '/api/data', [ApiController::class, 'getData']);
Router::add('POST', '/api/login', [ApiController::class, 'authLogin']);
Router::add('POST', '/api/register', [ApiController::class, 'authReg']);

?>