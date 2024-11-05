<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>504 - Page Expired</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.compat.css" />
    @vite('resources/css/app.css')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white h-screen flex items-center justify-center">
    <div class="text-center">
        <h1 class="text-gray-500 text-3xl font-bold mb-4">Halaman Kadaluwarsa</h1>
        <img class="h-72 w-auto mx-auto rounded-lg"src="{{ asset('assets/error-image/504.png') }}" alt="" />
        <p class="text-2xl text-gray-500 pb-12">Maaf, Anda telah mengakses halaman kadaluwarsa yang tidak tersedia Lagi
        </p>
        <a href="#"
            class="bg-gray-500 rounded-md hover:bg-gray-600 transition-colors duration-300 text-white font-semibold py-3 px-8">
            Login Kembali
        </a>
    </div>
</body>

</html>
