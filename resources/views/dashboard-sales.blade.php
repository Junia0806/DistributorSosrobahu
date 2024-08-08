<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Sales</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-gray-100 min-h-screen">

    <div class="p-4 md:p-6 lg:p-8">
        <div class="text-center mb-8 bg-blue-600 text-white py-4 rounded-lg shadow-md">
            <h1 class="text-3xl md:text-4xl font-bold">Dashboard Sales</h1>
            <p class="text-lg md:text-xl mt-1">Gambaran Kinerja Penjualan Sales</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            <!-- Stok Produk -->
            <div class="col-span-1 md:col-span-2 lg:col-span-3">
                <h2 class="text-xl md:text-2xl font-semibold text-gray-800 mb-4">Stok Produk</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6">
                    <div class="bg-white shadow-lg rounded-lg p-6 transform hover:scale-105 transition-transform duration-300">
                        <div class="flex items-center mb-4">
                            <i class="fas fa-cigarette text-blue-500 text-3xl md:text-4xl mr-3"></i>
                            <h3 class="text-lg md:text-xl font-semibold text-gray-900">Sosrobahu Mangga Alpukat</h3>
                        </div>
                        <p class="text-gray-600">150 Slop</p>
                    </div>
                    <div class="bg-white shadow-lg rounded-lg p-6 transform hover:scale-105 transition-transform duration-300">
                        <div class="flex items-center mb-4">
                            <i class="fas fa-cigarette text-blue-500 text-3xl md:text-4xl mr-3"></i>
                            <h3 class="text-lg md:text-xl font-semibold text-gray-900">Sosrobahu D&H</h3>
                        </div>
                        <p class="text-gray-600">120 Slop</p>
                    </div>
                    <div class="bg-white shadow-lg rounded-lg p-6 transform hover:scale-105 transition-transform duration-300">
                        <div class="flex items-center mb-4">
                            <i class="fas fa-cigarette text-blue-500 text-3xl md:text-4xl mr-3"></i>
                            <h3 class="text-lg md:text-xl font-semibold text-gray-900">Sosrobahu Kopi Hitam</h3>
                        </div>
                        <p class="text-gray-600">200 Slop</p>
                    </div>
                    <div class="bg-white shadow-lg rounded-lg p-6 transform hover:scale-105 transition-transform duration-300">
                        <div class="flex items-center mb-4">
                            <i class="fas fa-cigarette text-blue-500 text-3xl md:text-4xl mr-3"></i>
                            <h3 class="text-lg md:text-xl font-semibold text-gray-900">Sosrobahu Kupu Biru</h3>
                        </div>
                        <p class="text-gray-600">180 Slop</p>
                    </div>
                    <div class="bg-white shadow-lg rounded-lg p-6 transform hover:scale-105 transition-transform duration-300">
                        <div class="flex items-center mb-4">
                            <i class="fas fa-cigarette text-blue-500 text-3xl md:text-4xl mr-3"></i>
                            <h3 class="text-lg md:text-xl font-semibold text-gray-900">Sosrobahu Premium</h3>
                        </div>
                        <p class="text-gray-600">90 Slop</p>
                    </div>
                    <div class="bg-white shadow-lg rounded-lg p-6 transform hover:scale-105 transition-transform duration-300">
                        <div class="flex items-center mb-4">
                            <i class="fas fa-cigarette text-blue-500 text-3xl md:text-4xl mr-3"></i>
                            <h3 class="text-lg md:text-xl font-semibold text-gray-900">Sosrobahu Original</h3>
                        </div>
                        <p class="text-gray-600">160 Slop</p>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow-lg rounded-lg p-6 transform hover:scale-105 transition-transform duration-300">
                <div class="flex items-center mb-4">
                    <i class="fas fa-store text-green-500 text-3xl md:text-4xl mr-3"></i>
                    <h2 class="text-xl md:text-2xl font-semibold text-gray-800">Jumlah Toko</h2>
                </div>
                <p class="text-gray-600"><span class="font-bold text-gray-900">25</span> Toko </p>
            </div>

            <div class="bg-white shadow-lg rounded-lg p-6 transform hover:scale-105 transition-transform duration-300">
                <div class="flex items-center mb-4">
                    <i class="fas fa-dollar-sign text-yellow-500 text-3xl md:text-4xl mr-3"></i>
                    <h2 class="text-xl md:text-2xl font-semibold text-gray-800">Total Penjualan</h2>
                </div>
                <p class="text-gray-600"><span class="font-bold text-gray-900">Rp 5,000,000</span> bulan ini</p>
            </div>

            <div class="bg-white shadow-lg rounded-lg p-6 transform hover:scale-105 transition-transform duration-300">
                <div class="flex items-center mb-4">
                    <i class="fas fa-map-marker-alt text-red-500 text-3xl md:text-4xl mr-3"></i>
                    <h2 class="text-xl md:text-2xl font-semibold text-gray-800">Kunjungan Toko</h2>
                </div>
                <p class="text-gray-600"><span class="font-bold text-gray-900">18</span> Selesai</p>
                <p class="text-gray-600"><span class="font-bold text-gray-900">2</span> Proses</p>
            </div>

        </div>
    </div>

</body>
</html>
