@extends('landing-page.default')

@section('content')

<head>
    <title>Daftar Menjadi Agen</title>
</head>

<div class="container mx-auto py-10">
    <!-- Tata Cara Bergabung Menjadi Distributor -->
    <div class="p-6 rounded-lg mb-10 bg-white border border-gray-200 shadow-md">
        <h2 class="text-2xl font-semibold mb-4 text-gray-700">Cara Bergabung Menjadi Agen</h2>
        <p class="mb-2 text-gray-600">Untuk bergabung menjadi distributor resmi, Anda dapat menghubungi salah satu distributor kami yang terdaftar di bawah ini.</p>
        <ul class="list-disc list-inside text-gray-600">
            <li>Hubungi distributor terdekat melalui nomor telepon yang tercantum.</li>
            <li>Syarat menjadi distributor: pembelian minimum <strong>30 karton</strong> produk pertama.</li>
            <li>Setelah bergabung, Anda akan mendapatkan harga khusus dan akses ke informasi stok secara real-time.</li>
        </ul>
    </div>

    <h1 class="text-3xl font-bold text-center mb-8 text-gray-800">Daftar Distributor di Jawa Timur</h1>
    
    <!-- Pencarian Distributor -->
    <div class="mb-6">
        <label for="searchDistributor" class="text-lg font-semibold text-gray-700">Cari Distributor:</label>
        <input id="searchDistributor" type="text"
            class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
            placeholder="Cari distributor berdasarkan nama..." onkeyup="filterDistributor()">
    </div>

    <!-- Tampilkan Daftar Distributor Per Wilayah -->
    @php
        $wilayahDistributor = [
            'Surabaya' => [
                ['nama' => 'Distributor Surabaya', 'alamat' => 'Jl. Raya Surabaya No. 1', 'telepon' => '08123456789'],
                ['nama' => 'Distributor Gubeng', 'alamat' => 'Jl. Pahlawan No. 5', 'telepon' => '08198765432']
            ],
            'Malang' => [
                ['nama' => 'Distributor Kota Malang', 'alamat' => 'Jl. Malang Raya No. 10', 'telepon' => '08134567890'],
                ['nama' => 'Distributor Batu', 'alamat' => 'Jl. Ijen Boulevard No. 20', 'telepon' => '08123412345']
            ],
            'Kediri' => [
                ['nama' => 'Distributor Kediri', 'alamat' => 'Jl. Mayor Bismo No. 15', 'telepon' => '08156789123'],
                ['nama' => 'Distributor Blitar', 'alamat' => 'Jl. Dhoho No. 8', 'telepon' => '08123456780']
            ],
        ];
    @endphp

    <!-- Looping Data Distributor -->
    @foreach($wilayahDistributor as $wilayah => $distributorList)
        <div class="mb-10">
            <h2 class="text-2xl font-semibold mb-4 text-gray-700">{{ $wilayah }}</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                    <thead class="bg-gray-800 text-white rounded-t-lg">
                        <tr>
                            <th class="p-3 text-left text-sm font-semibold tracking-wide rounded-tl-lg">Nama Distributor</th>
                            <th class="p-3 text-left text-sm font-semibold tracking-wide">Alamat</th>
                            <th class="p-3 text-left text-sm font-semibold tracking-wide rounded-tr-lg">Nomor Telepon</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 rounded-b-lg" id="distributorList-{{ $wilayah }}">
                        @if (count($distributorList) > 0)
                            @foreach($distributorList as $distributor)
                                <tr class="border-b border-gray-200 hover:bg-gray-50 transition ease-in-out duration-150 distributor-item">
                                    <td class="p-3">{{ $distributor['nama'] }}</td>
                                    <td class="p-3">{{ $distributor['alamat'] }}</td>
                                    <td class="p-3">{{ $distributor['telepon'] }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3" class="p-3 text-center">Tidak ada distributor ditemukan.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    @endforeach
</div>

<script>
    function filterDistributor() {
        const input = document.getElementById('searchDistributor');
        const filter = input.value.toLowerCase();

        const allDistributorRows = document.querySelectorAll('.distributor-item');
        allDistributorRows.forEach(row => {
            const distributorName = row.querySelector('td').textContent.toLowerCase();
            if (distributorName.indexOf(filter) > -1) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
</script>

@endsection
