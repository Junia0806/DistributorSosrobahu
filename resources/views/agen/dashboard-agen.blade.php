@extends('agen.default')

@section('content')
<div class="w-full max-w-6xl mx-auto bg-white rounded-lg shadow-lg overflow-x-auto my-20">
    <!-- Atas -->
    <div class="p-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Stok -->
            <div class="bg-green-800 text-white rounded-lg shadow p-4 flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-box-open fa-2x"></i>
                </div>
                <div class="ml-4">
                    <h2 class="text-xl font-bold">185 slop</h2>
                    <p class="text-lg">Total Stok</p>
                </div>
            </div>

            <!-- Produk Rokok Terlaris -->
            <div class="bg-yellow-500 text-white rounded-lg shadow p-4 flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-star fa-2x"></i>
                </div>
                <div class="ml-4">
                    <h2 class="text-xl font-bold">Sosrobahu Premium</h2>
                    <p class="text-lg">Produk Terlaris</p>
                </div>
            </div>

            <!-- Pendapatan Bulan Ini -->
            <div class="bg-blue-800 text-white rounded-lg shadow p-4 flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-money-bill-wave fa-2x"></i>
                </div>
                <div class="ml-4">
                    <h2 class="text-xl font-bold">Rp 15.000.000</h2>
                    <p class="text-lg">Pendapatan Bulan Ini</p>
                </div>
            </div>

            <!-- Jumlah Toko -->
            <div class="bg-orange-800 text-white rounded-lg shadow p-4 flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-store fa-2x"></i>
                </div>
                <div class="ml-4">
                    <h2 class="text-xl font-bold">25 Toko</h2>
                    <p class="text-lg">Jumlah Toko</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Stok per Produk -->
    <div class="p-6">
        <h2 class="text-2xl font-bold mb-6">Rincian Stok</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-6">

            <div class="bg-white border border-gray-200 rounded-lg shadow-md p-4">
                <img src="{{ asset('assets/images/produk4.jpg') }}" alt="Sosrobahu Premium" class="w-full h-90 object-cover rounded-t-lg mb-4">
                <div class="flex flex-col items-center">
                  <h3 class="text-lg font-bold mb-2">Sosrobahu Premium</h3>
                  <p class="text-gray-700 text-lg">Total Stok: <span class="text-black font-bold">10 Slop</span></p>
                </div>
            </div>
            
            <div class="bg-white border border-gray-200 rounded-lg shadow-md p-4">
                <img src="{{ asset('assets/images/produk5.jpg') }}" alt="Sosrobahu Original" class="w-full h-90 object-cover rounded-t-lg mb-4">
                <div class="flex flex-col items-center">
                  <h3 class="text-lg font-bold mb-2">Sosrobahu Original</h3>
                  <p class="text-gray-700 text-lg">Total Stok: <span class="text-black font-bold">30 Slop</span></p>
                </div>
            </div>
            
            <div class="bg-white border border-gray-200 rounded-lg shadow-md p-4">
                <img src="{{ asset('assets/images/produk3.jpg') }}" alt="Sosrobahu Kupu Biru" class="w-full h-90 object-cover rounded-t-lg mb-4">
                <div class="flex flex-col items-center">
                  <h3 class="text-lg font-bold mb-2">Sosrobahu Kupu-Kupu Biru</h3>
                  <p class="text-gray-700 text-lg">Total Stok: <span class="text-black font-bold">40 Slop</span></p>
                </div>
            </div>
            
            <div class="bg-white border border-gray-200 rounded-lg shadow-md p-4">
                <img src="{{ asset('assets/images/produk6.jpg') }}" alt="Sosrobahu Mangga Alpukat" class="w-full h-90 object-cover rounded-t-lg mb-4">
                <div class="flex flex-col items-center">
                  <h3 class="text-lg font-bold mb-2">Sosrobahu Mangga Alpukat</h3>
                  <p class="text-gray-700 text-lg">Total Stok: <span class="text-black font-bold">20 Slop</span></p>
                </div>
            </div>
            
            <div class="bg-white border border-gray-200 rounded-lg shadow-md p-4">
                <img src="{{ asset('assets/images/produk.jpg') }}" alt="Sosrobahu Kopi Hitam" class="w-full h-90 object-cover rounded-t-lg mb-4">
                <div class="flex flex-col items-center">
                  <h3 class="text-lg font-bold mb-2">Sosrobahu Kopi Hitam</h3>
                  <p class="text-gray-700 text-lg">Total Stok: <span class="text-black font-bold">60 Slop</span></p>
                </div>
            </div>
            
            <div class="bg-white border border-gray-200 rounded-lg shadow-md p-4">
                <img src="{{ asset('assets/images/produk2.jpg') }}" alt="Sosrobahu D&H" class="w-full h-90 object-cover rounded-t-lg mb-4">
                <div class="flex flex-col items-center">
                  <h3 class="text-lg font-bold mb-2">Sosrobahu D&H</h3>
                  <p class="text-gray-700 text-lg">Total Stok: <span class="text-black font-bold">25 Slop</span></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Peringkat Penjualan Agen -->
    <div class="p-6">
        <h2 class="text-2xl font-bold mb-6">Peringkat Penjualan Agen</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="py-2 px-4 border-b">Peringkat</th>
                        <th class="py-2 px-4 border-b">Nama Agen</th>
                        <th class="py-2 px-4 border-b">Total Penjualan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-t">
                        <td class="py-2 px-4 border-b text-center">1</td>
                        <td class="py-2 px-4 border-b text-center">Agen Abadi</td>
                        <td class="py-2 px-4 border-b text-center">Rp. 40.000.000</td>
                    </tr>
                    <tr class="border-t">
                        <td class="py-2 px-4 border-b text-center">2</td>
                        <td class="py-2 px-4 border-b text-center">Agen Budaya</td>
                        <td class="py-2 px-4 border-b text-center">Rp. 39.000.000</td>
                    </tr>
                    <tr class="border-t">
                        <td class="py-2 px-4 border-b text-center">3</td>
                        <td class="py-2 px-4 border-b text-center">Agen Cantika</td>
                        <td class="py-2 px-4 border-b text-center">Rp. 35.000.000</td>
                    </tr>
                    <tr class="border-t">
                      <td class="py-2 px-4 border-b text-center">4</td>
                      <td class="py-2 px-4 border-b text-center">Agen Delima</td>
                      <td class="py-2 px-4 border-b text-center">Rp. 30.000.000</td>
                  </tr>
                  <tr class="border-t">
                      <td class="py-2 px-4 border-b text-center">5</td>
                      <td class="py-2 px-4 border-b text-center">Agen Ekonomis</td>
                      <td class="py-2 px-4 border-b text-center">Rp. 25.000.000</td>
                  </tr>
                  <tr class="border-t">
                      <td class="py-2 px-4 border-b text-center">6</td>
                      <td class="py-2 px-4 border-b text-center">Agen Fantastis</td>
                      <td class="py-2 px-4 border-b text-center">Rp. 20.000.000</td>
                  </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
