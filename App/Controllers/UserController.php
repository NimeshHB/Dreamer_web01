<?php
namespace App\Controllers;

use App\Core\View;

class UserController {

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

}

?>
