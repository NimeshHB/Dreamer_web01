<?php
namespace App\Controllers;

//import classes
use App\Models\AuthHandler As Auth;
use App\Core\View;

class UserController {
    //error - 404
    public function error404(){
        $data = ['title' => 'Error 404 - Dreamer Nihongo Academy', 'message' => 'webview'];
        View::render('user-ui/404', $data, 'user-layout');        
    }

    //register
    public function register() {
        $data = ['title' => 'Register - Dreamer Nihongo Academy', 'message' => 'webview'];
        View::render('user-ui/register', $data, 'user-layout');
    }

    //login
    public function login() {
        $data = ['title' => 'Login - Dreamer Nihongo Academy', 'message' => 'webview'];
        View::render('user-ui/login', $data, 'user-layout');
    }

    //logout
    public function logout() {
        Auth::logout();
    }

    //dashboard
    public function dashboard() {
        Auth::status();
        $type = Auth::type();

        $data = ['title' => 'Dashboard - Dreamer Nihongo Academy', 'message' => 'webview'];
        View::render("user-ui/{$type}-dashboard", $data, 'user-layout');
    }

}

?>
