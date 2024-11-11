<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>404 - Not Found</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.compat.css" />
    @vite('resources/css/app.css')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white h-screen flex items-center justify-center">
    <div class="text-center ">
        <h1 class="text-gray-500 text-3xl font-bold mb-4">Halaman Tidak Ditemukan</h1>
        <img class="h-72 w-auto mx-auto rounded-lg" src="{{ asset('assets/error-image/404.png') }}" alt="" />
        <p class="text-2xl text-gray-500 pb-12">Oops! Halaman yang Anda minta tidak dapat ditemukan</p>
    </div>
</body>

</html>
