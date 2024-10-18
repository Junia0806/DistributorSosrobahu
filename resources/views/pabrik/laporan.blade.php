@extends('pabrik.default')

@section('content')
<div class="w-full max-w-6xl mx-auto bg-white rounded-lg shadow-lg overflow-x-auto my-20">
    <div class="flex items-center justify-between p-6 border-b">
        <div class="flex-1 text-center">
            <h1 class="text-2xl font-bold text-black text-center w-full">Omset Pemesanan</h1>
        </div>
    </div>

    <div class="overflow-x-auto">
        <div class="my-4 flex justify-center">
            <form method="GET" class="flex items-center w-full max-w-xl justify-center">
                <!-- Date range picker -->
                <div id="date-range-picker" date-rangepicker class="flex items-center">
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                            </svg>
                        </div>
                        <input id="datepicker-range-start" name="start" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5" placeholder="Pilih tanggal mulai" required>
                    </div>
                    <span class="mx-4 text-gray-500">to</span>
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                            </svg>
                        </div>
                        <input id="datepicker-range-end" name="end" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5" placeholder="Pilih tanggal akhir" required>
                    </div>
                </div>

                <button type="submit" class="bg-blue-500 text-white p-2 rounded-lg hover:bg-blue-600 transition duration-200 ease-in-out ml-4">Cari</button>
            </form>
        </div>

        @php
              // Data statis
              $data = [
                (object) ['id' => 1, 'tanggal' => '2024-10-01', 'jumlah' => 50, 'total_harga' => 5000000],
                (object) ['id' => 2, 'tanggal' => '2024-10-05', 'jumlah' => 30, 'total_harga' => 3000000],
                (object) ['id' => 3, 'tanggal' => '2024-10-10', 'jumlah' => 40, 'total_harga' => 4000000],
                (object) ['id' => 4, 'tanggal' => '2024-10-12', 'jumlah' => 20, 'total_harga' => 2000000],
                (object) ['id' => 5, 'tanggal' => '2024-10-15', 'jumlah' => 10, 'total_harga' => 1000000],
                (object) ['id' => 6, 'tanggal' => '2024-10-18', 'jumlah' => 25, 'total_harga' => 2500000],
                (object) ['id' => 7, 'tanggal' => '2024-10-20', 'jumlah' => 35, 'total_harga' => 3500000],
                (object) ['id' => 8, 'tanggal' => '2024-10-22', 'jumlah' => 45, 'total_harga' => 4500000],
                (object) ['id' => 9, 'tanggal' => '2024-10-25', 'jumlah' => 60, 'total_harga' => 6000000],
                (object) ['id' => 10, 'tanggal' => '2024-10-27', 'jumlah' => 15, 'total_harga' => 1500000],
                (object) ['id' => 11, 'tanggal' => '2024-11-02', 'jumlah' => 50, 'total_harga' => 5000000],
                (object) ['id' => 12, 'tanggal' => '2024-11-05', 'jumlah' => 70, 'total_harga' => 7000000],
                (object) ['id' => 13, 'tanggal' => '2024-11-07', 'jumlah' => 40, 'total_harga' => 4000000],
            ];

            // Ambil tanggal start dan end dari input user
            $startDate = request()->get('start');
            $endDate = request()->get('end');

            // Filter data berdasarkan tanggal yang dipilih
            $filteredData = collect($data)->filter(function($item) use ($startDate, $endDate) {
                $tanggalItem = \Carbon\Carbon::parse($item->tanggal);
                return (!$startDate || $tanggalItem >= \Carbon\Carbon::parse($startDate)) &&
                       (!$endDate || $tanggalItem <= \Carbon\Carbon::parse($endDate));
            });

            // Hitung total berdasarkan data yang sudah difilter
            $totalJumlah = $filteredData->sum('jumlah');
            $totalHarga = $filteredData->sum('total_harga');
        @endphp

        <table class="w-full border-separate border-spacing-0">
            <thead class="bg-gray-800 text-white font-bold">
                <tr>
                    <th class="p-2 text-left text-sm">No</th>
                    <th class="p-2 text-left text-sm">Tanggal</th>
                    <th class="p-2 text-left text-sm">Jumlah</th>
                    <th class="p-2 text-left text-sm">Total Harga</th>
                    <th class="p-2 text-left text-sm">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach ($filteredData as $index => $item)
                    <tr class="border-b border-gray-200">
                        <td class="p-2">{{ $index + 1 }}</td>
                        <td class="p-2">{{ \Carbon\Carbon::parse($item->tanggal)->format('d F Y') }}</td>
                        <td class="p-2">{{ $item->jumlah }} Karton</td>
                        <td class="p-2">Rp. {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                        <td class="p-2">
                            <a href="{{ url('/pabrik/detail-laporan/'.$item->id) }}" class="bg-green-600 text-white font-bold py-1 px-3 rounded hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 text-xs">Detail</a>
                        </td>
                    </tr>
                @endforeach

                <!-- Total Keseluruhan -->
                <tr class="bg-gray-100 font-bold">
                    <td colspan="2" class="p-2 text-right">Total Keseluruhan:</td>
                    <td class="p-2">{{ $totalJumlah }} karton</td>
                    <td class="p-2">Rp. {{ number_format($totalHarga, 0, ',', '.') }}</td>
                    <td class="p-2"></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('scripts')
<script>
    flatpickr("#datepicker-range-start", { dateFormat: "Y-m-d" });
    flatpickr("#datepicker-range-end", { dateFormat: "Y-m-d" });
</script>
@endsection