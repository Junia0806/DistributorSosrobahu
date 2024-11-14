@extends('landing-page.default')

@section('content')

<head>
    <title>Peluang Bisnis Santoso Jaya Tembakau – Jadi Sales, Agen, atau Distributor Kami</title>
</head>


<!-- Hero Section with Video -->
<section class="relative w-full py-16 bg-gray-900 pt-24">
    <div class="container mx-auto flex flex-col md:flex-row items-center gap-8">
        <!-- Hero Text -->
        <div class="w-full md:w-1/2 text-center md:text-left text-white px-4">
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold mb-4 text-gray-100">Peluang Bisnis Bersama Santosojaya
                Tembakau</h1>
            <p class="text-lg sm:text-xl mb-6">Bergabunglah sebagai mitra kami dan nikmati berbagai kesempatan bisnis
                dengan produk unggulan rokok kretek tangan dan mesin, yang telah terbukti memenuhi selera pasar, baik di
                dalam negeri maupun internasional.</p>
            <a href="#peluang-bisnis"
                class="bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700 transition duration-300 transform hover:scale-105">Mulai
                Sekarang</a>
        </div>
        <!-- YouTube Video -->
        <div class="w-full md:w-1/2 aspect-w-16 aspect-h-9">
            <iframe class="w-full h-56 sm:h-72 md:h-96 lg:h-[450px] rounded-lg shadow-lg"
                src="https://www.youtube.com/embed/evMpn8QH3mw?autoplay=1&mute=0&controls=1" frameborder="0"
                allow="autoplay; encrypted-media" allowfullscreen>
            </iframe>
        </div>
    </div>
</section>

<!-- Peluang Bisnis Section -->
<section id="peluang-bisnis" class="container mx-auto py-20 px-4 text-center">
    <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-12">Peluang Bisnis Bersama Kami</h2>
    <p class="text-lg text-gray-600 mb-8">Pilih salah satu peran untuk memulai perjalanan sukses Anda bersama kami.
        Setiap peran memiliki keuntungan besar!</p>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
        <!-- Sales Card -->
<div class="bg-white text-gray-800 rounded-xl shadow-lg p-6 hover:scale-105 transition duration-300">
    <div class="mb-6">
        <img src="https://img.freepik.com/free-vector/ecommerce-campaign-concept-illustration_114360-8202.jpg?ga=GA1.1.2088420924.1731607219&semt=ais_hybrid" alt="Sales" class="w-full h-48 object-cover rounded-lg">
    </div>
    <h3 class="text-2xl font-semibold mb-4">Sales</h3>
    <p class="text-gray-600 mb-6">Sebagai Sales, Anda akan mendapatkan komisi penjualan menarik dan peluang
        untuk memperluas jaringan dengan pelanggan kami.</p>
    <a href="{{ route('halamanLoginSales') }}" class="text-indigo-600 font-bold hover:underline">Masuk sebagai
        Sales</a>
    <p class="mt-4 text-gray-700">Belum punya akun? <a href="{{ route('daftarMenjadiSales') }}"
            class="text-indigo-600 hover:underline">Daftar sekarang!</a></p>
</div>

<!-- Agen Card -->
<div class="bg-white text-gray-800 rounded-xl shadow-lg p-6 hover:scale-105 transition duration-300">
    <div class="mb-6">
        <img src="https://img.freepik.com/free-vector/checking-boxes-concept-illustration_114360-2429.jpg?ga=GA1.1.2088420924.1731607219&semt=ais_hybrid" alt="Agen" class="w-full h-48 object-cover rounded-lg">
    </div>
    <h3 class="text-2xl font-semibold mb-4">Agen</h3>
    <p class="text-gray-600 mb-6">Nikmati harga grosir, diskon eksklusif, dan peluang untuk mengembangkan bisnis
        Anda sebagai Agen kami.</p>
    <a href="{{ route('halamanLoginAgen') }}" class="text-indigo-600 font-bold hover:underline">Masuk sebagai
        Agen</a>
    <p class="mt-4 text-gray-700">Belum punya akun? <a href="{{ route('daftarMenjadiAgen') }}"
            class="text-indigo-600 hover:underline">Daftar sekarang!</a></p>
</div>

<!-- Distributor Card -->
<div class="bg-white text-gray-800 rounded-xl shadow-lg p-6 hover:scale-105 transition duration-300">
    <div class="mb-6">
        <img src="https://img.freepik.com/free-vector/warehouse-outside-concept-illustration_114360-29135.jpg?ga=GA1.1.2088420924.1731607219&semt=ais_hybrid" alt="Distributor"
            class="w-full h-48 object-cover rounded-lg">
    </div>
    <h3 class="text-2xl font-semibold mb-4">Distributor</h3>
    <p class="text-gray-600 mb-6">Maksimalkan keuntungan dengan menjadi Distributor kami dan dapatkan harga
        terbaik dengan produk berkualitas tinggi.</p>
    <a href="{{ route('halamanLoginDistributor') }}" class="text-indigo-600 font-bold hover:underline">Masuk
        sebagai Distributor</a>
    <p class="mt-4 text-gray-700">Belum punya akun? <a href="{{ route('daftarMenjadiDistributor') }}"
            class="text-indigo-600 hover:underline">Daftar sekarang!</a></p>
</div>

    </div>

</section>

<!-- Mengapa Bergabung Section -->
<section id="why-join-us" class="bg-gray-50 py-20 text-center">
    <div class="container mx-auto">
        <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-8">Mengapa Bergabung dengan Kami?</h2>
        <p class="text-lg text-gray-600 mb-12">Kami menawarkan kesempatan untuk berkembang bersama tim yang solid dan
            produk berkualitas. Berikut adalah beberapa alasan mengapa Anda harus bergabung dengan kami:</p>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            <!-- Alasan 1 -->
            <div class="bg-white p-6 rounded-lg shadow-lg hover:scale-105 transition duration-300">
                <div class="mb-4 text-red-600">
                    <i class="fas fa-clipboard-list fa-3x"></i>
                </div>
                <h3 class="text-xl font-semibold mb-4">Peluang Bisnis yang Menguntungkan</h3>
                <p class="text-gray-600">Kami memberikan peluang bisnis dengan potensi penghasilan yang tinggi. Anda
                    dapat memulai dengan modal yang terjangkau dan mendapatkan keuntungan yang maksimal.</p>
            </div>

            <!-- Alasan 2 -->
            <div class="bg-white p-6 rounded-lg shadow-lg hover:scale-105 transition duration-300">
                <div class="mb-4 text-red-600">
                    <i class="fas fa-handshake fa-3x"></i>
                </div>
                <h3 class="text-xl font-semibold mb-4">Kemitraan yang Solid</h3>
                <p class="text-gray-600">Bergabung dengan kami berarti Anda akan bekerja dengan mitra yang berpengalaman
                    dan mendukung Anda dalam setiap langkah. Kami percaya pada hubungan yang saling menguntungkan.</p>
            </div>

            <!-- Alasan 3 -->
            <div class="bg-white p-6 rounded-lg shadow-lg hover:scale-105 transition duration-300">
                <div class="mb-4 text-red-600">
                    <i class="fas fa-gem fa-3x"></i>
                </div>
                <h3 class="text-xl font-semibold mb-4">Produk Berkualitas Tinggi</h3>
                <p class="text-gray-600">Kami menyediakan produk unggulan yang sudah terbukti di pasar. Dengan kualitas
                    terbaik, Anda dapat dengan percaya diri menawarkan produk kami kepada pelanggan.</p>
            </div>
        </div>
    </div>
</section>

<!-- Testimoni Section -->
<section id="testimonials" class="bg-gray-100 py-20">
    <div class="container mx-auto text-center">
        <h2 class="text-3xl sm:text-4xl font-bold text-gray-800 mb-12">Testimoni Mitra Kami</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            <!-- Testimoni 1 -->
            <div class="bg-white text-gray-800 rounded-xl shadow-lg p-6">
                <p class="italic text-lg text-gray-600 mb-4">"Bergabung dengan Santoso Jaya Tembakau telah membuka
                    banyak peluang bagi bisnis saya. Produk mereka berkualitas tinggi dan selalu ada inovasi baru yang
                    membuat kami tetap kompetitif di pasar."</p>
                <h4 class="font-semibold">Fajar Pratama, Agen</h4>
            </div>

            <!-- Testimoni 2 -->
            <div class="bg-white text-gray-800 rounded-xl shadow-lg p-6">
                <p class="italic text-lg text-gray-600 mb-4">"Sebagai distributor, saya merasa sangat didukung oleh tim
                    Santoso Jaya Tembakau. Keuntungan yang saya dapatkan sangat memuaskan, dan hubungan bisnis yang
                    terjalin sangat baik."</p>
                <h4 class="font-semibold">Agus Setiawan, Distributor</h4>
            </div>

            <!-- Testimoni 3 -->
            <div class="bg-white text-gray-800 rounded-xl shadow-lg p-6">
                <p class="italic text-lg text-gray-600 mb-4">"Sebagai sales, saya senang bisa bekerja dengan perusahaan
                    yang memiliki produk unggulan dan peluang yang sangat menjanjikan. Saya sangat merekomendasikan
                    Santoso Jaya Tembakau."</p>
                <h4 class="font-semibold">Dewi Anindita, Sales</h4>
            </div>
        </div>
    </div>
</section>

@endsection
