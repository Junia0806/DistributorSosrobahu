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
                        <h2 class="text-xl font-bold">185 Slop</h2>
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
                        <h2 class="text-xl font-bold">Rp 15.000.000</h2>
                        <p class="text-lg">Pendapatan Bulan Ini</p>
                    </div>
                </div>

                <!-- Jumlah Toko -->
                <div class="bg-orange-400 text-white rounded-lg shadow p-4 flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fa-solid fa-user-tie fa-2x"></i>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-xl font-bold">25 Orang</h2>
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
                    <div class="bg-white border border-gray-200 rounded-lg shadow-md p-4">
                        <img src="{{ asset('assets/images/produk' . $i . '.jpg') }}"
                            alt="Sosrobahu Produk {{ $i }}" class="w-full h-40 object-cover rounded-t-lg mb-4">
                        <div class="flex flex-col items-center">
                            <h3 class="text-lg font-bold mb-2">Sosrobahu Produk {{ $i }}</h3>
                            <p class="text-gray-700 text-lg">Stok: <span class="text-black font-bold">{{ rand(7, 50) }}
                                    Slop</span></p>
                        </div>
                    </div>
                @endfor
            </div>
        </div>

        <!-- Tabel Peringkat Penjualan Sales -->
        <div class="p-6">
            <h2 class="text-2xl font-bold mb-6 text-center">Peringkat Penjualan Sales</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="py-2 px-4 border-b">Peringkat</th>
                            <th class="py-2 px-4 border-b">Nama Sales</th>
                            <th class="py-2 px-4 border-b">Total Penjualan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($j = 1; $j <= 5; $j++)
                            <tr class="border-t">
                                <td class="py-2 px-4 border-b text-center">{{ $j }}</td>
                                <td class="py-2 px-4 border-b text-center">Sales
                                    {{ ['Upin', 'Ipin', 'Dzul', 'Mail', 'Nussa', 'Rara'][$j - 1] }}</td>
                                <td class="py-2 px-4 border-b text-center">Rp.
                                    {{ number_format(rand(20000000, 40000000), 0, ',', '.') }}</td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
