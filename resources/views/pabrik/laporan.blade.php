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
                <div class="flex items-center mx-2">
                    <label for="bulan" class="mr-2 text-sm font-medium text-black">Bulan:</label>
                    <select name="bulan" id="bulan"
                        class="border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <option value="01">Januari</option>
                        <option value="02">Februari</option>
                        <option value="03">Maret</option>
                        <option value="04">April</option>
                        <option value="05">Mei</option>
                        <option value="06">Juni</option>
                        <option value="07">Juli</option>
                        <option value="08">Agustus</option>
                        <option value="09">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                    </select>
                </div>

                <div class="flex items-center mx-2">
                    <label for="tahun" class="mr-2 text-sm font-medium text-black">Tahun:</label>
                    <select name="tahun" id="tahun"
                        class="border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <option value="2024">2024</option>
                        <option value="2023">2023</option>
                        <option value="2022">2022</option>
                        <option value="2021">2021</option>
                        <option value="2020">2020</option>
                        <option value="2019">2019</option>
                    </select>
                </div>

                <button type="submit"
                    class="bg-blue-500 text-white p-2 rounded-lg hover:bg-blue-600 transition duration-200 ease-in-out">
                    Cari
                </button>
            </form>
        </div>

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
                <tr class="border-b border-gray-200">
                    <td class="p-2">1</td>
                    <td class="p-2">10 Agustus 2024</td>
                    <td class="p-2">4 Karton</td>
                    <td class="p-2">Rp. 4.000.000</td>
                    <td class="p-2">
                        <a href="{{ url('/pabrik/detail-laporan') }}"
                            class="bg-green-600 text-white font-bold py-1 px-3 rounded hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 text-xs">Detail</a>
                    </td>
                </tr>
                <tr class="border-b border-gray-200">
                    <td class="p-2">2</td>
                    <td class="p-2">13 Agustus 2024</td>
                    <td class="p-2">8 Karton</td>
                    <td class="p-2">Rp. 8.000.000</td>
                    <td class="p-2">
                        <a href="{{ url('/pabrik/detail-laporan') }}"
                            class="bg-green-600 text-white font-bold py-1 px-3 rounded hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 text-xs">Detail</a>
                    </td>
                </tr>

                <!-- Baris untuk Total Keseluruhan -->
                <tr class="bg-gray-100 font-bold">
                    <td colspan="3" class="p-2 text-right">Total Keseluruhan:</td>
                    <td class="p-2">Rp. 12.000.000</td>
                    <td class="p-2"></td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection