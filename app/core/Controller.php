<?php
// app/core/Controller.php

class Controller {
    
    // Metode dasar untuk memuat view
    public function view($view, $data = []) {
        // Tentukan path ke file view
        // __DIR__ adalah app/core, jadi kita mundur satu langkah (../) ke app/, lalu masuk ke views/
        $viewPath = __DIR__ . '/../views/' . $view . '.php';
        
        if (file_exists($viewPath)) {
            // Ekstrak data array agar menjadi variabel
            extract($data); 
            // Memuat file view
            require_once $viewPath;
        } else {
            // Handle error (View tidak ditemukan)
            die("View '$view' tidak ditemukan. Jalur yang dicari: $viewPath");
        }
    }
    
    // Anda bisa tambahkan metode model() di sini jika diperlukan
}