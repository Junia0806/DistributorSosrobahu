@extends('sales.default')

@section('content')
    <div class="p-4 md:p-6 lg:p-8 my-16">
        <div class="p-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Total Stok -->
                <div class="bg-green-400 text-white rounded-lg shadow p-4 flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-box-open fa-2x"></i>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-xl font-bold">185 Pcs</h2>
                        <p class="text-lg">Total Stok</p>
                    </div>
                </div>

                <!-- Produk Rokok Terlaris -->
                <div class="bg-yellow-400 text-white rounded-lg shadow p-4 flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-star fa-2x"></i>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-xl font-bold">Sosrobahu Premium</h2>
                        <p class="text-lg">Produk Terlaris</p>
                    </div>
                </div>

                <!-- Pendapatan Bulan Ini -->
                <div class="bg-blue-400 text-white rounded-lg shadow p-4 flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-money-bill-wave fa-2x"></i>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-xl font-bold">Rp {{ number_format($totalPrice, 0, ',', '.') }}</h2>
                        <p class="text-lg">Modal</p>
                    </div>
                </div>

                <!-- Jumlah Toko -->
                <div class="bg-orange-400 text-white rounded-lg shadow p-4 flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fa-solid fa-store fa-2x"></i>
                    </div>
                    <div class="ml-4">
                        <div class="text-xl font-bold">
                          {{ $jumlahToko }}
                        </div>
                        <p class="text-lg">Jumlah Toko</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
