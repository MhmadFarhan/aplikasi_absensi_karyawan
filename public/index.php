<?php
// public/index.php (Entry point aplikasi)

// Inisialisasi sesi di awal
session_start();

// Asumsi basis aplikasi adalah folder 'app'
define('APP_PATH', dirname(__DIR__) . '/app/');

// --- FUNGSI AUTOLOAD DASAR ---
spl_autoload_register(function ($class) {
    // Controller
    $controllerPath = APP_PATH . 'controllers/' . $class . '.php';
    if (file_exists($controllerPath)) {
        require_once $controllerPath;
        return;
    }
    
    // Core (Controller, Model, Database, Router)
    $corePath = APP_PATH . 'core/' . $class . '.php';
    if (file_exists($corePath)) {
        require_once $corePath;
        return;
    }

    // Models
    $modelPath = APP_PATH . 'models/' . $class . '.php';
    if (file_exists($modelPath)) {
        require_once $modelPath;
        return;
    }
});

// --- ROUTING SEDERHANA (DIPERBAIKI) ---

// 1. Tentukan Base Path Aplikasi (Contoh: /kasir_app/public)
// Ambil path dari script yang dijalankan, dan bersihkan path filenya
$basePath = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
// Hapus slash di awal/akhir
$basePath = trim($basePath, '/'); 

// 2. Ambil URI yang diminta (hapus slash di awal/akhir)
$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

// 3. LOGIKA PERBAIKAN: Hapus BASE_PATH dari awal URI
if (!empty($basePath) && strpos($uri, $basePath) === 0) {
    // Hapus base path (misal 'kasir_app/public')
    $uri = substr($uri, strlen($basePath)); 
    // Hapus slash yang tersisa
    $uri = trim($uri, '/');
}

// Tentukan rute dan aksi (Controller@method)
// FORMAT: ['uri', 'Controller', 'method', 'HTTP_Method']
$routes = [
    ['', 'HomeController', 'index', 'GET'],

    // Login
    ['login', 'AuthController', 'showLogin', 'GET'],
    ['login', 'AuthController', 'login', 'POST'],
    ['logout', 'AuthController', 'logout', 'GET'],

    // 🟢 Tambahkan rute presensi di sini
    ['presensi', 'PresensiController', 'index', 'GET'],
    ['presensi/submit', 'PresensiController', 'submit', 'POST'],
    ['presensi/success', 'PresensiController', 'success', 'GET'],
];



$method = $_SERVER['REQUEST_METHOD'];
$found = false;

// Iterasi melalui array rute
foreach ($routes as $routeAction) {
    if (count($routeAction) < 4) continue;
    
    list($routeUri, $controllerName, $methodName, $httpMethod) = $routeAction;
    
    // Cocokkan URI DAN HTTP Method
    if ($uri === $routeUri && $method === $httpMethod) {
        if (class_exists($controllerName)) {
            $controller = new $controllerName();
            $controller->$methodName();
            $found = true;
            break;
        }
    }
}

// Jika rute tidak ditemukan
if (!$found) {
    http_response_code(404);
    echo "<h1>404 Halaman Tidak Ditemukan</h1>";
}