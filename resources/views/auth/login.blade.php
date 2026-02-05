<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login!</title>
    <link rel="icon" href="{{ asset('admin/img/kaiadmin/favicon.ico') }}" type="image/x-icon" />
    <link rel="stylesheet" href="{{ asset('auth/style.css') }}" />
</head>

<body>
    <div class="login-container">
        <div class="login-header">
            <h1>Selamat Datang!</h1>
            <p>Masukkan data Anda untuk mengakses akun!</p>
        </div>
        <!-- resources/views/auth/login.blade.php -->

        <form action="{{ url('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="identifier">NIM</label>
                <input type="text" id="identifier" name="identifier" placeholder="Masukkan NIM atau Username"
                    value="{{ old('identifier') }}" required />
                @error('identifier')
                    <span class="text-light" style="color: white">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">Sandi</label>
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
                    <label for="remember">Ingat saya</label>
                </div>
                <a href="#" class="forgot-password">Lupa sandi?</a>
            </div>
            <button type="submit" class="login-button">
                Masuk ke akun Anda
            </button>
            <div class="signup-link">
                Belum punya akun? <a href="{{ url('register') }}">Buat akun</a>
            </div>
        </form>

    </div>
</body>

</html>
