<?php
namespace App\Controllers;

class ApiController {
    //testing api
    public function getData() {
        echo json_encode(["status" => "success", "data" => ["message" => "API is working!"]]);
    }

   //login api
   public function authLogin(){

        $data = json_decode(file_get_contents("php://input"), true);

        $username = $data['username'] ?? '';
        $password = $data['password'] ?? '';
        $clientKey = $data['key'] ?? '';

        $secretKey = "Test@2025";  // Must match the frontend

        // Server generates HMAC just like the frontend
        $expectedKey = hash_hmac('sha256', $username . $password, $secretKey);

        if (hash_equals($expectedKey, $clientKey)) {
            echo json_encode([
                "status" => "success",
                "message" => "Login successful!"
            ]);
        } else {
            echo json_encode([
                "status" => "failed",
                "message" => "Invalid credentials!"
            ]);
        }      
   }

}


?>