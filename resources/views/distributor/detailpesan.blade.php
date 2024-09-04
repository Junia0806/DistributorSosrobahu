@extends('distributor.default')

@section('content')
    <section class="container mx-auto p-6 relative my-10">

        <section class="p-6 bg-white shadow-lg rounded-lg ">
            <h2 class="text-2xl font-bold mb-4 text-center">Detail Pesanan</h2>
            <!-- Tabel Detail Pesanan -->
            <table class="w-full border-separate border-spacing-0 mb-4 rounded-lg overflow-hidden">
                <thead class="bg-gray-800 text-gray-300">
                    <tr>
                        <th class="p-3 text-center">Nama Produk</th>
                        <th class="p-3 text-center">Harga / Karton</th>
                        <th class="p-3 text-center">Jumlah</th>
                        <th class="p-3 text-center">Total Harga</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    <tr class="border-b">
                        <td class="p-3 text-center">Sosrobahu Kopi Hitam</td>
                        <td class="p-3 text-center">Rp. 600.000</td>
                        <td class="p-3 text-center">
                            <div class="flex items-center justify-center space-x-2">
                                <button class="bg-gray-700 text-white text-sm px-2 py-0.5 rounded hover:bg-gray-600"
                                    onclick="changeQuantity('sosrobahu-kopi-hitam', -1)">-</button>
                                <input type="number" id="sosrobahu-kopi-hitam-quantity"
                                    class="w-16 sm:w-24 text-center py-1 border rounded" value="1" min="1"
                                    oninput="updatePrices()">
                                <button class="bg-gray-700 text-white text-sm px-2 py-0.5 rounded hover:bg-gray-600"
                                    onclick="changeQuantity('sosrobahu-kopi-hitam', 1)">+</button>
                            </div>
                        </td>
                        <td class="p-3 text-center" id="sosrobahu-kopi-hitam-total">Rp. 600.000</td>
                    </tr>
                    <tr class="border-b">
                        <td class="p-3 text-center">Sosrobahu D&H</td>
                        <td class="p-3 text-center">Rp. 800.000</td>
                        <td class="p-3 text-center">
                            <div class="flex items-center justify-center space-x-2">
                                <button class="bg-gray-700 text-white text-sm px-2 py-0.5 rounded hover:bg-gray-600"
                                    onclick="changeQuantity('sosrobahu-dh', -1)">-</button>
                                <input type="number" id="sosrobahu-dh-quantity"
                                    class="w-16 sm:w-24 text-center py-1 border rounded" value="1" min="1"
                                    oninput="updatePrices()">
                                <button class="bg-gray-700 text-white text-sm px-2 py-0.5 rounded hover:bg-gray-600"
                                    onclick="changeQuantity('sosrobahu-dh', 1)">+</button>
                            </div>
                        </td>
                        <td class="p-3 text-center" id="sosrobahu-dh-total">Rp. 800.000</td>
                    </tr>
                    <!-- Baris untuk harga keseluruhan -->
                    <tr class="bg-white font-semibold">
                        <td colspan="3" class="p-3 text-right">Harga Keseluruhan</td>
                        <td class="p-3 text-center" id="total-amount">Rp. 1.400.000</td>
                    </tr>
                </tbody>
            </table>

            <!-- Himbauan Pembayaran -->
            <div class="mb-4 p-4 bg-yellow-100 border border-yellow-400 rounded-lg flex items-center space-x-3">
                <i class="fa-solid fa-triangle-exclamation h-6 w-6 text-yellow-600"></i>
                <p class="text-gray-700">Harap melakukan pembayaran sejumlah <span id="total-amount2">Rp. 1.400.000</span>
                    melalui transfer BRI 981-628-262 a/n Bapak Adi Sucipto dan upload bukti pembayaran di bawah ini.</p>
            </div>

            <!-- Upload Bukti Pembayaran -->
            <div class="mb-4">
                <label for="payment-proof" class="block text-gray-800 text-lg font-semibold mb-2">Upload Bukti
                    Pembayaran:</label>
                <div class="relative">
                    <input type="file" id="payment-proof" name="payment-proof" accept="image/*"
                        class="border border-gray-300 rounded-lg py-2 px-3 w-full bg-white text-gray-700 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <span class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-500">
                        <i class="fa-solid fa-upload"></i>
                    </span>
                </div>
                <p class="mt-2 text-sm text-gray-500">Supported file types: JPEG, PNG, JPG</p>
                <p id="file-error" class="mt-2 text-sm text-red-500 hidden">Harap upload bukti pembayaran sebelum kirim pesanan.</p>
            </div>

            <!-- Tombol Pesan -->
            <div class="text-right">
                <button id="order-button"
                    class="bg-gray-800 font-bold text-white py-2 px-10 mt-2 rounded-md hover:bg-gray-700 transition duration-300"
                    onclick="validateAndSubmit()">Kirim Pesanan</button>
            </div>
        </section>
    </section>

    <!-- JavaScript untuk Increment/Decrement, Validasi, dan SweetAlert -->
    <script>
        // Harga per slop
        const prices = {
            'sosrobahu-kopi-hitam': 600000,
            'sosrobahu-dh': 800000
        };

        // Update harga total dan keseluruhan
        function updatePrices() {
            let totalAmount = 0;
            Object.keys(prices).forEach(key => {
                const quantityElement = document.getElementById(`${key}-quantity`);
                let quantity = parseInt(quantityElement.value) || 1;
                quantity = Math.max(quantity, 1); // Pastikan jumlah tidak kurang dari 1
                quantityElement.value = quantity;
                const totalPrice = prices[key] * quantity;
                document.getElementById(`${key}-total`).textContent = `Rp. ${totalPrice.toLocaleString()}`;
                totalAmount += totalPrice;
            });

            document.getElementById('total-amount').textContent = `Rp. ${totalAmount.toLocaleString()}`;
            document.getElementById('total-amount2').textContent = `Rp. ${totalAmount.toLocaleString()}`;
        }

        // Fungsi untuk mengubah jumlah produk
        function changeQuantity(productId, amount) {
            const quantityElement = document.getElementById(`${productId}-quantity`);
            let quantity = parseInt(quantityElement.value) || 1;
            quantity = Math.max(quantity + amount, 1); // Jumlah tidak boleh kurang dari 1
            quantityElement.value = quantity;
            updatePrices();
        }

        // Fungsi untuk memvalidasi input file dan menampilkan konfirmasi
        function validateAndSubmit() {
            const fileInput = document.getElementById('payment-proof');
            const fileError = document.getElementById('file-error');

            if (fileInput.files.length === 0) {
                fileError.classList.remove('hidden');
                fileInput.classList.add('border-red-500');
                return;
            } else {
                fileError.classList.add('hidden');
                fileInput.classList.remove('border-red-500');
            }

            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Anda tidak akan bisa membatalkan pesanan ini!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#388e3c",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Pesan"
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Terimakasih!",
                        text: "Pesanan Anda telah di proses. Cek status pesanan pada fitur riwayat.",
                        icon: "success"
                    }).then(() => {
                        // Redirect to login page or home
                        window.location.href = '/distributor/riwayat'; // Adjust the URL as needed
                    });
                }
            });
        }

        // Inisialisasi harga total saat halaman dimuat
        updatePrices();
    </script>
@endsection
