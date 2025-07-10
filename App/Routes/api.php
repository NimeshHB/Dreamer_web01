<?php

use App\Controllers\ApiController;
use App\Core\Router;

Router::add('GET', '/api/data', [ApiController::class, 'getData']);

?>