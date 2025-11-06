<?php
// app/controllers/HomeController.php

require_once __DIR__ . '/../core/Controller.php';

class HomeController extends Controller {
    
    // Fungsi untuk menampilkan halaman beranda/home
    public function index() {
        session_start();
        
        // Cek apakah pengguna sudah login
        if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
            header('Location: /login');
            exit;
        }

        // Data yang akan dikirim ke view home.php
        $data = [
            'user' => [
                'role' => $_SESSION['user_role'] ?? 'Karyawan',
                'nip'  => $_SESSION['user_nip'] ?? '221011001500',
                'name' => $_SESSION['user_name'] ?? 'Pengguna'
            ]
        ];
        
        // Tampilkan view home
        $this->view('home', $data); 
    }
    
    // Fungsi untuk menampilkan halaman Presensi
    public function presensi() {
        session_start();
        
        if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
            header('Location: /login');
            exit;
        }
        
        // Ambil data user dari sesi
        $data = [
            'user' => [
                'role' => $_SESSION['user_role'] ?? 'Karyawan',
                'nip'  => $_SESSION['user_nip'] ?? '221011001500',
                'name' => $_SESSION['user_name'] ?? 'Pengguna'
            ]
        ];

        // LOGIKA PENGARAHAN VIEW BERDASARKAN ROLE
        if ($data['user']['role'] === 'ADMIN') {
            // ADMIN melihat daftar absensi (user_index.php)
            $this->view('user_index', $data); 
        } else {
            // Karyawan melakukan absensi (presensi.php)
            $this->view('presensi', $data); 
        }
    }
}