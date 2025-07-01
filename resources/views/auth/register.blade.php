<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register!</title>
    <link rel="icon" href="{{ asset('admin/img/kaiadmin/favicon.ico') }}" type="image/x-icon" />
    <link rel="stylesheet" href="{{ asset('auth/style.css') }}" />
</head>

<style>
    .form-container {
        max-height: 500px;
        /* Sesuaikan tinggi sesuai kebutuhan */
        overflow-y: auto;
        /* Scrollbar vertikal */
        width: 100%;
        /* Memastikan div mengambil lebar penuh */
        max-width: 400px;
        /* Lebar maksimum form, sesuaikan sesuai kebutuhan */
        padding-right: 20px;
        /* Ruang untuk scrollbar agar tidak menutupi konten */
        box-sizing: border-box;
        /* Memastikan padding tidak menambah lebar */
    }

    /* Optional: Styling untuk memperbaiki tampilan scrollbar */
    .form-container::-webkit-scrollbar {
        width: 10px;
        /* Lebar scrollbar */
    }

    .form-container::-webkit-scrollbar-track {
        background: #f1f1f1;
        /* Warna latar scrollbar */
    }

    .form-container::-webkit-scrollbar-thumb {
        background: #888;
        /* Warna thumb scrollbar */
        border-radius: 5px;
    }

    .form-container::-webkit-scrollbar-thumb:hover {
        background: #555;
        /* Warna thumb saat hover */
    }

    /* Memastikan form di dalam tidak terpengaruh oleh scrollbar */
    .form-container form {
        width: 100%;
        padding: 20px;
        box-sizing: border-box;
    }

    /* Styling untuk form-group agar tidak terpotong */
    .form-group {
        margin-bottom: 15px;
        width: 100%;
    }
</style>

<body>
    <div class="login-container">
        <div class="login-header">
            <h1>Selamat Datang!</h1>
            <p>Silahkan Daftarkan diri anda!</p>
        </div>
        <!-- resources/views/auth/login.blade.php -->
        <div class="form-container">
            <form action="{{ url('login') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="identifier">Username</label>
                    <input type="text" id="username" name="username" placeholder="Username"
                        value="{{ old('username') }}" required />
                    @error('username')
                        <span class="text-light" style="color: white">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="identifier">Nama Lengkap</label>
                    <input type="text" id="nama_lengkap" name="nama_lengkap" placeholder="Nama Lengkap"
                        value="{{ old('nama_lengkap') }}" required />
                    @error('nama_lengkap')
                        <span class="text-light" style="color: white">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">NIM</label>
                    <input type="text" id="nim" name="nim" placeholder="NIM" value="{{ old('nim') }}"
                        required />
                    @error('nim')
                        <span class="text-light" style="color: white">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" id="email" name="email" placeholder="email" value="{{ old('email') }}"
                        required />
                    @error('email')
                        <span class="text-light" style="color: white">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="••••••••" required />
                    @error('password')
                        <span class="text-light" style="color: white">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="remember-forgot">
                    <div class="remember-me">
                        <input type="checkbox" id="remember" name="remember" />
                        <label for="remember">Remember me</label>
                    </div>
                    <a href="#" class="forgot-password">Forgot Password?</a>
                </div>
                <button type="submit" class="login-button">
                    Sign in to your account
                </button>
                <div class="signup-link">
                    Don't have an account? <a href="#">Create account</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
