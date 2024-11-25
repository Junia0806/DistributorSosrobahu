@extends('landing-page.default')

@section('content')

<head>
    <title>Daftar Menjadi Sales</title>
</head>

<div class="container mx-auto py-10">
    <!-- Tata Cara Bergabung Menjadi Sales -->
    <div class="p-6 rounded-lg mb-10 bg-white border border-gray-200 shadow-md">
        <h2 class="text-2xl font-semibold mb-4 text-gray-700">Cara Bergabung Menjadi Sales</h2>
        <p class="mb-2 text-gray-600">Untuk bergabung menjadi sales resmi, Anda dapat menghubungi salah satu agen kami
            yang terdaftar di bawah ini.</p>
        <ul class="list-disc list-inside text-gray-600">
            <li>Hubungi agen terdekat melalui nomor telepon yang tercantum.</li>
            <li>Syarat menjadi sales: pembelian minimum <strong>10 karton</strong> produk pertama.</li>
            <li>Setelah bergabung, Anda akan mendapatkan harga khusus dan akses ke informasi stok secara real-time.</li>
        </ul>
    </div>

    <h1 class="text-3xl font-bold text-center mb-8 text-gray-800">Daftar Agen di Jawa Timur</h1>
    
    <!-- Pencarian Agen -->
    <div class="mb-6">
        <label for="search" class="text-lg font-semibold text-gray-700">Cari Agen:</label>
        <input id="search" type="text"
            class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
            placeholder="Cari agen berdasarkan nama..." onkeyup="filterAgen()">
    </div>

    <!-- Tampilkan Daftar Agen Per Wilayah -->
    @php
        $wilayahAgen = [
            'Surabaya' => [
                ['nama' => 'Agen Sidoarjo', 'alamat' => 'Jl. Raya Surabaya No. 1', 'telepon' => '08123456789'],
                ['nama' => 'Agen Gubeng', 'alamat' => 'Jl. Pahlawan No. 5', 'telepon' => '08198765432']
            ],
            'Malang' => [
                ['nama' => 'Agen Kota Malang', 'alamat' => 'Jl. Malang Raya No. 10', 'telepon' => '08134567890'],
                ['nama' => 'Agen Batu', 'alamat' => 'Jl. Ijen Boulevard No. 20', 'telepon' => '08123412345']
            ],
            'Kediri' => [
                ['nama' => 'Agen Kediri', 'alamat' => 'Jl. Mayor Bismo No. 15', 'telepon' => '08156789123'],
                ['nama' => 'Agen Blitar', 'alamat' => 'Jl. Dhoho No. 8', 'telepon' => '08123456780']
            ],
        ];
    @endphp

    <!-- Looping Data Agen -->
    @foreach($wilayahAgen as $wilayah => $agenList)
        <div class="mb-10">
            <h2 class="text-2xl font-semibold mb-4 text-gray-700">{{ $wilayah }}</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                    <thead class="bg-gray-800 text-white rounded-t-lg">
                        <tr>
                            <th class="p-3 text-left text-sm font-semibold tracking-wide rounded-tl-lg">Nama Agen</th>
                            <th class="p-3 text-left text-sm font-semibold tracking-wide">Alamat</th>
                            <th class="p-3 text-left text-sm font-semibold tracking-wide rounded-tr-lg">Nomor Telepon</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 rounded-b-lg" id="agenList-{{ $wilayah }}">
                        @if (count($agenList) > 0)
                            @foreach($agenList as $agen)
                                <tr class="border-b border-gray-200 hover:bg-gray-50 transition ease-in-out duration-150 agen-item">
                                    <td class="p-3">{{ $agen['nama'] }}</td>
                                    <td class="p-3">{{ $agen['alamat'] }}</td>
                                    <td class="p-3">{{ $agen['telepon'] }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3" class="p-3 text-center">Tidak ada agen ditemukan.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    @endforeach
</div>

<script>
    function filterAgen() {
        const input = document.getElementById('search');
        const filter = input.value.toLowerCase();

        const allAgenRows = document.querySelectorAll('.agen-item');
        allAgenRows.forEach(row => {
            const agenName = row.querySelector('td').textContent.toLowerCase();
            if (agenName.indexOf(filter) > -1) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
</script>

@endsection