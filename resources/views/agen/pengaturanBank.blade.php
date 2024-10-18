@extends('agen.default')

@section('content')
    <section class="container mx-auto p-6 relative my-20">
        <section class="p-6 border rounded-lg bg-white shadow-lg">
            <h2 class="text-2xl font-bold mb-2 text-center">Rekening Bank</h2>
            <hr class="border-gray-300 mb-6">

            <!-- Informasi Rekening dan Tombol Edit -->
            <div id="account-info" class="mb-6">
                <!-- Peringatan Informasi Rekening -->
                <div class="mb-6 p-4 bg-blue-100 border border-blue-400 rounded-lg flex items-center space-x-2">
                    <span><i class="fa-solid fa-info-circle h-6 w-6 text-blue-600"></i></span>
                    <p class="text-gray-700">
                        Berikut adalah informasi rekening Anda sebagai Agen Rokok Sosrobahu. Semua transaksi dari Sales akan menggunakan nomor rekening ini.
                    </p>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Nama Bank</label>
                    <p class="text-gray-800">{{ $userAgen['nama_bank'] }}</p>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Nomor Rekening</label>
                    <p class="text-gray-800">{{ $userAgen['no_rek'] }}</p>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Atas Nama</label>
                    <p class="text-gray-800">{{ $userAgen['nama_agen'] }}</p>
                </div>
                <div class="text-right">
                    <button id="edit-button" type="button"
                        class="bg-gray-800 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition duration-300 ease-in-out">Edit</button>
                </div>
            </div>

            <!-- Form Rekening Bank -->
            <form action="{{ route('rekeningBank.update') }}" id="account-form" class="hidden" method="POST">
                @csrf
                @method('PUT')

                <!-- Peringatan Saat Edit -->
                <div class="mb-6 p-4 bg-yellow-100 border border-yellow-400 rounded-lg flex items-center space-x-2">
                    <span><i class="fa-solid fa-exclamation-triangle h-6 w-6 text-yellow-600"></i></span>
                    <p class="text-gray-700">Pastikan semua data yang Anda masukkan akurat.</p>
                </div>

                <!-- Nama Bank -->
                <div class="mb-4">
                    <label for="bank_name" class="block text-gray-700 font-medium mb-2">Nama Bank</label>
                    <select id="bank_name" name="bank_name"
                        class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="Bank Mandiri" {{ $userAgen['nama_bank'] == 'Bank Mandiri' ? 'selected' : '' }}>Bank Mandiri</option>
                        <option value="Bank BCA" {{ $userAgen['nama_bank'] == 'Bank BCA' ? 'selected' : '' }}>Bank BCA</option>
                        <option value="Bank BNI" {{ $userAgen['nama_bank'] == 'Bank BNI' ? 'selected' : '' }}>Bank BNI</option>
                    </select>
                </div>

                <!-- Nomor Rekening -->
                <div class="mb-4">
                    <label for="account_number" class="block text-gray-700 font-medium mb-2">Nomor Rekening</label>
                    <input type="text" id="account_number" name="account_number"
                        class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Masukkan Nomor Rekening" value="{{ $userAgen['no_rek'] }}" required>
                    <!-- Tempat Pesan Error -->
                    <p id="account_number_error" class="text-red-600 text-sm mt-1 hidden">Nomor rekening tidak boleh mengandung spasi, huruf, atau tanda baca.</p>
                </div>

                <!-- Atas Nama -->
                <div class="mb-6">
                    <label for="account_holder" class="block text-gray-700 font-medium mb-2">Atas Nama</label>
                    <input type="text" id="account_holder" name="account_holder"
                        class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Masukkan Nama Pemilik Rekening" value="{{ $userAgen['nama_agen'] }}" required>
                </div>

                <!-- Tombol Simpan -->
                <div class="text-right">
                    <button id="save-button" type="submit"
                        class="bg-gray-800 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition duration-300 ease-in-out">Simpan</button>
                </div>
            </form>
        </section>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('edit-button').addEventListener('click', function () {
            document.getElementById('account-info').classList.add('hidden');
            document.getElementById('account-form').classList.remove('hidden');
        });

        document.getElementById('account-form').addEventListener('submit', function (e) {
            var accountNumber = document.getElementById('account_number').value;
            var regex = /^[0-9]+$/;  // Hanya mengizinkan angka tanpa spasi, huruf, atau tanda baca

            if (!regex.test(accountNumber)) {
                e.preventDefault(); // Mencegah form disubmit
                // Menampilkan pesan error
                document.getElementById('account_number_error').classList.remove('hidden');

                // SweetAlert Peringatan
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Nomor rekening tidak boleh mengandung spasi, huruf, atau tanda baca!',
                });
            } else {
                document.getElementById('account_number_error').classList.add('hidden');
                // SweetAlert Konfirmasi
                e.preventDefault(); // Mencegah form dikirim langsung

                Swal.fire({
                    title: 'Konfirmasi',
                    text: 'Apakah Anda yakin ingin mengubah nomor rekening?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, ubah',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Jika dikonfirmasi, submit form
                        document.getElementById('account-form').submit();
                    }
                });
            }
        });
    </script>
@endsection