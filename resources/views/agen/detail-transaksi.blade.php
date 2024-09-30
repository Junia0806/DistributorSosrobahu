@extends('agen.default')

@section('content')
    <div class="w-full max-w-6xl mx-auto bg-white rounded-lg shadow-lg overflow-x-auto my-20 text-md">
        <!-- Header Section -->
        <div id="headerTitle" class="flex justify-center items-center p-4 rounded-t-lg">
            <h1 id="pageTitle" class="text-2xl font-extrabold text-black text-center">Detail Pesanan</h1>
        </div>
        <hr class="border-gray-300 mb-0">
        <!-- Order Details -->
        <div id="orderDetails" class="p-6">
            <p class="mb-2 text-gray-700">Nama Sales: <span id="agenName" class="font-semibold">{{ $namaAgen }}</span></p>
            <p class="mb-2 text-gray-700">Tanggal Pemesanan: <span id="orderDate"
                    class="font-semibold">{{ $orderDate }}</span></p>
            <button id="viewProofButton"
                class="bg-green-600 text-sm text-white py-2 px-3 rounded hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 mb-4">Lihat
                Bukti Pembayaran <i class="fa-regular fa-hand-pointer ml-2"></i></button>
            <!-- Order Table -->
            <table class="w-full mb-4">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="p-2 text-left">Nama Produk</th>
                        <th class="p-2 text-center">Jumlah</th>
                        <th class="p-2 text-center">Harga per Slop</th>
                        <th class="p-2 text-right">Total Harga</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b">
                        <td class="p-2">Sosrobahu Kopi Hitam</td>
                        <td class="p-2 text-center">5</td>
                        <td class="p-2 text-center">14.000</td>
                        <td class="p-2 text-right">70.000</td>
                    </tr>
                    <tr class="border-b">
                        <td class="p-2">Sosrobahu Premium</td>
                        <td class="p-2 text-center">4</td>
                        <td class="p-2 text-center">16.000</td>
                        <td class="p-2 text-right">64.000</td>
                    </tr>
                </tbody>
                <tfoot class="bg-gray-100">
                    <tr>
                        <td colspan="3" class="p-2 text-right font-semibold">Total Harga Keseluruhan:</td>
                        <td class="p-2 text-right font-semibold">134.000</td>
                    </tr>
                </tfoot>
            </table>

            <!-- Payment Status -->
            <p class="mb-4 text-gray-700">Status Pembayaran: <span id="paymentStatus"
                    class="font-bold text-green-600">Terbayar</span></p>
            <p class="mb-4 text-gray-700">Status Pemesanan: <span id="orderStatus"
                    class="font-bold text-orange-600">Diproses</span></p>

            <!-- Edit Button -->
            <div class="flex justify-end mt-6">
                <button id="editButton"
                    class="bg-gray-800 text-white px-6 py-3 rounded-lg hover:bg-gray-500  transition-transform duration-200 shadow-lg focus:ring-4 focus:ring-red-400">
                    <i class="fa-solid fa-pencil-alt mr-2"></i>Edit Status Pesanan
                </button>
            </div>

        </div>

        <!-- Edit Section -->
        <div id="editSection" class="p-6 hidden bg-white shadow-lg rounded-lg">
            <!-- Peringatan Saat Edit -->
            <div class="mb-6 p-4 bg-yellow-100 border border-yellow-400 rounded-lg flex items-center space-x-2">
                <span><i class="fa-solid fa-exclamation-triangle h-4 w-4 text-yellow-600"></i></span>
                <p class="text-gray-700">Pastikan perubahan status pesanan telah sesuai dengan bukti pembayaran yang
                    diterima.</p>
            </div>

            <!-- Status Pemesanan -->
            <div class="mb-4">
                <label for="orderStatusDropdown" class="block text-gray-700 font-medium mb-2">Status Pemesanan</label>
                <select id="orderStatusDropdown"
                    class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="Diproses">Diproses</option>
                    <option value="Selesai">Selesai</option>
                    <option value="Ditolak">Ditolak</option>
                </select>
            </div>

            <!-- Tombol Simpan -->
            <div class="flex justify-end mt-6">
                <button id="saveButton"
                    class="bg-gray-800 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition duration-300 ease-in-out">
                    Simpan
                </button>
            </div>
        </div>

    </div>

    <!-- Modal for Payment Proof -->
    <div id="proofModal" class="fixed inset-0 hidden z-50 items-center justify-center bg-gray-900 bg-opacity-50">
        <div class="bg-white rounded-lg shadow-lg p-6 max-w-lg w-full">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-700">Bukti Pembayaran</h3>
                <button id="closeProofModal" class="text-gray-500 hover:text-gray-800" style="font-size: 24px;">&times;</button>
            </div>
            <img src="https://i.pinimg.com/564x/26/4f/b6/264fb615836d96ae003543c18fa8454b.jpg" alt="Bukti Pembayaran"
                class="w-full h-auto max-h-96 object-contain">
        </div>
    </div>

    <script>
        document.getElementById('editButton').addEventListener('click', function() {
            document.getElementById('orderDetails').classList.add('hidden');
            document.getElementById('editSection').classList.remove('hidden');
            document.getElementById('pageTitle').textContent = "Edit Status Pesanan";
        });

        document.getElementById('saveButton').addEventListener('click', function() {
            document.getElementById('orderDetails').classList.remove('hidden');
            document.getElementById('editSection').classList.add('hidden');
            document.getElementById('pageTitle').textContent = "Detail Pesanan";
        });

        document.getElementById('viewProofButton').addEventListener('click', function () {
            document.getElementById('proofModal').style.display = 'flex';
        });

        document.getElementById('closeProofModal').addEventListener('click', function () {
            document.getElementById('proofModal').style.display = 'none';
        });
    </script>
@endsection
