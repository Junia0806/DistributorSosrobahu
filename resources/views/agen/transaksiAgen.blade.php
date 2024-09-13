@extends('agen.default')

@section('content')
<div class="w-full max-w-6xl mx-auto bg-white rounded-lg shadow-lg overflow-x-auto my-20">
    <div class="flex items-center justify-between p-6 border-b">
        <div class="flex-1 text-center">
            <h1 class="text-2xl font-bold text-black text-center w-full">Pesanan Masuk dari Sales</h1>
        </div>
    </div>

    <!-- Tabel List Transksi Pesanan Sales -->
    <div class="overflow-x-auto">
    <table class="w-full border-separate border-spacing-0 text-sm text-black">
        <thead class="bg-gray-800 text-white">
            <tr>
                <th class="p-2 text-left">Tanggal</th>
                <th class="p-2 text-left">Nama Sales</th>
                <th class="p-2 text-left">Total Harga</th>
                <th class="p-2 text-left">Status Pesanan</th>
                <th class="p-2 text-left">Status Pembayaran</th>
                <th class="p-2 text-left">Detail Pesanan</th>
            </tr>
        </thead>
            <tbody class="bg-white text-sm">
                    @foreach ($pesananMasuks as $pesananMasuk)
                        <tr class="border-b border-gray-200">
                            <td class="p-2">{{ $pesananMasuk->tanggal->format('d/m/Y') }}</td>
                            <td class="p-2">{{ $pesananMasuk->id_user_sales }}</td>
                            <td class="p-2">Rp. {{ number_format($pesananMasuk->total, 0, ',', '.') }}</td>
                            <td class="p-2 {{ $pesananMasuk->status_pemesanan == 1 ? 'text-green-600' : 'text-red-600' }}">
                                {{ $pesananMasuk->status_pemesanan == 1 ? 'Selesai' : ($pesananMasuk->status_pemesanan == 2 ? 'Ditolak' : 'Diproses' ) }}
                            </td>
                            <td class="p-2 {{ $pesananMasuk->bukti_transfer ? 'text-green-600' : 'text-red-600' }}">
                            {{ $pesananMasuk->bukti_transfer ? 'Lunas' : 'Belum Lunas' }}
                            </td>
                            <td class="p-2">
                                @if($pesananMasuk->status_pemesanan == 0)
                                    <!-- Jika bukti_transfer ada dan status_pemesanan adalah 1, tampilkan tombol Tersedia -->
                                    <button onclick="window.location.href='{{ route('detailPesanMasuk', $pesananMasuk->id_order) }}'" class="bg-orange-600 text-white font-bold py-1 px-3 rounded hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-green-500 text-xs">
                                     Edit
                                    </button>
                                    @else
                                    <!-- Jika kondisi lain, tampilkan teks Diproses -->
                                    <button onclick="window.location.href='{{ route('detailPesanMasuk', $pesananMasuk->id_order) }}'" class="bg-green-600 text-white font-bold py-1 px-3 rounded hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 text-xs">
                                        Lihat
                                       </button>
                                @endif
                            </td>
                        </tr>
                        
                    @endforeach
            </tbody>
        </table>
    </div>

      <!-- Custom Pagination -->
      @if ($pesananMasuks->total() > 10)
      <div class="flex flex-col items-center my-6">
          <!-- Help text -->
          <span class="text-sm text-gray-700 dark:text-gray-400">
              Menampilkan <span
                  class="font-semibold text-gray-900 dark:text-white">{{ $pesananMasuks->firstItem() }}</span> sampai
              <span class="font-semibold text-gray-900 dark:text-white">{{ $pesananMasuks->lastItem() }}</span> dari
              <span class="font-semibold text-gray-900 dark:text-white">{{ $pesananMasuks->total() }}</span> transaksi
          </span>
          <!-- Buttons -->
          <div class="inline-flex mt-2 xs:mt-0">
              <!-- Previous Button -->
              <button {{ $pesananMasuks->onFirstPage() ? 'disabled' : '' }}
                  class="flex items-center justify-center px-3 h-8 text-sm font-medium text-white bg-gray-800 rounded-s hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                  {{ $pesananMasuks->previousPageUrl() ? 'onclick=window.location.href=\'' . $pesananMasuks->previousPageUrl() . '\'' : '' }}>
                  Sebelumnya
              </button>
              <!-- Next Button -->
              <button {{ !$pesananMasuks->hasMorePages() ? 'disabled' : '' }}
                  class="flex items-center justify-center px-3 h-8 text-sm font-medium text-white bg-gray-800 border-0 border-s border-gray-700 rounded-e hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                  {{ $pesananMasuks->nextPageUrl() ? 'onclick=window.location.href=\'' . $pesananMasuks->nextPageUrl() . '\'' : '' }}>
                  Selanjutnya
              </button>
          </div>
      </div>
  @endif

</div>
@endsection
