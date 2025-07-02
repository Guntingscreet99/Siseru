<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Verify OTP</title>
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
        <h4 class="text-[#6B56F9] font-extrabold text-2xl mb-2">Verifikasi Nomor Telepon</h4>
        <p class="text-[#7B7B8B] mb-6 text-sm">
            Masukkan kode OTP yang dikirim ke nomor Anda:
            <strong class="text-white">{{ $user->no_hp ?? 'Nomor tidak ditemukan' }}</strong>
        </p>

        <!-- Error Alert -->
        <div class="mb-4">
            @if (session('error'))
                <div class="bg-red-600 text-white rounded-md p-3 text-sm">
                    {{ session('error') }}
                </div>
            @endif
        </div>

        <!-- Success Alert -->
        <div class="mb-4">
            @if (session('success'))
                <div class="bg-green-600 text-white rounded-md p-3 text-sm">
                    {{ session('success') }}
                </div>
            @endif
        </div>

        <form action="{{ route('verify.otp.submit') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                @if (isset($user))
                    <strong class="text-white">{{ $user->no_hp ?? 'Nomor tidak ditemukan' }}</strong>
                @else
                    <strong class="text-red-600">User tidak ditemukan</strong>
                @endif
            </div>

            <input type="hidden" name="user_id" value="{{ $user_id }}" />
            <input type="hidden" name="no_hp" value="{{ $user->no_hp ?? '' }}" />

            <div>
                <input type="text" name="otp" placeholder="Masukkan Kode OTP" required
                    class="w-full bg-[#1E223D] border border-[#3B3F5C] rounded-md py-2 px-3 text-[#5B5F7D] placeholder-[#5B5F7D] focus:outline-none focus:ring-2 focus:ring-[#6B56F9] focus:border-transparent transition" />
            </div>

            <button type="submit"
                class="w-full bg-gradient-to-r from-[#5B4FF9] to-[#8A5BFF] text-white font-semibold py-3 rounded-lg hover:opacity-90 transition">
                Verifikasi
            </button>
        </form>
    </div>
</body>

</html>
