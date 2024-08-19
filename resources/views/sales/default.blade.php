<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.compat.css" />
    @vite('resources/css/app.css')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex flex-col min-h-screen">
    <header class="fixed top-0 w-full z-50 bg-gray-300 dark:bg-gray-900 border-b border-gray-200 dark:border-gray-700 shadow-md">
        <nav class="bg-white border-gray-200 dark:bg-gray-900">
            <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
                <a href="https://flowbite.com/" class="flex items-center space-x-3 rtl:space-x-reverse">
                    <img src="{{ asset('assets/images/logo.png') }}" class="h-12" alt="Flowbite Logo" />
                </a>
                <div class="flex items-center md:order-2 space-x-1 md:space-x-0 rtl:space-x-reverse">
                    <button type="button" data-dropdown-toggle="language-dropdown-menu"
                        class="inline-flex items-center font-medium px-4 py-1 text-sm text-gray-900 rounded-lg cursor-pointer bg-gray-100 dark:bg-gray-700 dark:text-white">
                        <img class="w-5 h-5 rounded-full me-3"
                            src="https://static.vecteezy.com/system/resources/previews/000/357/350/original/businessman-vector-icon.jpg"
                            alt="User Avatar">
                        <div class="flex flex-col items-start">
                            <span class="font-bold">Hari Supriadi</span>
                            <span class="text-xs text-gray-500 dark:text-gray-400">Peringkat: 5</span>
                        </div>
                    </button>
                    <!-- Dropdown -->
                    <div class="z-50 hidden my-2 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700"
                        id="language-dropdown-menu">
                        <ul class="py-2 font-medium" role="none">
                            <li>
                                <a href="#" id="logout-link"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                                    role="menuitem">
                                    Keluar Akun<i class="fa-solid fa-right-from-bracket ml-2"></i>
                                </a>
                        
                        </ul>
                    </div>
                    <button data-collapse-toggle="navbar-language" type="button"
                        class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                        aria-controls="navbar-language" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 17 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 1h15M1 7h15M1 13h15" />
                        </svg>
                    </button>
                </div>
                <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1"
                    id="navbar-language">
                    <ul
                        class="flex flex-col md:flex-row p-4 md:p-0 border border-gray-200 rounded-lg bg-white md:space-x-8 rtl:space-x-reverse md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                        <li>
                            <a href="{{ route('dashboard') }}"
                                class="block py-2 px-3 text-gray-900 rounded transition-colors duration-300 hover:text-blue-500 md:hover:text-blue-600 dark:text-white {{ request()->routeIs('dashboard') ? 'text-blue-700 underline' : '' }}"
                                id="dashboard-link">
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('pesan_barang') }}"
                                class="block py-2 px-3 text-gray-900 rounded transition-colors duration-300 hover:text-blue-500 md:hover:text-blue-600 dark:text-white {{ request()->routeIs('pesan_barang') ? 'text-blue-700 underline' : '' }}"
                                id="pesan-link">
                                Order
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('riwayatOrder') }}"
                                class="block py-2 px-3 text-gray-900 rounded transition-colors duration-300 hover:text-blue-500 md:hover:text-blue-600 dark:text-white {{ request()->routeIs('riwayatOrder') ? 'text-blue-700 underline' : '' }}"
                                id="riwayat-link">
                                Riwayat
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('tokoSales') }}"
                                class="block py-2 px-3 text-gray-900 rounded transition-colors duration-300 hover:text-blue-500 md:hover:text-blue-600 dark:text-white {{ request()->routeIs('tokoSales') ? 'text-blue-700 underline' : '' }}"
                                id="toko-link">
                                Toko
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

    </header>


    <main>
        @yield('content')
    </main>

    <footer class="bg-white dark:bg-gray-900 mt-auto">
        <div class="mx-auto w-full max-w-screen-xl p-4 py-6 lg:py-8">
            <div class="md:flex md:justify-between">
                <div class="mb-6 md:mb-0">
                    <a href="https://flowbite.com/" class="flex items-center">
                        <img src="{{ asset('assets/images/logo.png') }}" class="h-8 me-3" alt="FlowBite Logo" />
                        <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">SALES</span>
                    </a>
                </div>
                <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-2">
                    <div>
                        <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Fitur</h2>
                        <ul class="text-gray-500 dark:text-gray-400 font-medium">
                            <li class="mb-4">
                                <a href="https://flowbite.com/" class="hover:underline">Dashboard Monitoring</a>
                            </li>
                            <li>
                                <a href="https://tailwindcss.com/" class="hover:underline">Kunjungan Toko</a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Pemesanan</h2>
                        <ul class="text-gray-500 dark:text-gray-400 font-medium">
                            <li class="mb-4">
                                <a href="https://github.com/themesberg/flowbite" class="hover:underline">Order
                                    Produk</a>
                            </li>
                            <li>
                                <a href="https://discord.gg/4eeurUVvTy" class="hover:underline">Riwayat Pesanan</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
            <div class="sm:flex sm:items-center sm:justify-between">
                <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2024 <a
                        href="https://flowbite.com/" class="hover:underline">PT.Siber Netizen Indonesia</a></span>
            </div>
        </div>
    </footer>

</body>
<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const path = window.location.pathname;
        const links = {
            '/': 'dashboard-link',
            '/pesan': 'pesan-link',
            '/riwayat': 'riwayat-link',
            '/toko': 'toko-link'
        };

        for (const [url, linkId] of Object.entries(links)) {
            if (path === url) {
                document.getElementById(linkId).classList.add('text-gray-800');
            }
        }

        // SweetAlert2 for logout confirmation
        document.getElementById('logout-link').addEventListener('click', function(e) {
            e.preventDefault(); // Prevent default link behavior
            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Anda tidak akan bisa membatalkan ini!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, keluar"
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Keluar!",
                        text: "Anda telah keluar.",
                        icon: "success"
                    }).then(() => {
                        // Redirect to login page or home
                        window.location.href = '/'; // Adjust the URL as needed
                    });
                }
            });
        });
    });
</script>



</html>
