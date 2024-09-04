@extends('agen.default')

@section('content')
<div class="w-full max-w-6xl mx-auto bg-white rounded-lg shadow-lg overflow-x-auto my-20">
    <div class="flex items-center justify-between p-6 border-b">
        <div class="flex-1 text-center">
            <h1 class="text-2xl font-bold text-black text-center w-full">Laporan Transaksi Pesanan Sales</h1>
        </div>
    </div>

    <!-- Tabel List Transksi Pesanan Sales -->
    <div class="overflow-x-auto">
        <table class="w-full border-separate border-spacing-0 text-sm text-black">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="p-2 text-center">Tanggal</th>
                    <th class="p-2 text-center">Nama Agen</th>
                    <th class="p-2 text-center">Total Harga</th>
                    <th class="p-2 text-center">Status Pesanan</th>
                    <th class="p-2 text-center">Detail Pesanan</th>
                </tr>
            </thead>
            <tbody class="bg-white text-center">
                <tr class="border-b border-gray-200">
                    <td class="p-2">08/08/2024</td>
                    <td class="p-2">Joshua</td>
                    <td class="p-2">134.000</td>
                    <td class="p-2">Selesai</td>
                    <td class="p-2">
                        <button type="button"
                            onclick="window.location.href='{{ route('detail.transaksi', ['namaAgen' => 'Joshua', 'orderDate' => '08 Agustus 2024']) }}'"
                            class="bg-green-600 text-white font-bold py-1 px-3 rounded hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 text-xs">
                            Lihat
                        </button>
                    </td>
                </tr>
                <tr class="border-b border-gray-200">
                    <td class="p-2">09/08/2024</td>
                    <td class="p-2">Xiao Mei Mei</td>
                    <td class="p-2">134.000</td>
                    <td class="p-2">Selesai</td>
                    <td class="p-2">
                        <button type="button"
                            onclick="window.location.href='{{ route('detail.transaksi', ['namaAgen' => 'Xiao Mei Mei', 'orderDate' => '09 Agustus 2024']) }}'"
                            class="bg-green-600 text-white font-bold py-1 px-3 rounded hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 text-xs">
                            Lihat
                        </button>
                    </td>
                </tr>
                <tr class="border-b border-gray-200">
                    <td class="p-2">10/08/2024</td>
                    <td class="p-2">Mohd Amirul Zarizan</td>
                    <td class="p-2">134.000</td>
                    <td class="p-2">Diproses</td>
                    <td class="p-2">
                        <button type="button"
                            onclick="window.location.href='{{ route('detail.transaksi', ['namaAgen' => 'Mohd Amirul Zarizan', 'orderDate' => '10 Agustus 2024']) }}'"
                            class="bg-green-600 text-white font-bold py-1 px-3 rounded hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 text-xs">
                            Lihat
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
