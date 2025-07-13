<?php
namespace App\Controllers;

class ApiController {
    public function getData() {
        echo json_encode(["status" => "success", "data" => ["message" => "API is working!"]]);
    }
}


?>