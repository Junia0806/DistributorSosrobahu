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
                @for ($i = 1; $i <= 6; $i++)
                    <div class="bg-white border border-gray-200 rounded-lg shadow-md p-2">
                        <img src="{{ asset('assets/images/produk' . $i . '.jpg') }}"
                            alt="Sosrobahu Produk {{ $i }}" class="w-full h-40 object-cover rounded-t-lg mb-2">
                        <div class="flex flex-col">
                            <h3 class="text-md font-bold mb-0">Sosrobahu Produk {{ $i }}</h3>
                            <p class="text-gray-700 text-md">Stok: <span class="text-black font-bold">{{ rand(7, 50) }}
                                    Slop</span></p>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
</div>
@endsection