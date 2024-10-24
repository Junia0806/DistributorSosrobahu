@extends('pabrik.default')

@section('content')
<div class="w-full max-w-6xl mx-auto bg-white rounded-lg shadow-lg overflow-x-auto my-20">
    <div class="flex items-center justify-between p-6 border-b">
        <div class="flex-1 text-center">
            <h1 class="text-2xl font-bold text-black text-center w-full">Pesanan Masuk dari Distributor</h1>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full border-separate border-spacing-0 text-sm text-black">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="p-2 text-left">Tanggal</th>
                    <th class="p-2 text-left">Nama Distributor</th>
                    <th class="p-2 text-left">Total Harga</th>
                    <th class="p-2 text-left">Status Pesanan</th>
                    <th class="p-2 text-left">Detail Pesanan</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                <tr class="border-b border-gray-200">
                    <td class="p-2">31/12/2025</td>
                    <td class="p-2">Distributor Rico</td>
                    <td class="p-2">Rp.134.000</td>
                    <td class="p-2 text-green-600">Selesai</td>
                    <td class="p-2">
                        <button type="button"
                            onclick="window.location.href='{{ route('pabrik-detail-transaksi', ['namaDistributor' => 'Distributor Rico', 'orderDate' => '08 Agustus 2024']) }}'"
                            class="bg-green-600 text-white font-bold py-1 px-3 rounded hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 text-xs">
                            Lihat
                        </button>
                    </td>
                </tr>
                <tr class="border-b border-gray-200">
                    <td class="p-2">09/08/2024</td>
                    <td class="p-2">Distributor Lilo</td>
                    <td class="p-2">Rp.134.000</td>
                    <td class="p-2 text-green-600">Selesai</td>
                    <td class="p-2">
                        <button type="button"
                            onclick="window.location.href='{{ route('pabrik-detail-transaksi', ['namaDistributor' => 'Distributor Lilo', 'orderDate' => '09 Agustus 2024']) }}'"
                            class="bg-green-600 text-white font-bold py-1 px-3 rounded hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 text-xs">
                            Lihat
                        </button>
                    </td>
                </tr>
                <tr class="border-b border-gray-200">
                    <td class="p-2">10/08/2024</td>
                    <td class="p-2">Distributor Bundo</td>
                    <td class="p-2">Rp.134.000</td>
                    <td class="p-2 text-orange-600">Diproses</td>
                    <td class="p-2">
                        <button type="button"
                            onclick="window.location.href='{{ route('pabrik-detail-transaksi', ['namaDistributor' => 'Distributor Bundo', 'orderDate' => '10 Agustus 2024']) }}'"
                            class="bg-orange-600 text-white font-bold py-1 px-3 rounded hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 text-xs">
                            Edit
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection