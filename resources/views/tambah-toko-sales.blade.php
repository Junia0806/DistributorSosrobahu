<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Toko</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="w-full max-w-lg p-6 bg-white shadow-md rounded-lg">
        <h1 class="text-3xl font-bold text-gray-900 mb-6 text-center">Tambah Toko</h1>
        <form action="{{ route('daftarTokoSales') }}" method="GET">
            <div class="mb-4">
                <label class="block text-gray-700 text-medium font-bold mb-2" for="storeName">Nama Toko</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="storeName" name="storeName" type="text" placeholder="Nama Toko">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-medium font-bold mb-2" for="location">Lokasi</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="location" name="location" type="text" placeholder="Lokasi">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-medium font-bold mb-2" for="owner">Pemilik</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="owner" name="owner" type="text" placeholder="Pemilik">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-medium font-bold mb-2" for="phoneNumber">No Telpon Toko</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="phoneNumber" name="phoneNumber" type="text" placeholder="No Telpon">
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-medium font-bold mb-2" for="productCount">Jumlah Produk</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="productCount" name="productCount" type="number" placeholder="Jumlah Produk">
            </div>
            <div class="flex items-center justify-center">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Simpan
                </button>
            </div>
        </form>
    </div>

</body>
</html>
