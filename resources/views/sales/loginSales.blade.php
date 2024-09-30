<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex items-center justify-center min-h-screen bg-gray-900">
    <div class="w-full max-w-sm mx-auto p-8 bg-white rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-gray-900 text-center mb-6">Login Sales</h2>
        <p class="text-sm text-gray-600 text-center mb-6">Masuk dengan akun yang diberikan oleh Agen</p>
        <form action="{{ route('loginSales') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <input type="text" id="username" name="username" placeholder="Username"
                    class="w-full p-3 text-sm bg-gray-100 border border-gray-300 rounded-lg focus:ring-gray-500 focus:border-gray-500"
                    required />
            </div>
            <div class="relative">
                <input type="password" id="password" name="password" placeholder="Password"
                    class="w-full p-3 text-sm bg-gray-100 border border-gray-300 rounded-lg focus:ring-gray-500 focus:border-gray-500"
                    required />
                <!-- Eye Icon for Show/Hide Password -->
                <span id="togglePassword"
                    class="text-gray-500 absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer"
                    onclick="togglePassword()">
                    <i class="fa-solid fa-eye-slash"></i>
                </span>
            </div>
            <div>
                <button type="submit"
                    class="w-full text-white bg-gray-800 hover:bg-gray-700 focus:ring-2 focus:ring-gray-300 font-medium rounded-lg text-sm py-2.5">
                    Login
                </button>
            </div>

            @if ($errors->any())
                <div class="text-red-600 text-sm mt-3">
                    <strong>{{ $errors->first() }}</strong>
                </div>
            @endif
        </form>
        <!-- Registration Info -->
        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">Belum punya akun? Hubungi Agen untuk mendapatkan akun.</p>
        </div>
    </div>
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('togglePassword').children[0];

            // Toggle the type attribute
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text'; // Menampilkan password
                toggleIcon.classList.remove('fa-eye-slash'); // Menghilangkan ikon mata tertutup
                toggleIcon.classList.add('fa-eye'); // Menampilkan ikon mata terbuka
            } else {
                passwordInput.type = 'password'; // Menyembunyikan password
                toggleIcon.classList.remove('fa-eye'); // Menghilangkan ikon mata terbuka
                toggleIcon.classList.add('fa-eye-slash'); // Menampilkan ikon mata tertutup
            }
        }
    </script>
</body>

</html>
