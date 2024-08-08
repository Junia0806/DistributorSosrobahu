<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Toko</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen p-6">

    <div class="w-full max-w-6xl mx-auto bg-white shadow-md rounded-lg overflow-x-auto">
        <div class="flex items-center justify-between p-6 border-b border-gray-200">
            <h1 class="text-3xl font-bold text-gray-900">Daftar Toko</h1>
            <a href="{{ route('tambahTokoSales') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Tambah Toko
            </a>
        </div>
        
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Tabel Daftar Toko -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-medium text-center font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-medium font-medium text-gray-500 uppercase tracking-wider">Nama Toko</th>
                        <th class="px-6 py-3 text-medium text-center font-medium text-gray-500 uppercase tracking-wider">Lokasi</th>
                        <th class="px-6 py-3 text-medium text-center font-medium text-gray-500 uppercase tracking-wider">Pemilik</th>
                        <th class="px-6 py-3 text-medium text-center font-medium text-gray-500 uppercase tracking-wider">No Telpon</th>
                        <th class="px-6 py-3 text-medium text-center font-medium text-gray-500 uppercase tracking-wider">Jumlah Produk</th>
                        <th class="px-6 py-3 text-medium text-center font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-base text-gray-500">1</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-base font-medium text-gray-900">Toko Yoongi</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-base text-gray-500">Daegu</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-base text-gray-500">Min Yoongi</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-base text-gray-500">09031993</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-base text-gray-500">50</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-base font-medium">
                            <a href="{{ route('detailTokoSales', ['id' => 1]) }}" class="text-blue-600 hover:text-blue-900">Detail</a>
                        </td>
                    </tr>

                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-base text-gray-500">2</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-base font-medium text-gray-900">Toko Frozen</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-base text-gray-500">Arendelle</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-base text-gray-500">Elsa</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-base text-gray-500">19112013</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-base text-gray-500">20</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-base font-medium">
                            <a href="{{ route('detailTokoSales', ['id' => 2]) }}" class="text-blue-600 hover:text-blue-900">Detail</a>
                        </td>
                    </tr>

                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-base text-gray-500">3</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-base font-medium text-gray-900">Toko U&I</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-base text-gray-500">Durian Runtuh</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-base text-gray-500">Kak Ros</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-base text-gray-500">2009876</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-base text-gray-500">200</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-base font-medium">
                            <a href="{{ route('detailTokoSales', ['id' => 3]) }}" class="text-blue-600 hover:text-blue-900">Detail</a>
                        </td>
                    </tr>

                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-base text-gray-500">4</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-base font-medium text-gray-900">Toko Berkah</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-base text-gray-500">Seoul</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-base text-gray-500">Subin</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-base text-gray-500">267543</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-base text-gray-500">20</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-base font-medium">
                            <a href="{{ route('detailTokoSales', ['id' => 4]) }}" class="text-blue-600 hover:text-blue-900">Detail</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
