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

    //logout
    public function logout() {
        // Destroy all session data
        session_unset();     // Unset all session variables
        session_destroy();   // Destroy the session

        // Optional: Delete session cookie
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        // Redirect to login page
        header("Location: /login?logout=success"); //
        exit;
    }

    //dashboard
    public function dashboard() {
        //check session 
        if (!isset($_SESSION['user_id'])) {
            // Redirect to login page
            header("Location: /login?failed"); //
            exit;
        }

        $data = ['title' => 'Dashboard - Dreamer Nihongo Academy', 'message' => 'webview'];
        View::render('user-ui/dashboard', $data, 'user-layout');
    }

}

?>
