@extends('sales.default')

@section('content')
    <section class="container mx-auto p-6 my-20">
        <div class="max-w-4xl mx-auto bg-white shadow-xl rounded-lg overflow-hidden">
            <div class="bg-gray-800 text-white text-center py-6">
                <h2 class="text-3xl font-semibold">Detail Pesanan</h2>
            </div>
            <div class="p-3">
                <p class="text-gray-700">Tanggal pemesanan: {{ $notaSales['tanggal'] }}</p>

                <!-- Tabel Detail Pesanan -->
                <table class="w-full my-6">
                    <thead>
                        <tr class="bg-gray-100 text-gray-700">
                            <th class="py-3 px-4 text-left">Nama Produk</th>
                            <th class="px-4 text-center">Harga Satuan</th>
                            <th class="px-4 text-center">Jumlah</th>
                            <th class="px-4 text-right">Total Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($notaSales['item_nota'] as $item)
                            <tr class="border-b">
                                <td class="py-3 px-4 text-left">{{ $item['nama_rokok'] }}</td>
                                <td class="py-3 px-4 text-center">Rp {{ number_format($item['harga_satuan'], 0, ',', '.') }}
                                </td>
                                <td class="py-3 px-4 text-center">{{ $item['jumlah_item'] }}</td>
                                <td class="py-3 px-4 text-right">Rp {{ number_format($item['jumlah_harga'], 0, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="3" class="py-3 px-4 text-right font-semibold">Harga Keseluruhan</td>
                            <td class="py-3 px-4 text-right font-semibold">Rp
                                {{ number_format($notaSales['total_harga'], 0, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>

                <!-- Pemberitahuan Pembayaran -->
                <div id="info" class="mb-6 p-4 bg-yellow-50 border-l-4 border-yellow-400">
                    <div class="flex items-center">
                        <i class="fa-solid fa-triangle-exclamation h-6 w-6 text-yellow-600 mr-3"></i>
                        <p class="text-gray-700">
                            Mohon segera melakukan pembayaran sebesar
                            <span class="font-medium">Rp {{ number_format($notaSales['total_harga'], 0, ',', '.') }}</span>
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
                    <form id="upload-form" class="space-y-4" action="{{ route('bayar_nota', $id_nota) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="text-center">
                            <p class="text-gray-600">Silakan unggah bukti transfer Anda dalam format JPEG, JPG, atau PNG
                            </p>
                            <p id="file-error" class="mt-2 text-sm text-red-500" style="display:none;">Gambar yang Anda
                                submit tidak
                                boleh berukuran lebih dari 1 MB</p>
                        </div>
                        <div class="flex justify-center">
                            <label for="gambar"
                                class="w-full max-w-md flex flex-col items-center px-4 py-6 bg-white rounded-md shadow-md tracking-wide uppercase border border-blue-600 cursor-pointer hover:bg-blue-50"
                                id="file-input-label">
                                <i class="fas fa-cloud-upload-alt text-blue-600 text-3xl mb-3"></i>
                                <span id="file-name" class="mt-2 text-base leading-normal text-gray-600">Pilih File</span>
                                <input type="file" accept=".jpg, .jpeg, .png" name="bukti_transfer" id="gambar"
                                    class="hidden">
                            </label>
                        </div>

                        <div class="text-center">
                            <button type="button" id="submit-button"
                                class="bg-green-600 text-white px-5 py-2 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 transition duration-300">
                                <i class="fas fa-save mr-2"></i>Simpan Bukti Pembayaran
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('gambar').addEventListener('change', function() {
            const file = this.files[0];
            const fileName = 'Pilih File'; 
            const fileError = document.getElementById('file-error');
            const fileInputLabel = document.getElementById('file-input-label');

            // Cek jika ukuran file lebih dari 1MB (1048576 bytes)
            if (file && file.size > 1048576) {
                fileError.style.display = 'block'; 
                fileInputLabel.classList.add('border-red-600'); 
                this.value = ''; 
                document.getElementById('file-name').textContent = fileName; 
            } else {
                fileError.style.display = 'none'; 
                fileInputLabel.classList.remove('border-red-600'); 
                document.getElementById('file-name').textContent = file ? file.name :
                fileName; 
            }
        });

        function showUploadSection() {
            document.getElementById('upload-section').classList.remove('hidden');
            document.getElementById('upload-button').classList.add('hidden');
        }

        document.getElementById('submit-button').addEventListener('click', function() {
            const fileInput = document.getElementById('gambar');
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
                    document.getElementById('upload-form').submit();

                    // Menampilkan pesan sukses dengan SweetAlert
                    Swal.fire(
                        'Berhasil!',
                        'Bukti pembayaran telah diunggah.',
                        'success'
                    ).then(() => {
                        document.getElementById('upload-section').classList.add('hidden');
                        document.getElementById('info').classList.add('hidden');
                    });
                }
            });
        });
    </script>
@endsection
