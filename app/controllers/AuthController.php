<?php
// app/controllers/AuthController.php

require_once __DIR__ . '/../core/Controller.php';

class AuthController extends Controller {
    
    // Fungsi untuk menampilkan halaman login
    public function showLogin() {
        // Asumsi method view() ada di base Controller.php
        $this->view('login'); 
    }

    // Fungsi untuk memproses login
    public function login() {
        // Ambil data POST
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        
        // **LOGIKA OTENTIKASI SEDERHANA (DEMO)**
        if (!empty($username) && !empty($password)) {
            // Asumsi berhasil login
            
            // Simulasikan data sesi
            // Dalam aplikasi nyata, ini akan melibatkan pengecekan database
            $role = (strtolower($username) == 'admin') ? 'ADMIN' : 'Karyawan';
            $_SESSION['is_logged_in'] = true;
            $_SESSION['user_id'] = 1; // ID pengguna
            $_SESSION['user_role'] = $role;
            $_SESSION['user_nip'] = '221011001500'; // NIP/ID
            $_SESSION['user_name'] = $username;
            
            // Pindahkan ke halaman beranda
            header('Location: /');
            exit;
        } else {
            // Gagal login, kembali ke halaman login (atau tampilkan pesan error)
            $this->view('login', ['error' => 'Username atau password tidak boleh kosong.']);
        }
    }

    // Fungsi untuk logout
    public function logout() {
        // Hapus semua sesi
        session_start();
        session_unset();
        session_destroy();

        // Pindahkan ke halaman login
        header('Location: /login');
        exit;
    }
}