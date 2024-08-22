@extends('sales.default')

@section('content')
    <section class="container mx-auto p-6 my-20">
        <div class="max-w-4xl mx-auto bg-white shadow-xl rounded-lg overflow-hidden">
            <div class="bg-gray-800 text-white text-center py-6">
                <h2 class="text-3xl font-semibold">Detail Pesanan</h2>
            </div>
            <div class="p-3">
                <p class="text-gray-700">Tanggal pemesanan: 23 Agustus 2024</p>
                <!-- Tabel Detail Pesanan -->
                <table class="w-full my-6">
                    <thead>
                        <tr class="bg-gray-100 text-gray-700">
                            <th class="py-3 px-4 text-left">Nama Produk</th>
                            <th class="py-3 px-4 text-center">Harga / Slop</th>
                            <th class="py-3 px-4 text-center">Jumlah</th>
                            <th class="py-3 px-4 text-right">Total Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b">
                            <td class="py-3 px-4 text-left">Sosrobahu Kopi Hitam</td>
                            <td class="py-3 px-4 text-center">Rp100.000</td>
                            <td class="py-3 px-4 text-center">1</td>
                            <td class="py-3 px-4 text-right">Rp100.000</td>
                        </tr>
                        <tr class="border-b">
                            <td class="py-3 px-4 text-left">Sosrobahu D&H</td>
                            <td class="py-3 px-4 text-center">Rp200.000</td>
                            <td class="py-3 px-4 text-center">1</td>
                            <td class="py-3 px-4 text-right">Rp200.000</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="py-3 px-4 text-right font-semibold">Harga Keseluruhan</td>
                            <td class="py-3 px-4 text-right font-semibold">Rp300.000</td>
                        </tr>
                    </tbody>
                </table>

                <!-- Pemberitahuan Pembayaran -->
                <div id="info" class="mb-6 p-4 bg-yellow-50 border-l-4 border-yellow-400">
                    <div class="flex items-center">
                        <i class="fa-solid fa-triangle-exclamation h-6 w-6 text-yellow-600 mr-3"></i>
                        <p class="text-gray-700">
                            Mohon segera melakukan pembayaran sebesar
                            <span class="font-medium">Rp 300.000</span>
                            ke rekening <span class="font-medium">BRI 981-628-262 a.n. Bapak Adi Sucipto</span>. Setelah
                            melakukan transfer, silakan unggah bukti pembayaran Anda melalui tombol di bawah ini.
                        </p>
                    </div>
                </div>

                <!-- Upload Bukti Pembayaran -->
                <div class="text-center">
                    <button id="upload-button"
                        class="bg-blue-600 text-white px-5 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300"
                        onclick="showUploadSection()">
                        <i class="fas fa-upload mr-2"></i>Unggah Bukti Pembayaran
                    </button>
                </div>

                <!-- Form Upload Bukti Pembayaran -->
                <div id="upload-section" class="mt-6 hidden">
                    <form id="payment-form" class="space-y-4">
                        <div class="text-center">
                            <p class="text-gray-600">Silakan unggah bukti transfer Anda dalam format JPEG, JPG, atau PNG.
                            </p>
                        </div>
                        <div class="flex justify-center">
                            <label for="payment-proof"
                                class="w-full max-w-md flex flex-col items-center px-4 py-6 bg-white rounded-md shadow-md tracking-wide uppercase border border-blue-600 cursor-pointer hover:bg-blue-50">
                                <i class="fas fa-cloud-upload-alt text-blue-600 text-3xl mb-3"></i>
                                <span id="file-name" class="mt-2 text-base leading-normal text-gray-600">Pilih File</span>
                                <input type='file' id="payment-proof" class="hidden" accept=".jpg,.jpeg,.png" required />
                            </label>
                        </div>

                        <div class="text-center">
                            <button type="button"
                                class="bg-green-600 text-white px-5 py-2 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 transition duration-300"
                                onclick="submitPaymentProof()">
                                <i class="fas fa-save mr-2"></i>Simpan Bukti Pembayaran
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Tampilkan Bukti Pembayaran -->
                <div id="proof-section" class="mt-6 hidden">
                    <div class="p-4 bg-green-50 border-l-4 border-green-400">
                        <div class="flex items-center">
                            <i class="fa-solid fa-check text-green-400 mr-2"></i>
                            <p class="text-gray-700">
                                Bukti pembayaran berhasil diunggah:
                                <span id="proof-file-name" class="font-medium text-gray-800"></span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Script -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('payment-proof').addEventListener('change', function() {
            const fileName = this.files.length > 0 ? this.files[0].name : 'Pilih File';
            document.getElementById('file-name').textContent = fileName;
        });

        function showUploadSection() {
            document.getElementById('upload-section').classList.remove('hidden');
            document.getElementById('upload-button').classList.add('hidden');
        }

        function submitPaymentProof() {
            const fileInput = document.getElementById('payment-proof');
            if (fileInput.files.length === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Silakan pilih file bukti pembayaran sebelum mengirim.',
                });
                return;
            }

            // SweetAlert2 confirmation
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Bukti pembayaran hanya bisa diunggah satu kali!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, unggah bukti!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    const fileName = fileInput.files[0].name;
                    document.getElementById('proof-file-name').textContent = fileName;
                    document.getElementById('upload-section').classList.add('hidden');
                    document.getElementById('proof-section').classList.remove('hidden');
                    document.getElementById('info').classList.add('hidden');

                    // Menampilkan pesan sukses dengan SweetAlert
                    Swal.fire(
                        'Berhasil!',
                        'Bukti pembayaran telah diunggah.',
                        'success'
                    )
                }
            });
        }
    </script>
@endsection
