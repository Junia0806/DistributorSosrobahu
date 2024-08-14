@extends('agen.default')

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
                            <th class="p-2 text-left text-sm">Jumlah Produk</th>
                            <th class="p-2 text-left text-sm">Status Pesanan</th>
                            <th class="p-2 text-left text-sm">Nota</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white text-sm">
                        @for ($i = 0; $i < 8; $i++)
                            <tr class="border-b border-gray-200">
                                <td class="p-2">01/08/2024</td>
                                <td class="p-2">Rp.8.400.000</td>
                                <td class="p-2">13</td>
                                <td class="p-2 text-green-600">Selesai</td>
                                <td class="p-2">
                                    <button onclick="window.location.href='{{ route('agen-nota') }}'"
                                        class="bg-green-600 text-white font-bold py-1 px-3 rounded hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 text-xs">
                                        Tersedia
                                    </button>
                                </td>
                            </tr>
                        @endfor
                        <tr class="border-b border-gray-200">
                            <td class="p-2">30/07/2024</td>
                            <td class="p-2">Rp.1.500.000</td>
                            <td class="p-2">2</td>
                            <td class="p-2 text-red-600">Ditolak</td>
                            <td class="p-2 text-gray-600">Tidak Tersedia</td>
                        </tr>
                        <tr class="border-b border-gray-200">
                            <td class="p-2">30/07/2024</td>
                            <td class="p-2">Rp.1.500.000</td>
                            <td class="p-2">2</td>
                            <td class="p-2 text-orange-600">Diproses</td>
                            <td class="p-2 text-gray-600">Tidak Tersedia</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>


        <div class="flex flex-col items-center mt-8">
            <!-- Teks bantuan -->
            <span class="text-sm text-gray-700 dark:text-gray-400">
                Menampilkan <span class="font-semibold text-gray-900 dark:text-white">1</span> sampai <span
                    class="font-semibold text-gray-900 dark:text-white">10</span> dari <span
                    class="font-semibold text-gray-900 dark:text-white">100</span> data
            </span>
            <!-- Tombol-tombol -->
            <div class="inline-flex mt-2 xs:mt-0">
                <button
                    class="flex items-center justify-center px-3 h-8 text-sm font-medium text-white bg-gray-800 rounded-s hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                    <i class="fa-solid fa-angles-left text-xl mr-2"></i> Sebelumnya
                </button>
                <button
                    class="flex items-center justify-center px-3 h-8 text-sm font-medium text-white bg-gray-800 border-0 border-s border-gray-700 rounded-e hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                    Berikutnya <i class="fa-solid fa-angles-right text-xl ml-2"></i>
                </button>
            </div>
        </div>
        
    </section>
@endsection
