<?php

namespace App\Core;

class View {
    public static function render(string $view, array $data = [], string $layoutName) {
        $viewFile = __DIR__ . '/../../App/Views/' . $view . '.php';
        if (file_exists($viewFile)) {
            extract($data);
            require __DIR__ . '/../../App/Views/'.$layoutName.'.php';
        } else {
            echo "View not found!";
        }
    }
}

?>