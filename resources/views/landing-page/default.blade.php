<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.compat.css" />
    @vite('resources/css/app.css')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex flex-col min-h-screen bg-gray-100 dark:bg-gray-900">

    <!-- Header -->
    <header
        class="fixed top-0 w-full z-50 bg-gray-300 dark:bg-gray-900 border-b border-gray-200 dark:border-gray-700 shadow-md">
        <nav class="bg-white dark:bg-gray-900">
            <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
                <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
                    <img src="{{ asset('assets/images/logo.png') }}" class="h-12" alt="Logo Santosojaya Tembakau" />
                </a>

                <!-- Heroicons Hamburger Icon -->
                <button id="menu-toggle" class="block md:hidden text-gray-800 dark:text-white focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                <!-- Navbar Menu -->
                <div id="navbar-menu"
                    class="items-center justify-between hidden w-full md:flex md:w-auto transition-all duration-300 ease-in-out">
                    <ul
                        class="flex flex-col md:flex-row p-4 md:p-0 border border-gray-200 rounded-lg shadow-lg md:shadow-none bg-white md:space-x-8 rtl:space-x-reverse md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                        <li><a href="/"
                                class="block py-2 px-3 text-gray-900 rounded transition-colors duration-300 hover:text-blue-500 md:hover:text-blue-600 dark:text-white">Home</a>
                        </li>
                        <li><a href="#peluang-bisnis"
                                class="block py-2 px-3 text-gray-900 rounded transition-colors duration-300 hover:text-blue-500 md:hover:text-blue-600 dark:text-white">Peluang
                                Bisnis</a></li>
                        <li><a href="#why-join-us"
                                class="block py-2 px-3 text-gray-900 rounded transition-colors duration-300 hover:text-blue-500 md:hover:text-blue-600 dark:text-white">Mengapa
                                Bergabung?</a></li>
                        <li><a href="{{ route('halamanLoginPabrik') }}"
                                class="block py-2 px-3 text-gray-900 rounded transition-colors duration-300 hover:text-blue-500 md:hover:text-blue-600 dark:text-white">Login
                                Pabrik</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main class="pt-20">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white dark:bg-gray-900 text-gray-900 dark:text-white py-8">
        <div class="container mx-auto text-center">
            <p class="text-lg font-semibold mb-4">Bergabunglah dengan Kami</p>
            <p class="mb-4">Jadilah bagian dari tim besar kami. Kami siap membantu Anda berkembang!</p>
            <div class="flex justify-center space-x-6 mb-6">
                <a href="#" class="text-gray-400 hover:text-gray-900 dark:hover:text-white">
                    <i class="fab fa-facebook fa-2x"></i>
                </a>
                <a href="#" class="text-gray-400 hover:text-gray-900 dark:hover:text-white">
                    <i class="fab fa-twitter fa-2x"></i>
                </a>
                <a href="#" class="text-gray-400 hover:text-gray-900 dark:hover:text-white">
                    <i class="fab fa-instagram fa-2x"></i>
                </a>
            </div>
            <p class="text-sm">© 2024 PT. Santosojaya Tembakau. Semua hak cipta dilindungi.</p>
        </div>
    </footer>
</body>

<script>
    const menuToggle = document.getElementById('menu-toggle');
    const navbarMenu = document.getElementById('navbar-menu');

    menuToggle.addEventListener('click', () => {
        // Toggle class hidden untuk memperlihatkan/menyembunyikan menu
        navbarMenu.classList.toggle('hidden');
        // Toggle kelas untuk animasi smooth slide down
        navbarMenu.classList.toggle('animate__animated');
        navbarMenu.classList.toggle('animate__fadeInDown');
    });
</script>

</html>