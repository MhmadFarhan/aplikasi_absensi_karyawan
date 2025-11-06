<?php
// app/views/presensi_success.php

// Data sukses sudah diekstrak dari Controller
$userData = ['role' => 'Karyawan', 'nip' => '221011001500', 'name' => $name ?? 'Pengguna'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presensi Berhasil - PT. SINERGI</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>

    <header class="header">
        <h1 class="header-title">PT.SINERGI</h1>
    </header>
    
    <div class="main-container">
        <main class="content no-sidebar">
            
        <div class="success-card">
            <h2>✅ Presensi Berhasil!</h2>
            
                <img src="<?= htmlspecialchars($photo_url ?? '') ?>" alt="Foto Presensi">
                
                <p>Halo, **<?= htmlspecialchars($name ?? 'Pengguna') ?>**.</p>
                
                <p>Anda telah berhasil melakukan Presensi Hadir pada:</p>
                
                <h3>Pukul <?= htmlspecialchars($time ?? '--:--:--') ?></h3>
                
                <a href="/" class="btn-login" style="width: auto; padding: 10px 25px;">Kembali ke Beranda</a>
            </div>
        </main>
    </div>
</body>
</html>