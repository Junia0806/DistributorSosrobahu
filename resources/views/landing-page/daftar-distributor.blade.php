@extends('landing-page.default')

@section('content')

<head>
    <title>Daftar Menjadi Distributor</title>
</head>

<div class="container mx-auto py-10">

 <!-- Panduan Bergabung dengan Pabrik -->
 <div class="p-6 rounded-lg mb-10 bg-white border border-gray-200 shadow-md">
        <h2 class="text-2xl font-semibold mb-4 text-gray-700">Cara Bergabung menjadi Distributor</h2>
        <p class="mb-2 text-gray-600">Untuk informasi lebih lanjut mengenai cara bergabung dengan pabrik atau menjadi distributor produk, silakan hubungi kami melalui nomor di bawah atau kunjungi langsung pabrik kami.</p>
        <ul class="list-disc list-inside text-gray-600">
            <li>Pembelian minimal produk untuk menjadi distributor adalah <strong>50 karton</strong>.</li>
            <li>Informasi lebih lanjut dapat diperoleh melalui kontak yang tersedia.</li>
        </ul>
    </div>
    
    <h1 class="text-3xl font-bold text-center mb-8 text-gray-800">Informasi Pabrik</h1>

    <!-- Informasi Pabrik -->
    <div class="p-6 rounded-lg mb-10 bg-white border border-gray-200 shadow-md">
        <h2 class="text-2xl font-semibold mb-4 text-gray-700">Alamat dan Kontak Pabrik</h2>
        <p class="mb-2 text-gray-600">Berikut adalah alamat pabrik dan nomor telepon yang bisa Anda hubungi untuk informasi lebih lanjut:</p>

        <!-- Daftar Pabrik -->
        <div class="space-y-4">
            <div class="flex items-center justify-between bg-gray-50 p-4 rounded-lg border border-gray-200">
                <div>
                    <p class="font-semibold text-lg text-gray-700">CV. Santoso Jaya Tembakau</p>
                    <p class="text-gray-600">Alamat: Jl. Sukorejo-Bangil RT.01 RW.10 Dusun, Dusun Watulunyu No.Desa, Selo Tumpang, Oro-Oro Ombokulon, Rembang, Pasuruan Regency, East Java 67152</p>
                    <p class="text-gray-600"> Nomor:
                        <a href="https://wa.me/628123106221" target="_blank" class="text-blue-500 hover:underline">
                            0812-3106-221
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
