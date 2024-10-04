@extends('pabrik.default')

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
                        Berikut adalah informasi rekening Official CV. Santoso Jaya Tembakau. Semua transaksi dari
                        Distributor akan menggunakan nomor rekening ini.
                    </p>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Nama Bank</label>
                    <p class="text-gray-800">Bank Mandiri</p>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Nomor Rekening</label>
                    <p class="text-gray-800">1234567890</p>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Atas Nama</label>
                    <p class="text-gray-800">Moch. Samsul Abidin</p>
                </div>
                <div class="text-right">
                    <button id="edit-button" type="button"
                        class="bg-gray-800 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition duration-300 ease-in-out">Edit</button>
                </div>
            </div>

            <!-- Form Rekening Bank -->
            <form id="account-form" class="hidden">
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
                        <option value="bank_a">Bank Mandiri</option>
                        <option value="bank_b">Bank BCA</option>
                        <option value="bank_c">Bank BNI</option>
                    </select>
                </div>

                <!-- Nomor Rekening -->
                <div class="mb-4">
                    <label for="account_number" class="block text-gray-700 font-medium mb-2">Nomor Rekening</label>
                    <input type="text" id="account_number" name="account_number"
                        class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Masukkan Nomor Rekening">
                </div>

                <!-- Atas Nama -->
                <div class="mb-6">
                    <label for="account_holder" class="block text-gray-700 font-medium mb-2">Atas Nama</label>
                    <input type="text" id="account_holder" name="account_holder"
                        class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Masukkan Nama Pemilik Rekening">
                </div>

                <!-- Tombol Simpan -->
                <div class="text-right">
                    <button id="save-button" type="submit"
                        class="bg-gray-800 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition duration-300 ease-in-out">Simpan</button>
                </div>
            </form>
        </section>
    </section>

    <script>
        document.getElementById('edit-button').addEventListener('click', function() {
            document.getElementById('account-info').classList.add('hidden');
            document.getElementById('account-form').classList.remove('hidden');
        });
    </script>
@endsection
