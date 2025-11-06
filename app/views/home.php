<?php
// Contoh data pengguna (seharusnya diambil dari sesi atau database)
$userData = [
    'role' => $data['user']['role'] ?? 'Karyawan', // Diteruskan dari Controller
    'nip' => $data['user']['nip'] ?? '221011001500', // Diteruskan dari Controller
    'name' => $data['user']['name'] ?? 'Pengguna',
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda/Home - Portal Absensi</title>
    <link rel="stylesheet" href="/css/style.css"> 
    <style>
        /* Gaya dasar untuk icon hamburger, biasanya menggunakan font-icon seperti Font Awesome */
        /* Untuk demo, kita pakai simbol unicode */
        .menu-icon::before {
            content: "\2261"; /* Simbol tiga garis horizontal (hamburger) */
        }
    </style>
</head>
<body>

    <header class="header">
        <span class="menu-icon" onclick="toggleSidebar()"></span> 
        <h1 class="header-title">Beranda/Home</h1>
    </header>

    <div class="main-container">
        
        <aside class="sidebar" id="sidebar">
            <div class="user-profile">
                <div class="profile-circle"></div>
                <p class="profile-name"><?= htmlspecialchars($userData['role']) ?></p>
                <p class="profile-nip"><?= htmlspecialchars($userData['nip']) ?></p>
            </div>
            
            <ul class="sidebar-menu">
                <li><a href="/" class="active">Beranda</a></li>
                <li><a href="/presensi">Presensi</a></li>
                <li><a href="/logout" class="logout">Keluar</a></li>
            </ul>
        </aside>

        <main class="content">
            <h2>Selamat Datang, <?= htmlspecialchars($userData['name']) ?>!</h2>
            <p>Ini adalah halaman Beranda Portal Absensi Anda.</p>
        </main>
        
    </div>
    
    <script>
        // Fungsi sederhana untuk simulasi toggle sidebar (opsional)
        function toggleSidebar() {
            // Dalam implementasi nyata, ini akan mengontrol kelas CSS untuk menyembunyikan/menampilkan sidebar
            console.log("Toggle Sidebar diklik.");
            // Untuk demo ini, kita tidak akan mengimplementasikan logika penyembunyian kompleks
        }
    </script>
</body>
</html>