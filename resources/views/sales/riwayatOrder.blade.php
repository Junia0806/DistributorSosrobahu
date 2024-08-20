@extends('sales.default')

@section('content')
<section class="container mx-auto p-6 my-20">
  <div class="bg-white shadow-lg rounded-lg max-w-full overflow-x-auto">
      <h2 class="text-2xl font-bold border-b mb-3 pb-3 text-center">Riwayat Pemesanan</h2>
      <div class="overflow-x-auto">
        <table class="w-full border-separate border-spacing-0">
            <thead class="bg-gray-800 text-white font-bold">
                <tr>
                    <th class="p-2 text-left text-sm">Tanggal Pemesanan</th>
                    <th class="p-2 text-left text-sm">Total Harga</th>
                    <th class="p-2 text-left text-sm">Jumlah</th>
                    <th class="p-2 text-left text-sm">Pesanan</th>
                    <th class="p-2 text-left text-sm">Pembayaran</th>
                    <th class="p-2 text-left text-sm">Nota</th>
                </tr>
            </thead>
            <tbody class="bg-white text-sm">
                @foreach ($orderSales as $orderSale)
                    <tr class="border-b border-gray-200">
                        <td class="p-2">{{ $orderSale->tanggal->format('d/m/Y') }}</td>
                        <td class="p-2">Rp. {{ number_format($orderSale->total, 0, ',', '.') }}</td>
                        <td class="p-2">{{ $orderSale->jumlah }} Slop</td>
                        <td class="p-2 {{ $orderSale->status_pemesanan == 1 ? 'text-green-600' : 'text-red-600' }} font-semibold">
                            {{ $orderSale->status_pemesanan == 1 ? 'Selesai' : 'Ditolak' }}
                        </td>
                        <td class="p-2 {{ $orderSale->bukti_transfer ? 'text-green-600' : 'text-red-600' }} font-semibold">
                            {{ $orderSale->bukti_transfer ? 'Lunas' : 'Hutang' }}
                        </td>
                        <td class="p-2">
                            @if($orderSale->nota)
                                <button onclick="window.location.href='{{ route('nota', $orderSale->id_order) }}'" class="bg-green-600 text-white font-bold py-1 px-3 rounded hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 text-xs">
                                    Tersedia
                                </button>
                            @else
                                <span class="text-gray-600 font-semibold">Diproses</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
      </div>

      <!-- Custom Pagination -->
      <div class="flex flex-col items-center my-6">
          <!-- Help text -->
          <span class="text-sm text-gray-700 dark:text-gray-400">
              Menampilkan <span class="font-semibold text-gray-900 dark:text-white">{{ $orderSales->firstItem() }}</span> sampai <span class="font-semibold text-gray-900 dark:text-white">{{ $orderSales->lastItem() }}</span> dari <span class="font-semibold text-gray-900 dark:text-white">{{ $orderSales->total() }}</span> transaksi
          </span>
          <!-- Buttons -->
          <div class="inline-flex mt-2 xs:mt-0">
              <!-- Previous Button -->
              <button 
                  {{ $orderSales->onFirstPage() ? 'disabled' : '' }} 
                  class="flex items-center justify-center px-3 h-8 text-sm font-medium text-white bg-gray-800 rounded-s hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                  {{ $orderSales->previousPageUrl() ? 'onclick=window.location.href=\'' . $orderSales->previousPageUrl() . '\'' : '' }}>
                Sebelumnya
              </button>
              <!-- Next Button -->
              <button 
                  {{ !$orderSales->hasMorePages() ? 'disabled' : '' }} 
                  class="flex items-center justify-center px-3 h-8 text-sm font-medium text-white bg-gray-800 border-0 border-s border-gray-700 rounded-e hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                  {{ $orderSales->nextPageUrl() ? 'onclick=window.location.href=\'' . $orderSales->nextPageUrl() . '\'' : '' }}>
                Selanjutnya
              </button>
          </div>
      </div>
      
  </div>
</section>
@endsection
