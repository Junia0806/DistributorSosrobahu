@extends('landing-page.default')

@section('content')

<head>
    <title>Daftar Menjadi Agen</title>
</head>

<div class="container mx-auto py-10">
    <!-- Tata Cara Bergabung Menjadi Distributor -->
    <div class="p-6 rounded-lg mb-10 bg-white border border-gray-200 shadow-md">
        <h2 class="text-2xl font-semibold mb-4 text-gray-700">Cara Bergabung Menjadi Agen </h2>
        <p class="mb-2 text-gray-600">Untuk bergabung menjadi distributor resmi, Anda dapat menghubungi salah satu distributor kami yang terdaftar di bawah ini.</p>
        <ul class="list-disc list-inside text-gray-600">
            <li>Hubungi distributor terdekat melalui nomor telepon yang tercantum.</li>
            <li>Syarat menjadi distributor: pembelian minimum <strong>30 karton</strong> produk pertama.</li>
            <li>Setelah bergabung, Anda akan mendapatkan harga khusus dan akses ke informasi stok secara real-time.</li>
        </ul>
    </div>

    <!-- Pilih Provinsi -->
    <div class="mb-6">
        <label for="provinsi" class="block text-gray-700">Pilih Provinsi:</label>
        <select id="provinsi" class="mt-2 p-2 border border-gray-300 rounded-md w-full">
            <option value="">Pilih Provinsi</option>
            @foreach ($provinsiList as $provinsi)
                <option value="{{ $provinsi }}">{{ $provinsi }}</option>
            @endforeach
        </select>
    </div>

    <!-- Daftar distributor -->
    <div id="distributorListContainer" class="overflow-x-auto">
        <div id="message" class="text-center text-gray-500 py-4">Pilih provinsi terlebih dahulu</div>

        <table id="distributorTable" class="min-w-full bg-white border border-gray-200 rounded-lg hidden">
            <thead class="bg-gray-800 text-white rounded-t-lg">
                <tr>
                    <th class="p-2 text-left">Nama Distributor</th>
                    <th class="p-2 text-left">Alamat</th>
                    <th class="p-2 text-left">Provinsi</th>
                    <th class="p-2 text-left">No Telpon</th>
                </tr>
            </thead>
            <tbody class="text-gray-700 rounded-b-lg" id="distributorList">
                @forelse ($akunDistributor as $distributor)
                    <tr class="border-b distributorRow" data-provinsi="{{ $distributor->provinsi }}">
                        <td class="p-2">{{ $distributor->nama_lengkap }}</td>
                        <td class="p-2">{{ $distributor->alamat ?? '-' }}</td>
                        <td class="p-2">{{ $distributor->provinsi ?? '-' }}</td>
                        <td class="p-2">
                            <a href="https://wa.me/62{{ $distributor->no_telp }}" target="_blank" class="text-blue-500 hover:underline">
                                {{ $distributor->no_telp }}
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="p-4 text-center text-gray-500">Tidak ada data Distributor yang ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
    document.getElementById('provinsi').addEventListener('change', function () {
        var selectedProvinsi = this.value;
        var distributorList = document.querySelectorAll('.distributorRow');
        var message = document.getElementById('message');
        var distributorTable = document.getElementById('distributorTable');

        // Menyembunyikan pesan "Pilih provinsi terlebih dahulu" dan tabel distributor
        message.classList.add('hidden');
        distributorTable.classList.add('hidden');

        // Filter distributor berdasarkan provinsi yang dipilih
        var isDataFound = false;
        distributorList.forEach(function (distributor) {
            var distributorProvinsi = distributor.getAttribute('data-provinsi');
            if (selectedProvinsi === "" || distributorProvinsi === selectedProvinsi) {
                distributor.style.display = '';
                isDataFound = true;
            } else {
                distributor.style.display = 'none';
            }
        });

        // Menampilkan tabel jika ada distributor yang ditemukan
        if (isDataFound) {
            distributorTable.classList.remove('hidden');
        } else {
            message.classList.remove('hidden');
            message.textContent = "Tidak ada distributor yang ditemukan untuk provinsi ini.";
        }
    });
</script>
@endsection