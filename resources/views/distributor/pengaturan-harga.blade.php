@extends('distributor.default')

@section('content')
    <section class="container mx-auto p-6 relative my-20">
        <!-- Pengaturan Harga -->
        <div class=" p-6 border rounded-lg bg-white shadow-lg">
            <h2 class="text-2xl font-bold border-b-2 mb-3 pb-3 text-center">Kelola Harga Jual</h2>
            <!-- Pemberitahuan -->
            <div class="mb-6 p-4 bg-yellow-100 border border-yellow-400 rounded-lg flex items-center space-x-2"
                role="alert">
                <span><i class="fa-solid fa-exclamation-triangle h-6 w-6 text-yellow-600"></i></span>
                <p class="text-gray-700">
                    Harga yang Anda tentukan akan menjadi
                    acuan bagi agen Anda. Pastikan untuk memasukkan harga yang sesuai agar bisnis berjalan dengan lancar.
                </p>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full border-separate border-spacing-0">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-medium">Nama Produk</th>
                            <th class="px-4 py-2 text-left text-sm font-medium">Harga Jual</th>
                            <th class="px-4 py-2 text-left text-sm font-medium">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white text-sm">
                        <!-- Contoh data produk -->
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="px-4 py-2">Sosrobahu Mangga Alpukat</td>
                            <td class="px-4 py-2">Rp.120.000</td>
                            <td class="px-4 py-2">
                                <button type="button"
                                    class="inline-flex items-center justify-center w-10 h-10 text-gray-800 bg-gray-200 border border-gray-300 rounded-sm shadow-sm hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500"
                                    onclick="openModal('Sosrobahu Mangga Alpukat', 120000)">
                                    <i class="fa-regular fa-pen-to-square text-lg"></i>
                                </button>
                            </td>
                        </tr>
                        <!-- Tambahkan produk lainnya -->
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div id="editModal" style="display: none;"
        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md relative">
            <h3 class="text-2xl font-semibold mb-4">Edit Harga Produk</h3>
            <form id="editForm">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Nama Produk</label>
                    <p id="productName" class="block text-sm font-medium text-gray-900 mt-1">Sosrobahu Mangga Alpukat</p>
                </div>
                <div class="mb-4">
                    <label for="productPrice" class="block text-sm font-medium text-gray-700">Harga</label>
                    <input type="number" id="productPrice" class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
                        required>
                </div>
                <div class="flex justify-end space-x-2 mt-4">
                    <button type="submit"
                        class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Simpan</button>
                    <button type="button" class="bg-red-800 text-white px-4 py-2 rounded hover:bg-red-700"
                        onclick="closeModal()">Batal</button>
                </div>
            </form>
            <button class="absolute top-2 right-2 text-gray-500 hover:text-gray-700" onclick="closeModal()">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <script>
        function openModal(productName, productPrice) {
            document.getElementById('productName').innerText = productName;
            document.getElementById('productPrice').value = productPrice;
            document.getElementById('editModal').style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('editModal').style.display = 'none';
        }
    </script>
@endsection
