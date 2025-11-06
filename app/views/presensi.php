<?php 
    $userData = $data['user'] ?? ['role' => 'Karyawan', 'nip' => '221011001500', 'name' => 'Pengguna']; 
    $headerTitle = "Absensi Harian";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($headerTitle) ?> - PT. SINERGI</title>
    <link rel="stylesheet" href="/css/style.css"> 
</head>
<body>

    <header class="header">
        <span class="menu-icon" onclick="toggleSidebar()"></span> 
        <h1 class="header-title">PT.SINERGI</h1> 
    </header>

    <div class="main-container">
        
        <aside class="sidebar" id="sidebar">
            <div class="user-profile">
                <div class="profile-circle"></div>
                <p class="profile-name"><?= htmlspecialchars($userData['role']) ?></p>
                <p class="profile-nip"><?= htmlspecialchars($userData['nip']) ?></p>
            </div>
            
            <ul class="sidebar-menu">
                <li><a href="/">Beranda</a></li>
                <li><a href="/presensi" class="active">Presensi</a></li>
                <li><a href="/logout" class="logout">Keluar</a></li>
            </ul>
        </aside>

        <main class="content">
            <h2>PRESENSI KARYAWAN</h2>
            
            <div class="presensi-card">
                <form action="/presensi/submit" method="POST" enctype="multipart/form-data">
                    
                    <div class="upload-area">
                        <label for="foto_presensi" style="cursor: pointer;">Upload Foto</label>
                        <input type="file" id="foto_presensi" name="foto_presensi" accept="image/*" required style="display: none;">
                    </div>
                    
                    <div class="presensi-actions">
                        <button type="submit" class="btn-login">Hadir</button>
                    </div>
                </form>
            </div>
            
        </main>
    </div>
    
    <script>
        function toggleSidebar() { console.log("Toggle Sidebar..."); } 
    </script>
</body>
</html>