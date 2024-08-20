@extends('sales.default')

@section('content')
    <section class="container mx-auto p-6 relative my-10">
        <form action="{{ route('simpan_order') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <!-- Detail Pesanan Section -->
            <section class="p-6 bg-white shadow-lg rounded-lg">
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
                        {{ $totalBarang = 0 }}
                        @foreach ($orders as $index => $order)
                        <tr class="border-b">
                            <td class="p-3 text-center"> {{ $namaRokokList[$index] }}</td>
                            <td class="p-3 text-center">Rp {{ number_format($order->harga_agen, 0, ',', '.') }}</td>
                            <td class="p-3 text-center">
                                <div class="flex items-center justify-center space-x-2">
                                    <button type="button" class="bg-gray-700 text-white text-sm px-2 py-0.5 rounded hover:bg-gray-600"
                                        onclick="changeQuantity('{{ $order->id_master_barang }}', -1)">-</button>
                                    <input type="number" id="{{ $order->id_master_barang }}-quantity"
                                        name="quantities[{{ $order->id_master_barang }}]"
                                        class="w-16 sm:w-24 text-center py-1 border rounded" value="{{ $order->jumlah }}" min="1"
                                        oninput="updatePrices()">
                                    <button type="button" class="bg-gray-700 text-white text-sm px-2 py-0.5 rounded hover:bg-gray-600"
                                        onclick="changeQuantity('{{ $order->id_master_barang }}', 1)">+</button>
                                </div>
                            </td>
                            
                            
                            <td class="p-3 text-center" id="{{ $order->id_master_barang }}-total">
                                Rp {{ number_format($order->harga_agen * $order->jumlah, 0, ',', '.') }}
                            </td>
                        </tr>
                        @endforeach
                        <!-- Baris untuk harga keseluruhan -->
                        <tr class="bg-white font-semibold">
                            
                            <td colspan="3" class="p-3 text-right">Harga Keseluruhan</td>
                            <td class="p-3 text-center" id="total-amount">Rp {{ number_format(0, 0, ',', '.') }}</td>
                        </tr>
                        <tr class="bg-white font-semibold">
                            <td colspan="3" class="p-3 text-right">Total Barang</td>
                            <td class="p-3 text-center" id="total-items">0 items</td>
                        </tr>
                    </tbody>
                </table>

                <!-- Himbauan Pembayaran -->
                <div class="mb-4 p-4 bg-yellow-100 border border-yellow-400 rounded-lg flex items-center space-x-3">
                    <i class="fa-solid fa-triangle-exclamation h-6 w-6 text-yellow-600"></i>
                    <p class="text-gray-700">Harap melakukan pembayaran sejumlah <span id="total-amount2">Rp {{ number_format($totalAmount, 0, ',', '.') }}</span>
                        melalui transfer BRI 981-628-262 a/n Bapak Adi Sucipto dan upload bukti pembayaran di bawah ini.</p>
                </div>

                <!-- Upload Bukti Pembayaran -->
                <div class="mb-4">
                    <label for="payment-proof" class="block text-gray-800 text-lg font-semibold mb-2">Upload Bukti
                        Pembayaran:</label>
                    <div class="relative">
                        <input type="file" id="payment-proof" name="payment_proof" accept="image/*,application/pdf"
                            class="border border-gray-300 rounded-lg py-2 px-3 w-full bg-white text-gray-700 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <span class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-500">
                            <i class="fa-solid fa-upload"></i>
                        </span>
                    </div>
                    <p class="mt-2 text-sm text-gray-500">Supported file types: JPEG, PNG, PDF</p>
                </div>

                <!-- Tombol Pesan -->
                <div class="text-right">
                    <input type="text" id="total-amount-hidden" name="total_amount" value="{{ $totalAmount }}">
                    <input type="text" id="total-items-hidden" name="total_items" value="0">
                    <button id="order-button" type="submit"
                        class="bg-gray-800 font-bold text-white py-2 px-10 mt-2 rounded-md hover:bg-gray-700 transition duration-300">
                        Kirim Pesanan
                    </button>
                </div>
            </section>
        </form>
    </section>

    <!-- JavaScript untuk Increment/Decrement, Validasi, dan SweetAlert -->
    <script>
        // Harga per slop
        const prices = @json($prices);
    
        // Update harga total dan keseluruhan
        
        function updatePrices() {
            let totalAmount = 0;
            let totalItems = 0;
            Object.keys(prices).forEach(key => {
                const quantityElement = document.getElementById(`${key}-quantity`);
                let quantity = parseInt(quantityElement.value) || 1;
                quantity = Math.max(quantity, 1); // Pastikan jumlah tidak kurang dari 1
                quantityElement.value = quantity;
                const totalPrice = prices[key] * quantity;
                document.getElementById(`${key}-total`).textContent = `Rp. ${totalPrice.toLocaleString()}`;
                totalAmount += totalPrice;
                totalItems += quantity;
            });

            document.getElementById('total-amount').textContent = `Rp. ${totalAmount.toLocaleString()}`;
            document.getElementById('total-amount2').textContent = `Rp. ${totalAmount.toLocaleString()}`;
            document.getElementById('total-items').textContent = `${totalItems} items`; // Menampilkan total barang

            // Update hidden input field with total amount
            document.getElementById('total-amount-hidden').value = totalAmount;
            document.getElementById('total-items-hidden').value = totalItems;
        }

    
        // Fungsi untuk mengubah jumlah produk
        function changeQuantity(productId, amount) {
            const quantityElement = document.getElementById(`${productId}-quantity`);
            let quantity = parseInt(quantityElement.value) || 1;
            quantity = Math.max(quantity + amount, 1); // Jumlah tidak boleh kurang dari 1
            quantityElement.value = quantity;
            updatePrices();

            document.getElementById('quantity-item').value = quantity;
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
                        text: "Pesanan Anda telah di proses. Bukti pembayaran telah dikirim.",
                        icon: "success",
                        confirmButtonColor: "#388e3c"
                    }).then(() => {
                        document.querySelector('form').submit();
                    });
                }
            });
        }
    
        // Panggil updatePrices saat halaman dimuat
        document.addEventListener('DOMContentLoaded', updatePrices);
    </script>
    
@endsection
