<?php
// app/controllers/PresensiController.php

require_once __DIR__ . '/../core/Controller.php';

class PresensiController extends Controller {
    public function index() {
        session_start();

        // Pastikan user sudah login
        if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
            header('Location: /login');
            exit;
        }

        // Ambil pesan sukses/error dari session (jika ada)
        $success = $_SESSION['presensi_success'] ?? null;
        $error = $_SESSION['presensi_error'] ?? null;

        // Hapus setelah ditampilkan
        unset($_SESSION['presensi_success'], $_SESSION['presensi_error']);

        // Kirim data ke view presensi
        $data = [
            'success' => $success,
            'error' => $error
        ];

        // Tampilkan halaman form presensi
        $this->view('presensi', $data);
    }
    // Direktori tempat menyimpan file foto presensi (harus dapat ditulis)
    const UPLOAD_DIR = 'public/uploads/presensi/';
    
    public function submit() {
        session_start();

        // 1. Cek Autentikasi
        if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
            header('Location: /login');
            exit;
        }

        // Pastikan request method adalah POST dan file foto ada
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_FILES['foto_presensi']['name'])) {
            header('Location: /presensi'); // Kembali jika akses tidak valid
            exit;
        }
        
        $user_name = $_SESSION['user_name'] ?? 'Pengguna';
        $user_nip = $_SESSION['user_nip'] ?? 'NIP_UNKNOWN';
        
        // Buat folder upload jika belum ada
        if (!is_dir(self::UPLOAD_DIR)) {
            mkdir(self::UPLOAD_DIR, 0777, true);
        }

        $file = $_FILES['foto_presensi'];
        
        // Generate nama file unik
        $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $new_file_name = $user_nip . '_' . date('Ymd_His') . '.' . $file_extension;
        $upload_path = self::UPLOAD_DIR . $new_file_name;

        // 2. Proses Upload Foto
        if (move_uploaded_file($file['tmp_name'], $upload_path)) {
            
            // Simulasikan penyimpanan data ke database (fungsionalitas DB akan dibuat nanti)
            $presensi_time = date('H:i:s');
            
            // 3. Set Pesan Sukses dan Redirect
            $_SESSION['presensi_success'] = [
                'name' => $user_name,
                'time' => $presensi_time,
                'photo' => $new_file_name, // Nama file untuk ditampilkan
            ];
            
            // Redirect ke halaman sukses (atau halaman presensi dengan pesan)
            header('Location: /presensi/success');
            exit;
            
        } else {
            // Gagal upload
            $_SESSION['presensi_error'] = 'Gagal mengunggah foto. Coba lagi.';
            header('Location: /presensi');
            exit;
        }
    }
    
    // Method baru untuk menampilkan halaman sukses
    public function success() {
        session_start();
        
        // Ambil data sukses dari session
        $success_data = $_SESSION['presensi_success'] ?? null;
        unset($_SESSION['presensi_success']); // Hapus data sukses setelah diambil

        if (!$success_data) {
            header('Location: /presensi');
            exit;
        }

        // Tampilkan view sukses
        $data = [
            'success' => true,
            'name' => $success_data['name'],
            'time' => $success_data['time'],
            'photo_url' => '/' . self::UPLOAD_DIR . $success_data['photo']
        ];

        // Memuat view baru untuk notifikasi sukses
        $this->view('presensi_success', $data);
    }
}