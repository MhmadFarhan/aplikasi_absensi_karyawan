<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Portal Absensi</title>
    <link rel="stylesheet" href="/css/style.css"> 
</head>
<body class="login-page">
    <div class="login-card">
        <div class="logo"></div>
        <h2>Portal Absensi</h2>
        <p>PT. SINERGI</p>
        
        <form action="/login" method="POST">
            
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Masukkan Username Anda" required>
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Masukkan Password Anda" required>
            </div>
            
            <div class="form-actions">
                <div>
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Ingatkan Saya</label>
                </div>
                <a href="#">Lupa Password?</a>
            </div>
            
            <button type="submit" class="btn-login">Login</button>
        </form>
        
        <div class="register-link">
            Belum Punya Akun? <a href="#">Daftar Di Sini</a>
        </div>
        
    </div>
</body>
</html>