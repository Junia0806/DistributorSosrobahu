@extends('pabrik.default')

@section('content')
    <section class="container mx-auto p-6 relative my-20">
        <div class="p-6 border rounded-lg bg-white shadow-lg">
            <h2 class="text-2xl font-bold border-b-2 mb-3 pb-3 text-center">Kelola Produk</h2>
            <div class="mb-4 text-right">
                <button type="button"
                    class="bg-gray-800 text-white py-2 px-4 rounded-md hover:bg-gray-700 transition duration-300"
                    onclick="openAddProductModal()">
                    <i class="fa-regular fa-square-plus"></i>
                    Tambah Produk
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full border-separate border-spacing-0">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-medium">Foto Produk</th>
                            <th class="px-4 py-2 text-left text-sm font-medium">Nama Produk</th>
                            <th class="px-4 py-2 text-left text-sm font-medium">Isian (slop)</th>
                            <th class="px-4 py-2 text-left text-sm font-medium">Harga Jual</th>
                            <th class="px-4 py-2 text-left text-sm font-medium">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white text-sm">
                        <!-- Contoh data produk -->
                        @for ($i = 1; $i <= 6; $i++)
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="px-4 py-2">
                                    <img src="{{ asset('assets/images/produk' . $i . '.jpg') }}"
                                        alt="Sosrobahu Mangga Alpukat" class="w-16 h-16 object-cover">
                                </td>
                                <td class="px-4 py-2">Sosrobahu Mangga Alpukat</td>
                                <td class="px-4 py-2">60</td>
                                <td class="px-4 py-2">Rp.120.000</td>
                                <td class="px-4 py-2 flex space-x-2">
                                    <button type="button"
                                        class="inline-flex items-center justify-center w-10 h-10 text-gray-800 bg-gray-200 border border-gray-300 rounded-sm shadow-sm hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500"
                                        onclick="openEditModal('Sosrobahu Mangga Alpukat', 120000, '{{ asset('assets/images/produk' . $i . '.jpg') }}', 60)">
                                        <i class="fa-regular fa-pen-to-square text-lg"></i>
                                    </button>
                                    <button type="button"
                                        class="inline-flex items-center justify-center w-10 h-10 text-red-800 bg-red-200 border border-red-300 rounded-sm shadow-sm hover:bg-red-300 focus:outline-none focus:ring-2 focus:ring-red-500"
                                        onclick="deleteProduct('Sosrobahu Mangga Alpukat')">
                                        <i class="fa-solid fa-trash text-lg"></i>
                                    </button>
                                </td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Modal Edit Produk -->
<div id="editModal" style="display: none;"
    class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-3xl relative"> <!-- Mengubah ukuran modal -->
        <h3 class="text-2xl font-semibold mb-4">Edit Produk</h3>
        <div class="flex space-x-6"> <!-- Flex untuk membagi menjadi 2 kolom -->
            <!-- Bagian kiri untuk Foto Produk -->
            <div class="w-1/2 flex flex-col items-center"> <!-- Menggunakan w-1/2 untuk 50% lebar -->
                <label class="block text-sm font-medium text-gray-700 mb-2">Foto Produk</label>
                <img id="editProductImage" alt="Product Image" class="w-64 h-64 object-cover mb-4"> <!-- Ukuran lebih besar -->
                <input type="file" id="productImageInput" class="mt-1 block w-full border border-gray-300 rounded-md"
                    accept="image/*">
            </div>
            <!-- Bagian kanan untuk Form -->
            <div class="w-1/2"> <!-- Menggunakan w-1/2 untuk 50% lebar -->
                <form id="editForm">
                    <div class="mb-4">
                        <label for="productNameInput" class="block text-sm font-medium text-gray-700">Nama Produk</label>
                        <input type="text" id="productNameInput"
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                    </div>
                    <div class="mb-4">
                        <label for="productSlop" class="block text-sm font-medium text-gray-700">Isian (slop)</label>
                        <input type="number" id="productSlop" class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
                            required>
                    </div>
                    <div class="mb-4">
                        <label for="productPrice" class="block text-sm font-medium text-gray-700">Harga Jual</label>
                        <input type="number" id="productPrice" class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
                            required>
                    </div>
                    <div class="flex justify-end space-x-2 mt-4">
                        <button type="submit"
                            class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Simpan</button>
                        <button type="button" class="bg-red-800 text-white px-4 py-2 rounded hover:bg-red-700"
                            onclick="closeEditModal()">Batal</button>
                    </div>
                </form>
            </div>
        </div>
        <button class="absolute top-2 right-2 text-gray-500 hover:text-gray-700" onclick="closeEditModal()">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
</div>

    <!-- Modal Tambah Produk -->
    <div id="addProductModal" style="display: none;"
        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md relative">
            <h3 class="text-2xl font-semibold mb-4">Tambah Produk</h3>
            <form id="addProductForm">
                <div class="mb-4">
                    <label for="newProductName" class="block text-sm font-medium text-gray-700">Nama Produk</label>
                    <input type="text" id="newProductName"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                </div>
                <div class="mb-4">
                    <label for="newProductPrice" class="block text-sm font-medium text-gray-700">Harga Jual</label>
                    <input type="number" id="newProductPrice"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                </div>
                <div class="mb-4">
                    <label for="newProductSlop" class="block text-sm font-medium text-gray-700">Isian (slop)</label>
                    <input type="number" id="newProductSlop"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                </div>

                <div class="mb-4">
                    <label for="newProductImage" class="block text-sm font-medium text-gray-700">Foto Produk</label>
                    <input type="file" id="newProductImage"
                        class="mt-1 block w-full border border-gray-300 rounded-md" accept="image/*">
                </div>
                <div class="flex justify-end space-x-2 mt-4">
                    <button type="submit"
                        class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Simpan</button>
                    <button type="button" class="bg-red-800 text-white px-4 py-2 rounded hover:bg-red-700"
                        onclick="closeAddProductModal()">Batal</button>
                </div>
            </form>
            <button class="absolute top-2 right-2 text-gray-500 hover:text-gray-700" onclick="closeAddProductModal()">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <script>
        function openEditModal(productName, productPrice, productImage, productSlop) {
            document.getElementById('productNameInput').value = productName;
            document.getElementById('productPrice').value = productPrice;
            document.getElementById('productSlop').value = productSlop;
            document.getElementById('editProductImage').src = productImage;
            document.getElementById('editModal').style.display = 'flex';
        }

        function closeEditModal() {
            document.getElementById('editModal').style.display = 'none';
        }

        function openAddProductModal() {
            document.getElementById('addProductModal').style.display = 'flex';
        }

        function closeAddProductModal() {
            document.getElementById('addProductModal').style.display = 'none';
        }

        function deleteProduct(productName) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: `Anda akan menghapus produk ${productName}`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Aksi penghapusan produk
                    console.log(`Produk ${productName} dihapus`);
                    // Tambahkan kode penghapusan produk di sini
                    Swal.fire(
                        'Dihapus!',
                        `Produk ${productName} telah dihapus.`,
                        'success'
                    )
                }
            });
        }
    </script>
@endsection
