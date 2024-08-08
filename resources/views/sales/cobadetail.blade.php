@extends('sales.default')

@section('content')
    <section class="container mx-auto p-6 relative">
        <h2 class="text-2xl font-bold mb-4 text-center">Detail Pesanan</h2>
        <section class="p-6 border rounded-lg bg-gray-100">
            <!-- Tabel Detail Pesanan -->
            <table class="w-full border-separate border-spacing-0 mb-4 rounded-lg overflow-hidden">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="p-3 text-center">Nama Produk</th>
                        <th class="p-3 text-center">Harga per Slop</th>
                        <th class="p-3 text-center">Jumlah</th>
                        <th class="p-3 text-center">Total Harga</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    <tr class="border-b">
                        <td class="p-3 text-center">Sosrobahu Kopi Hitam</td>
                        <td class="p-3 text-center">Rp. 100.000</td>
                        <td class="p-3 text-center">
                            <div class="flex items-center justify-center space-x-1">
                                <button class="bg-gray-700 text-white text-sm px-2 py-0.5 rounded hover:bg-gray-600"
                                    onclick="changeQuantity('sosrobahu-kopi-hitam', -1)">-</button>
                                <span id="sosrobahu-kopi-hitam-quantity" class="text-lg">1</span>
                                <button class="bg-gray-700 text-white text-sm px-2 py-0.5 rounded hover:bg-gray-600"
                                    onclick="changeQuantity('sosrobahu-kopi-hitam', 1)">+</button>
                            </div>
                        </td>
                        <td class="p-3 text-center" id="sosrobahu-kopi-hitam-total">Rp. 100.000</td>
                    </tr>
                    <tr class="border-b">
                        <td class="p-3 text-center">Sosrobahu D&H</td>
                        <td class="p-3 text-center">Rp. 200.000</td>
                        <td class="p-3 text-center">
                            <div class="flex items-center justify-center space-x-1">
                                <button class="bg-gray-700 text-white text-sm px-2 py-0.5 rounded hover:bg-gray-600"
                                    onclick="changeQuantity('sosrobahu-dh', -1)">-</button>
                                <span id="sosrobahu-dh-quantity" class="text-lg">1</span>
                                <button class="bg-gray-700 text-white text-sm px-2 py-0.5 rounded hover:bg-gray-600"
                                    onclick="changeQuantity('sosrobahu-dh', 1)">+</button>
                            </div>
                        </td>
                        <td class="p-3 text-center" id="sosrobahu-dh-total">Rp. 200.000</td>
                    </tr>
                    <!-- Baris untuk harga keseluruhan -->
                    <tr class="bg-white font-semibold">
                        <td colspan="3" class="p-3 text-right">Harga Keseluruhan</td>
                        <td class="p-3 text-center" id="total-amount">Rp. 300.000</td>
                    </tr>
                </tbody>
            </table>


            <!-- Himbauan Pembayaran -->
            <div class="mb-4 p-4 bg-yellow-100 border border-yellow-400 rounded-lg flex items-center space-x-3">
                <i class="fa-solid fa-triangle-exclamation h-6 w-6 text-yellow-600"></i>
                <p class="text-gray-700">Harap melakukan pembayaran sejumlah <span id="total-amount2">Rp. 300.000</span>
                    melalui transfer BRI 981-628-262 a/n Bapak Adi Sucipto dan upload bukti pembayaran di bawah ini.</p>
            </div>

            <!-- Upload Bukti Pembayaran -->
            <div class="mb-4">
                <label for="payment-proof" class="block text-gray-800 text-lg font-semibold mb-2">Upload Bukti
                    Pembayaran:</label>
                <div class="relative">
                    <input type="file" id="payment-proof" name="payment-proof" accept="image/*,application/pdf"
                        class="border border-gray-300 rounded-lg py-2 px-3 w-full bg-white text-gray-700 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <span class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-500">
                        <i class="fa-solid fa-upload"></i>
                    </span>
                </div>
                <p class="mt-2 text-sm text-gray-500">Supported file types: JPEG, PNG, PDF</p>
            </div>

            <!-- Tombol Pesan -->
            <div class="text-right">
                <button id="order-button" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700"
                    onclick="showConfirmation()">Pesan</button>
            </div>
        </section>
    </section>

    <!-- JavaScript untuk Increment/Decrement dan SweetAlert -->
    <script>
        // Harga per slop
        const prices = {
            'sosrobahu-kopi-hitam': 100000,
            'sosrobahu-dh': 200000
        };

        // Update harga total dan keseluruhan
        function updatePrices() {
            let totalAmount = 0;
            Object.keys(prices).forEach(key => {
                const quantity = parseInt(document.getElementById(`${key}-quantity`).textContent);
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
            let quantity = parseInt(quantityElement.textContent);
            quantity = Math.max(quantity + amount, 1); // Jumlah tidak boleh kurang dari 1
            quantityElement.textContent = quantity;
            updatePrices();
        }

        // Fungsi untuk menampilkan konfirmasi dan redirect
        function showConfirmation() {
            Swal.fire({
                title: 'Terima Kasih!',
                text: 'Pesanan Anda telah diproses. Silakan cek status pesanan Anda pada fitur riwayat.',
                icon: 'success',
                confirmButtonText: 'Selesai'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect ke halaman selesai
                    window.location.href = '/riwayat';
                }
            });
        }

        // Inisialisasi harga total saat halaman dimuat
        updatePrices();
    </script>
@endsection
