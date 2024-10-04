@extends('pabrik.default')

@section('content')
    <section class="container mx-auto p-6 my-10">
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h2 class="text-2xl font-bold mb-4 text-center text-gray-800">Detail Restock Produk</h2>
            <!-- Peringatan Pengisian Data -->
            <div
                class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-6 rounded-lg flex items-center space-x-3">
                <i class="fa-solid fa-triangle-exclamation h-6 w-6 text-yellow-600"></i>
                <p class="text-gray-700">
                    Harap masukkan jumlah produk dengan benar dan teliti sebelum menyimpan perubahan.
                </p>
            </div>
            <!-- Tabel Produk untuk Restock -->
            <table class="w-full border-separate border-spacing-0 mb-6 rounded-lg">
                <thead class="bg-gray-800 text-gray-300">
                    <tr>
                        <th class="p-3 text-center">Nama Produk</th>
                        <th class="p-3 text-center">Jumlah (Karton)</th>
                        <th class="p-3 text-center">Total Jumlah</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    <tr class="border-b">
                        <td class="p-3 text-center">Sosrobahu Kopi Hitam</td>
                        <td class="p-3 text-center">
                            <div class="flex items-center justify-center space-x-2">
                                <button class="bg-gray-700 text-white px-2 py-1 rounded hover:bg-gray-600"
                                    onclick="changeQuantity('sosrobahu-kopi-hitam', -1)">-</button>
                                <input type="number" id="sosrobahu-kopi-hitam-quantity"
                                    class="w-16 sm:w-24 text-center py-1 border rounded" value="1" min="1"
                                    oninput="updateTotal()">
                                <button class="bg-gray-700 text-white px-2 py-1 rounded hover:bg-gray-600"
                                    onclick="changeQuantity('sosrobahu-kopi-hitam', 1)">+</button>
                            </div>
                        </td>
                        <td class="p-3 text-center" id="sosrobahu-kopi-hitam-total">1 Karton</td>
                    </tr>
                    <tr class="border-b">
                        <td class="p-3 text-center">Sosrobahu D&H</td>
                        <td class="p-3 text-center">
                            <div class="flex items-center justify-center space-x-2">
                                <button class="bg-gray-700 text-white px-2 py-1 rounded hover:bg-gray-600"
                                    onclick="changeQuantity('sosrobahu-dh', -1)">-</button>
                                <input type="number" id="sosrobahu-dh-quantity"
                                    class="w-16 sm:w-24 text-center py-1 border rounded" value="1" min="1"
                                    oninput="updateTotal()">
                                <button class="bg-gray-700 text-white px-2 py-1 rounded hover:bg-gray-600"
                                    onclick="changeQuantity('sosrobahu-dh', 1)">+</button>
                            </div>
                        </td>
                        <td class="p-3 text-center" id="sosrobahu-dh-total">1 Karton</td>
                    </tr>
                    <!-- Baris untuk harga keseluruhan -->
                    <tr class="bg-white text-lg font-semibold">
                        <td colspan="2" class="p-3 text-right">Total Keseluruhan</td>
                        <td class="p-3 text-center" id="total-jumlah">2 Karton</td>
                    </tr>
                </tbody>
            </table>
            <div class="text-right">
                <button id="order-button"
                    class="bg-gray-800 font-bold text-white py-2 px-10 mt-2 rounded-md hover:bg-gray-700 transition duration-300"
                    onclick="saveRestock()">Simpan</button>
            </div>
        </div>
    </section>

    <script>
        // Fungsi untuk memperbarui total jumlah produk
        function updateTotal() {
            let totalJumlah = 0;
            const products = ['sosrobahu-kopi-hitam', 'sosrobahu-dh'];

            products.forEach(product => {
                const quantityElement = document.getElementById(`${product}-quantity`);
                let quantity = parseInt(quantityElement.value) || 1;
                quantity = Math.max(quantity, 1); // Jumlah tidak boleh kurang dari 1
                quantityElement.value = quantity;

                // Update total per produk
                document.getElementById(`${product}-total`).textContent = `${quantity} Karton`;

                // Total keseluruhan
                totalJumlah += quantity;
            });

            document.getElementById('total-jumlah').textContent = `${totalJumlah} Karton`;
        }

        // Fungsi untuk mengubah jumlah produk
        function changeQuantity(productId, amount) {
            const quantityElement = document.getElementById(`${productId}-quantity`);
            let quantity = parseInt(quantityElement.value) || 1;
            quantity = Math.max(quantity + amount, 1); // Jumlah tidak boleh kurang dari 1
            quantityElement.value = quantity;
            updateTotal();
        }

        function saveRestock() {
            Swal.fire({
                title: 'Konfirmasi Restock',
                text: "Penambahan data produk (restock) tidak dapat dibatalkan. Apakah Anda yakin ingin menyimpan perubahan?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, simpan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                  Swal.fire({
                        title: "Terimakasih!",
                        text: "Data restock Anda berhasil ditambahkan.  Periksa pada fitur riwayat",
                        icon: "success"
                    }).then(() => {
                        window.location.href = '/pabrik/riwayat-restock';
                    });
                }
            });
        }


        // Inisialisasi total jumlah saat halaman dimuat
        updateTotal();
    </script>
@endsection
