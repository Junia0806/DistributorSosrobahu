<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kunjungan</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-6">

    <div class="w-full max-w-lg bg-white shadow-lg rounded-lg p-6">
        <h1 class="text-3xl font-bold text-gray-900 mb-6 text-center">Tambah Kunjungan</h1>
        <form action="{{ route('daftarKunjunganSales') }}" method="GET">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 text-medium font-bold mb-2" for="visitDate">Tanggal Kunjungan</label>
                <input class="shadow appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="visitDate" name="visitDate" type="date" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-medium font-bold mb-2" for="remainingProducts">Sisa Produk</label>
                <input class="shadow appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="remainingProducts" name="remainingProducts" type="number" placeholder="Sisa Produk" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-medium font-bold mb-2" for="documentation">Dokumentasi</label>
                <input class="shadow appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="documentation" name="documentation" type="file" accept="image/*">
            </div>
            <div class="flex items-center justify-center">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline transition duration-300 ease-in-out" type="submit">
                    Simpan
                </button>
            </div>
        </form>
    </div>

</body>
</html>
