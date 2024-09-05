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
                    <th class="p-2 text-center">Nama Sales</th>
                    <th class="p-2 text-center">Total Harga</th>
                    <th class="p-2 text-center">Status Pesanan</th>
                    <th class="p-2 text-center">Status Pembayaran</th>
                    <th class="p-2 text-center">Detail Pesanan</th>
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
                                    <button onclick="window.location.href='{{ route('detail', $pesananMasuk->id_order) }}'" class="bg-green-600 text-white font-bold py-1 px-3 rounded hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 text-xs">
                                        Lihat
                                    </button>
                                    @else
                                    <!-- Jika kondisi lain, tampilkan teks Diproses -->
                                    <span class="text-gray-600 font-semibold">Selesai</span>
                                @endif
                            </td>
                        </tr>
                        
                    @endforeach
            </tbody>
        </table>
    </div>


    
</div>
@endsection
