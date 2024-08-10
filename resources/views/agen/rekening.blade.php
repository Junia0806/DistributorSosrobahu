@extends('sales.default')

@section('content')
    <section class="container mx-auto p-6 relative">
        <section class="p-6 border rounded-lg bg-white shadow-lg">
            <h2 class="text-2xl font-bold mb-2 text-center">Rekening Bank</h2>
            <hr class="border-gray-300 mb-6">

            <!-- Himbauan Pembayaran -->
            <div class="mb-6 p-4 bg-yellow-100 border border-yellow-400 rounded-lg flex items-center space-x-2">
                <span><i class="fa-solid fa-triangle-exclamation h-6 w-6 text-yellow-600"></i></span>
                <p class="text-gray-700">Harap memasukkan nomor rekening yang sesuai dan benar.</p>
            </div>

            <!-- Form Rekening Bank -->
            <form>
                <!-- Nama Bank -->
                <div class="mb-4">
                    <label for="bank_name" class="block text-gray-700 font-medium mb-2">Nama Bank</label>
                    <select id="bank_name" name="bank_name" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Pilih Nama Bank</option>
                        <option value="bank_a">Bank A</option>
                        <option value="bank_b">Bank B</option>
                        <option value="bank_c">Bank C</option>
                    </select>
                </div>

                <!-- Nomor Rekening -->
                <div class="mb-4">
                    <label for="account_number" class="block text-gray-700 font-medium mb-2">Nomor Rekening</label>
                    <input type="text" id="account_number" name="account_number" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan Nomor Rekening">
                </div>

                <!-- Atas Nama -->
                <div class="mb-6">
                    <label for="account_holder" class="block text-gray-700 font-medium mb-2">Atas Nama</label>
                    <input type="text" id="account_holder" name="account_holder" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan Nama Pemilik Rekening">
                </div>

                <!-- Tombol Simpan -->
                <div class="text-right">
                    <button id="order-button" type="submit" class="bg-gray-800 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition duration-300 ease-in-out">Simpan</button>
                </div>
            </form>
        </section>
    </section>
@endsection
