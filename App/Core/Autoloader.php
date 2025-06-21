<?php
spl_autoload_register(function ($class) {
    $file = __DIR__ . '/../../' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }else{
        echo "file not found";
    }
});

// Auto-load core files (only once)
$coreFiles = ['Router', 'View'];
foreach ($coreFiles as $file) {
    require_once __DIR__ . "/$file.php";
}

?>