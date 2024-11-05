@extends('pabrik.default')

@section('content')
    <div class="w-full max-w-6xl mx-auto bg-white rounded-lg shadow-lg overflow-x-auto my-20">
        <div class="flex items-center justify-between p-6 border-b">
            <div class="flex-1 text-center">
                <h1 class="text-2xl font-bold text-black text-center w-full">Omset Pemesanan</h1>
            </div>
        </div>

        <div class="overflow-x-auto">
            <div class="my-2 flex justify-center">
                <form method="GET" class="flex items-center w-full max-w-xl justify-center">
                    <div id="date-range-picker" class="flex items-center">
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                </svg>
                            </div>
                            <input id="datepicker-range-start" name="start" type="text"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5"
                                placeholder="Pilih tanggal mulai" value="{{ request('start') }}" required>
                        </div>
                        <span class="mx-4 text-gray-500">sampai</span>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                </svg>
                            </div>
                            <input id="datepicker-range-end" name="end" type="text"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5"
                                placeholder="Pilih tanggal akhir" value="{{ request('end') }}" required>
                        </div>
                    </div>
                    <button type="submit"
                        class="bg-blue-500 text-white p-2 rounded-lg hover:bg-blue-600 transition duration-200 ease-in-out ml-4">Cari</button>
                    <a href="{{ route('omsetPabrik') }}"
                        class="bg-red-500 text-white p-2 rounded-lg hover:bg-red-600 transition duration-200 ease-in-out ml-4">Reset</a>
                </form>
            </div>
            <div class="p-6 bg-gray-50 rounded-lg shadow-lg m-2">
                <div class="mt-4 grid grid-cols-1 sm:grid-cols-3 gap-6">
                    <div
                        class="flex items-center p-6 bg-teal-200 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                        <i class="fa-solid fa-chart-line text-4xl text-teal-600"></i>
                        <div class="ml-4">
                            <p class="text-sm text-gray-600">Keseluruhan Total Harga</p>
                            <p class="text-xl font-semibold text-teal-700">Rp. {{ number_format($totalHarga, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                    <div
                        class="flex items-center p-6 bg-indigo-200 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                        <i class="fa-regular fa-chart-bar text-4xl text-indigo-600"></i>
                        <div class="ml-4">
                            <p class="text-sm text-gray-600">Keseluruhan Karton</p>
                            <p class="text-xl font-semibold text-indigo-700">{{ $totalKarton }}</p>
                        </div>
                    </div>
                    <div
                        class="flex items-center p-6 bg-orange-200 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                        <i class="fa-solid fa-receipt text-4xl text-orange-600"></i>
                        <div class="ml-4">
                            <p class="text-sm text-gray-600">Keseluruhan Transaksi</p>
                            <p class="text-xl font-semibold text-orange-700">{{ $totalTransaksi }}</p>
                        </div>
                    </div>
                </div>
            </div>


            <table class="w-full border-separate border-spacing-0">
                <thead class="bg-gray-800 text-white font-bold">
                    <tr>
                        <th class="p-2 text-left text-sm">Tanggal</th>
                        <th class="p-2 text-left text-sm">Nama Distributor</th>
                        <th class="p-2 text-left text-sm">Total Karton</th>
                        <th class="p-2 text-left text-sm">Total Harga</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @forelse ($omsetPerBulan as $bulan => $data)
                        @foreach ($data['pesanan'] as $pesanan)
                            <tr class="border-b border-gray-200">
                                <td class="p-2">
                                    {{ $pesanan->tanggal ? \Carbon\Carbon::parse($pesanan->tanggal)->format('d/m/Y') : 'Tidak ada tanggal' }}
                                </td>
                                <td class="p-2">{{ $pesanan->nama_distributor }}</td>
                                <td class="p-2">{{ $pesanan->jumlah }}</td>
                                <td class="p-2">Rp. {{ number_format($pesanan->total, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    @empty
                        <tr>
                            <td colspan="4" class="text-center p-4 text-red-500">Data tidak ditemukan untuk bulan dan
                                tahun yang dipilih.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if (!$startDate && !$endDate)
            {{ $pesananMasuks->links() }}
        @endif
    </div>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("#datepicker-range-start", {
            dateFormat: "Y-m-d", // Format tanggal
        });
        flatpickr("#datepicker-range-end", {
            dateFormat: "Y-m-d", // Format tanggal
        });
    </script>
@endsection
