@extends('agen.default')

@section('content')
<div class="w-full max-w-6xl mx-auto bg-white overflow-x-auto my-20">
    <!-- Atas -->
    <div class="p-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Stok -->
            <div class="bg-green-400 text-white rounded-lg shadow p-4 flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-box-open fa-2x"></i>
                </div>
                <div class="ml-4">
                    <h2 class="text-xl font-bold">{{ $finalStockSlop }} Slop</h2>
                    <p class="text-lg">Total Stok</p>
                </div>
            </div>

            <!-- Produk Rokok Terlaris -->
            <div class="bg-yellow-400 text-white rounded-lg shadow p-4 flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-star fa-2x"></i>
                </div>
                <div class="ml-4">
                    <h2 class="text-xl font-bold">{{ $topProductName }}</h2>
                    <p class="text-lg">Produk Terlaris</p>
                </div>
            </div>

            <!-- Total Pendapatan -->
            <div class="bg-blue-400 text-white rounded-lg shadow p-4 flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-money-bill-wave fa-2x"></i>
                </div>
                <div class="ml-4">
                    <h2 class="text-xl font-bold">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h2>
                    <p class="text-lg">Total Pendapatan</p>
                </div>
            </div>

            <!-- Jumlah Sales -->
            <div class="bg-orange-400 text-white rounded-lg shadow p-4 flex items-center">
                <div class="flex-shrink-0">
                    <i class="fa-solid fa-user-tie fa-2x"></i>
                </div>
                <div class="ml-4">
                    <h2 class="text-xl font-bold">{{ $totalSales }} Orang</h2>
                    <p class="text-lg">Jumlah Sales</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Stok per Produk -->
    <div class="p-6">
        <h2 class="text-2xl font-bold mb-6 text-center">Rincian Stok</h2>
        <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-6 gap-4">
            @foreach ($barangAgens as $index => $barang)
                <div
                    class="bg-white p-3 rounded-lg border border-gray-200 shadow-md transition-colors duration-150 peer-checked:bg-gray-300 peer-checked:border-green-500 peer-checked:border-2 peer-checked:shadow-lg w-full max-w-[180px] mx-auto">
                    <div class="relative mb-2">
                        <img src="{{ asset('storage/produk/' . $gambarRokokList[$index]) }}"
                            alt="{{ $barang->nama_rokok }}"
                            class="w-full h-[200px] object-cover rounded-md border border-gray-200">
                    </div>
                    <div class="text-center">
                        <h2 class="text-sm font-bold text-gray-800">{{ $namaRokokList[$index] }}</h2>
                        <p class="text-gray-700 text-md">Stok: <span class="text-black font-bold">{{ $totalProdukList[$index] }}
                                Slop</span></p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection