<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kunjungan Toko</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://unpkg.com/flowbite@1.6.0/dist/flowbite.min.css" rel="stylesheet">
    <script src="https://unpkg.com/flowbite@1.6.0/dist/flowbite.min.js"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6">

    <div class="w-full max-w-6xl mx-auto bg-white shadow-lg rounded-lg">
        <div class="flex items-center justify-between p-6 border-b border-gray-200 bg-gray-50 rounded-t-lg">
            <h1 class="text-3xl font-bold text-gray-900">Daftar Kunjungan Toko</h1>
            <a href="{{ route('tambahKunjunganSales') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-300 ease-in-out">
                Tambah Kunjungan
            </a>
        </div>
        
        <!-- Tabel Daftar Kunjungan -->
        <div class="overflow-x-auto p-6">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-xl font-medium text-gray-500 uppercase tracking-wider text-center">No</th>
                        <th class="px-6 py-3 text-xl font-medium text-gray-500 uppercase tracking-wider text-center">Tanggal</th>
                        <th class="px-6 py-3 text-xl font-medium text-gray-500 uppercase tracking-wider text-center">Sisa Produk</th>
                        <th class="px-6 py-3 text-xl font-medium text-gray-500 uppercase tracking-wider text-center">Dokumentasi</th>
                        <th class="px-6 py-3 text-xl font-medium text-gray-500 uppercase tracking-wider text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr>
                        <td class="px-6 py-4 text-center text-base text-gray-500">1</td>
                        <td class="px-6 py-4 text-center text-base text-gray-500">2024/08/08</td>
                        <td class="px-6 py-4 text-center text-base text-gray-500">50</td>
                        <td class="px-6 py-4 text-center text-base text-gray-500 flex justify-center">
                            <img src="https://th.bing.com/th/id/OIP.Y3m6hCSGqtCPzVRXKzNw2gHaFj?rs=1&pid=ImgDetMain" alt="Dokumentasi" class="w-24 h-24 object-cover rounded-lg shadow-sm">
                        </td>
                        <td class="px-6 py-4 text-center text-base font-medium">
                            <a href="#" class="text-blue-600 hover:text-blue-900">Edit</a>
                            <a href="#" class="text-red-600 hover:text-red-900 ml-4">Hapus</a>
                        </td>
                    </tr>

                    <tr>
                        <td class="px-6 py-4 text-center text-base text-gray-500">2</td>
                        <td class="px-6 py-4 text-center text-base text-gray-500">2024/08/07</td>
                        <td class="px-6 py-4 text-center text-base text-gray-500">5</td>
                        <td class="px-6 py-4 text-center text-base text-gray-500 flex justify-center">
                            <img src="https://s3-media0.fl.yelpcdn.com/bphoto/ZwMMkb_5AC4KB5GF6pS92g/l.jpg" alt="Dokumentasi" class="w-24 h-24 object-cover rounded-lg shadow-sm">
                        </td>
                        <td class="px-6 py-4 text-center text-base font-medium">
                            <a href="#" class="text-blue-600 hover:text-blue-900">Edit</a>
                            <a href="#" class="text-red-600 hover:text-red-900 ml-4">Hapus</a>
                        </td>
                    </tr>

                    <tr>
                        <td class="px-6 py-4 text-center text-base text-gray-500">3</td>
                        <td class="px-6 py-4 text-center text-base text-gray-500">2024/08/06</td>
                        <td class="px-6 py-4 text-center text-base text-gray-500">20</td>
                        <td class="px-6 py-4 text-center text-base text-gray-500 flex justify-center">
                            <img src="https://th.bing.com/th?id=OIP.aWCclvQJZwv555KAfmMUVwHaFV&w=294&h=212&c=8&rs=1&qlt=90&o=6&pid=3.1&rm=2" alt="Dokumentasi" class="w-24 h-24 object-cover rounded-lg shadow-sm">
                        </td>
                        <td class="px-6 py-4 text-center text-base font-medium">
                            <a href="#" class="text-blue-600 hover:text-blue-900">Edit</a>
                            <a href="#" class="text-red-600 hover:text-red-900 ml-4">Hapus</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
