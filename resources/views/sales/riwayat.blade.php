@extends('sales.default')

@section('content')
<section class="container mx-auto p-6">
  <div class="bg-white shadow-lg rounded-lg max-w-full overflow-x-auto">
      <h2 class="text-2xl font-bold border-b mb-3 pb-3 text-center">Riwayat Pemesanan</h2>
      <div class="overflow-x-auto">
        <table class="w-full border-separate border-spacing-0">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="p-2 text-left text-sm font-medium">Tanggal Pemesanan</th>
                    <th class="p-2 text-left text-sm font-medium">Total Harga</th>
                    <th class="p-2 text-left text-sm font-medium">Pesanan</th>
                    <th class="p-2 text-left text-sm font-medium">Pembayaran</th>
                    <th class="p-2 text-left text-sm font-medium">Nota</th>
                </tr>
            </thead>
            <tbody class="bg-white text-sm">
                <tr class="border-b border-gray-200">
                    <td class="p-2">01/08/2024</td>
                    <td class="p-2">Rp. 300.000</td>
                    <td class="p-2 text-green-600 font-semibold">Selesai</td>
                    <td class="p-2 text-green-600 font-semibold">Lunas</td>
                    <td class="p-2">
                        <button onclick="window.location.href='{{ route('nota') }}'" class="bg-green-600 text-white font-bold py-1 px-3 rounded hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 text-xs">
                            Tersedia
                        </button>
                    </td>
                </tr>
                <tr class="border-b border-gray-200">
                    <td class="p-2">30/07/2024</td>
                    <td class="p-2">Rp. 500.000</td>
                    <td class="p-2 text-red-600 font-semibold">Ditolak</td>
                    <td class="p-2 text-red-600 font-semibold">Hutang</td>
                    <td class="p-2 text-gray-600 font-semibold">Diproses</td>
                </tr>
            </tbody>
        </table>
      </div>
  </div>
</section>
@endsection
