<?php 
    $userData = $data['user'] ?? ['role' => 'ADMIN', 'nip' => '221011001500', 'name' => 'Administrator']; 
    
    // Data dummy daftar absensi
    $absensiList = [
        ['name' => 'Alex Smith', 'jabatan' => 'CEO', 'status' => 'Belum Hadir'],
        ['name' => 'Claretta Jane', 'jabatan' => 'Sekretaris', 'status' => 'Belum Hadir'],
        ['name' => 'Jeny Jen', 'jabatan' => 'Asisten Manager', 'status' => 'Belum Hadir'],
        ['name' => 'Jasper Raynold', 'jabatan' => 'Manager', 'status' => 'Belum Hadir'],
        ['name' => 'Kent Murphy', 'jabatan' => 'Karyawan', 'status' => 'Belum Hadir'],
    ];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar absensi Karyawan - PT. SINERGI</title>
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
            <p>Daftar Karyawan</p>
            
            <div class="table-container">
                <table class="absensi-table">
                    <thead>
                        <tr>
                            <th>NAMA MAHASISWA</th>
                            <th>Jabatan</th>
                            <th>AKSI</th>
                            <th>Jam Kehadiran</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($absensiList as $absen): ?>
                        <tr>
                            <td><?= htmlspecialchars($absen['name']) ?></td>
                            <td><?= htmlspecialchars($absen['jabatan']) ?></td>
                            <td><a href="/user/detail/<?= urlencode($absen['name']) ?>" class="btn-detail">Detail</a></td>
                            <td><?= htmlspecialchars($absen['status']) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            
        </main>
    </div>
    
    <script>
        function toggleSidebar() { console.log("Toggle Sidebar..."); }
    </script>
</body>
</html>