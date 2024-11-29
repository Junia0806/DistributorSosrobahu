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

    <!-- Daftar Agen -->
    <div id="agenListContainer" class="overflow-x-auto">
        <div id="message" class="text-center text-gray-500 py-4">Pilih provinsi terlebih dahulu</div>

        <table id="agenTable" class="min-w-full bg-white border border-gray-200 rounded-lg hidden">
            <thead class="bg-gray-800 text-white rounded-t-lg">
                <tr>
                    <th class="p-2 text-left">Nama Agen</th>
                    <th class="p-2 text-left">Alamat</th>
                    <th class="p-2 text-left">Provinsi</th>
                    <th class="p-2 text-left">No Telpon</th>
                </tr>
            </thead>
            <tbody class="text-gray-700 rounded-b-lg" id="agenList">
                @forelse ($akunAgen as $agen)
                    <tr class="border-b agenRow" data-provinsi="{{ $agen->provinsi }}">
                        <td class="p-2">{{ $agen->nama_lengkap }}</td>
                        <td class="p-2">{{ $agen->alamat ?? '-' }}</td>
                        <td class="p-2">{{ $agen->provinsi ?? '-' }}</td>
                        <td class="p-2">{{ $agen->no_telp }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="p-4 text-center text-gray-500">Tidak ada data Agen yang ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
    document.getElementById('provinsi').addEventListener('change', function () {
        var selectedProvinsi = this.value;
        var agenList = document.querySelectorAll('.agenRow');
        var message = document.getElementById('message');
        var agenTable = document.getElementById('agenTable');

        // Menyembunyikan pesan "Pilih provinsi terlebih dahulu" dan tabel agen
        message.classList.add('hidden');
        agenTable.classList.add('hidden');

        // Filter agen berdasarkan provinsi yang dipilih
        var isDataFound = false;
        agenList.forEach(function (agen) {
            var agenProvinsi = agen.getAttribute('data-provinsi');
            if (selectedProvinsi === "" || agenProvinsi === selectedProvinsi) {
                agen.style.display = '';
                isDataFound = true;
            } else {
                agen.style.display = 'none';
            }
        });

        // Menampilkan tabel jika ada agen yang ditemukan
        if (isDataFound) {
            agenTable.classList.remove('hidden');
        } else {
            message.classList.remove('hidden');
            message.textContent = "Tidak ada agen yang ditemukan untuk provinsi ini.";
        }
    });
</script>
@endsection