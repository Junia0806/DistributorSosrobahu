<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Toko</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen p-6">

    <div class="w-full max-w-4xl mx-auto bg-white shadow-md rounded-lg overflow-x-auto">
        <div class="flex items-center justify-between p-6 border-b border-gray-200">
            <h1 class="text-3xl font-bold text-gray-900">Detail Toko: {{ $store['name'] }}</h1>
            <a href="{{ route('daftarTokoSales') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Kembali
            </a>
        </div>
        
        <div class="p-6">
            <table class="min-w-full divide-y divide-gray-200">
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr>
                        <td class="px-6 py-4 font-medium text-gray-900">Nama</td>
                        <td class="px-6 py-4">{{ $store['name'] }}</td>
                    </tr>
                    @if (isset($store['image']))
                    <tr>
                        <td class="px-6 py-4 font-medium text-gray-900">Gambar</td>
                        <td class="px-6 py-4">
                            <img src="{{ $store['image'] }}" alt="Gambar Toko" class="w-32 h-32 object-cover">
                        </td>
                    </tr>
                    @endif
                    <tr>
                        <td class="px-6 py-4 font-medium text-gray-900">Lokasi</td>
                        <td class="px-6 py-4">{{ $store['location'] }}</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 font-medium text-gray-900">Pemilik</td>
                        <td class="px-6 py-4">{{ $store['owner'] }}</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 font-medium text-gray-900">No Telpon</td>
                        <td class="px-6 py-4">{{ $store['phone'] }}</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 font-medium text-gray-900">Jumlah Produk</td>
                        <td class="px-6 py-4">{{ $store['products'] }}</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 font-medium text-gray-900">Deskripsi</td>
                        <td class="px-6 py-4">{{ $store['description'] }}</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 font-medium text-gray-900">Jam Operasional</td>
                        <td class="px-6 py-4">{{ $store['opening_hours'] }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
