<?php
namespace App\Controllers;

use App\Core\View;

class HomeController {
    // home
    public function index() {
        $data = ['title' => 'Home - Dreamer Nihongo Academy', 'message' => 'webview'];
        View::render('surf-ui/home', $data, 'surf-layout');
    }

    //about
    public function about() {
        $data = ['title' => 'About - Dreamer Nihongo Academy', 'message' => 'webview'];
        View::render('surf-ui/about', $data, 'surf-layout');
    }

    //courses
    public function courses() {
        $data = ['title' => 'Courses - Dreamer Nihongo Academy', 'message' => 'webview'];
        View::render('surf-ui/courses', $data, 'surf-layout');
    }

    //trainers
    public function trainers() {
        $data = ['title' => 'Trainers - Dreamer Nihongo Academy', 'message' => 'webview'];
        View::render('surf-ui/trainers', $data, 'surf-layout');
    }

    //events
    public function events() {
        $data = ['title' => 'Events - Dreamer Nihongo Academy', 'message' => 'webview'];
        View::render('surf-ui/events', $data);
    }

    //contact
    public function contact() {
        $data = ['title' => 'Contact - Dreamer Nihongo Academy', 'message' => 'webview'];
        View::render('surf-ui/contact', $data, 'surf-layout');
    }

    //price
    public function price() {
        $data = ['title' => 'Price - Dreamer Nihongo Academy', 'message' => 'webview'];
        View::render('surf-ui/price', $data, 'surf-layout');
    }


}

?>