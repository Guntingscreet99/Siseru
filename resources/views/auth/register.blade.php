<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Register!</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center bg-[#161B2E] p-4">
    <div class="bg-[#161B2E] rounded-2xl p-8 max-w-md w-full shadow-lg">
        <h1 class="text-[#6B56F9] font-extrabold text-3xl mb-2">Selamat Datang!</h1>
        <p class="text-[#7B7B8B] mb-8 text-sm">Masukkan data Anda untuk mengakses akun!</p>

        <form action="{{ url('register/store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="fullname" class="block text-[#7B7B8B] font-semibold mb-1">Nama Lengkap</label>
            <input id="fullname" name="nama_lengkap" type="text" value="{{ old('nama_lengkap') }}"
                placeholder="Masukkan Nama Lengkap"
                class="w-full bg-[#1E223D] border border-[#3B3F5C] rounded-md py-2 px-3 mb-4 text-[#5B5F7D] placeholder-[#5B5F7D] focus:outline-none focus:ring-2 focus:ring-[#6B56F9] focus:border-transparent transition @error('nama_lengkap') is-invalid @enderror" />
            <label for="nim" class="block text-[#7B7B8B] font-semibold mb-1">NIM</label>
            <input id="nim" type="text" name="nim" placeholder="Masukkan NIM" value="{{ old('nim') }}"
                class="w-full bg-[#1E223D] border border-[#3B3F5C] rounded-md py-2 px-3 mb-4 text-[#5B5F7D] placeholder-[#5B5F7D] focus:outline-none focus:ring-2 focus:ring-[#6B56F9] focus:border-transparent transition @error('nim') is-invalid @enderror" />
            <label for="phone" class="block text-[#7B7B8B] font-semibold mb-1">No HP</label>
            <input id="no_hp" type="tel" name="no_hp" placeholder="Masukkan No HP" value="{{ old('no_hp') }}"
                class="w-full bg-[#1E223D] border border-[#3B3F5C] rounded-md py-2 px-3 mb-4 text-[#5B5F7D] placeholder-[#5B5F7D] focus:outline-none focus:ring-2 focus:ring-[#6B56F9] focus:border-transparent transition @error('no_hp') is-invalid @enderror" />
            <label for="password" class="block text-[#7B7B8B] font-semibold mb-1">Sandi</label>
            <input id="password" type="password" name="password" placeholder="********"
                class="w-full bg-[#1E223D] border border-[#3B3F5C] rounded-md py-2 px-3 mb-6 text-[#5B5F7D] placeholder-[#5B5F7D] focus:outline-none focus:ring-2 focus:ring-[#6B56F9] focus:border-transparent transition @error('password') is-invalid @enderror" />
            <div class="flex items-center justify-between mb-6 text-[#7B7B8B] text-sm">
                <label class="flex items-center space-x-2">
                    <input type="checkbox"
                        class="w-4 h-4 text-[#6B56F9] bg-[#1E223D] border border-[#3B3F5C] rounded focus:ring-[#6B56F9]" />
                    <span>Ingat saya</span>
                </label>
                <a href="#" class="text-[#6B56F9] hover:underline">Lupa sandi?</a>
            </div>
            <button type="submit"
                class="w-full bg-gradient-to-r from-[#5B4FF9] to-[#8A5BFF] text-white font-semibold py-3 rounded-lg hover:opacity-90 transition">
                Masuk ke akun Anda
            </button>
        </form>

        <p class="text-[#7B7B8B] text-center mt-6 text-sm">
            Sudah punya akun? <a href="{{ url('login') }}" class="text-[#6B56F9] hover:underline">Masuk</a>
            </a>
        </p>
    </div>
</body>

</html>
