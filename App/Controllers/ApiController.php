<?php
//
namespace App\Controllers;

//import classes
use App\Models\AuthHandler As Auth;
use App\Core\DatabaseManager;
//
class ApiController {
    //testing api
    public function getData() {
        echo json_encode(["status" => "success", "data" => ["message" => "API is working!"]]);
    }

    // reg api
    public function authReg(){

        $data = json_decode(file_get_contents("php://input"), true);

        $name = $data['name'] ?? '';
        $email = $data['email'] ?? '';
        $password = $data['password'] ?? '';
        $clientKey = $data['key'] ?? '';

        $secretKey = "Test@2025";  // Must match the frontend

        // Server generates HMAC just like the frontend
        $expectedKey = hash_hmac('sha256', $name . $email . $password, $secretKey);

        if (hash_equals($expectedKey, $clientKey)) {
            //
            $user_type_id = 1; // student
            $user_status_id = 2; // inactive
            $response = Auth::register($name, $email, $password, $user_type_id, $user_status_id);

            echo json_encode($response);
        } else {
            echo json_encode([
                "status" => "failed",
                "message" => "Invalid credentials!"
            ]);
        }      
    }

    //login api
    public function authLogin(){
 
        $data = json_decode(file_get_contents("php://input"), true);

        $username = $data['email'] ?? '';
        $password = $data['password'] ?? '';
        $clientKey = $data['key'] ?? '';

        $secretKey = "Test@2025";  // Must match the frontend

        // Server generates HMAC just like the frontend
        $expectedKey = hash_hmac('sha256', $username . $password, $secretKey);

        if (hash_equals($expectedKey, $clientKey)) {
            $response = Auth::login($username, $password);
            echo json_encode($response);
        } else {
            echo json_encode([
                "status" => "failed",
                "message" => "Invalid credentials!"
            ]);
        }      
    }

}


?>