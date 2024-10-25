@extends('pabrik.default')

@section('content')
<section class="container mx-auto p-6 my-20">
    <div class="bg-white shadow-lg rounded-lg max-w-full overflow-x-auto">
        <h2 class="text-2xl font-bold border-b mb-5 pb-4 text-center text-black">Riwayat Restock</h2>

        <!-- Search Bar -->
        <div class="flex justify-center mb-6">
            <div class="relative w-full max-w-md">
                <input type="text" placeholder="Cari Tanggal, Jumlah Karton, atau ID Restock"
                    class="border border-gray-300 rounded-lg w-full px-4 py-2 pr-10 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-gray-300 focus:border-gray-400">
                <span class="absolute inset-y-0 right-0 flex items-center pr-3">
                    <i class="fa fa-search text-gray-400"></i>
                </span>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="p-3 text-left text-sm font-semibold tracking-wide">ID Restock</th>
                        <th class="p-3 text-left text-sm font-semibold tracking-wide">Tanggal Restock</th>
                        <th class="p-3 text-left text-sm font-semibold tracking-wide">Jumlah (Karton)</th>
                        <th class="p-3 text-left text-sm font-semibold tracking-wide">Detail</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @foreach ($restockPabriks as $restockPabrik)
                        <tr class="border-b border-gray-200 hover:bg-gray-50 transition ease-in-out duration-150">
                            <td class="p-3">RST1234{{ $restockPabrik->id_restock }}</td> <!-- ID Restock -->
                            <td class="p-3">{{ $restockPabrik->tanggal->format('d/m/Y') }}</td>
                            <td class="p-3">{{ $restockPabrik->jumlah }} Karton</td>
                            <td class="p-3">
                                <button onclick="window.location.href='{{ route('notaPabrik', $restockPabrik->id_restock) }}'"
                                    class="bg-green-600 text-white font-bold py-1 px-3 rounded hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 text-xs">
                                    Lihat
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
@if ($restockPabriks->total() > 10)
    <div class="flex flex-col items-center my-6">
        <!-- Help text -->
        <span class="text-sm text-gray-700 dark:text-gray-400">
            Menampilkan <span class="font-semibold text-gray-900 dark:text-white">{{ $restockPabriks->firstItem() }}</span> sampai
            <span class="font-semibold text-gray-900 dark:text-white">{{ $restockPabriks->lastItem() }}</span> dari
            <span class="font-semibold text-gray-900 dark:text-white">{{ $restockPabriks->total() }}</span> transaksi
        </span>
        <!-- Buttons -->
        <div class="inline-flex mt-2 xs:mt-0">
            <!-- Previous Button -->
            <button {{ $restockPabriks->onFirstPage() ? 'disabled' : '' }}
                class="flex items-center justify-center px-3 h-8 text-sm font-medium text-white bg-gray-800 rounded-s hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                {{ $restockPabriks->previousPageUrl() ? 'onclick=window.location.href=\'' . $restockPabriks->previousPageUrl() . '\'' : '' }}>
                Sebelumnya
            </button>
            <!-- Next Button -->
            <button {{ !$restockPabriks->hasMorePages() ? 'disabled' : '' }}
                class="flex items-center justify-center px-3 h-8 text-sm font-medium text-white bg-gray-800 border-0 border-s border-gray-700 rounded-e hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                {{ $restockPabriks->nextPageUrl() ? 'onclick=window.location.href=\'' . $restockPabriks->nextPageUrl() . '\'' : '' }}>
                Selanjutnya
            </button>
        </div>
    </div>
@endif
</section>
@endsection
