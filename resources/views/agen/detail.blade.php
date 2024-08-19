@extends('agen.default')

@section('content')
<div class="w-full max-w-6xl mx-auto bg-white rounded-lg shadow-lg overflow-x-auto my-20 text-md">
    <div id="headerTitle" class="flex justify-center items-center p-6 border-b">
        <h1 id="pageTitle" class="text-2xl font-bold text-center">Detail Pesanan</h1>
    </div>

    <div id="orderDetails" class="p-6">
        <p class="mb-2">Nama: <span id="agenName">{{ $namaAgen }}</span></p>
        <p class="mb-4">Tanggal Pemesanan: <span id="orderDate">{{ $orderDate }}</span></p>

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

        <p class="mb-4">Status Pembayaran: <span id="paymentStatus" class="font-bold">Lunas</span></p>
        <p class="mb-4">Status Pemesanan: <span id="orderStatus" class="font-bold">Diproses</span></p>

        <div class="flex items-center mb-4">
            <p class="mr-2">Lihat Bukti Pembayaran:</p>
            <button id="viewProofButton" class="bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-700">Lihat Bukti</button>
        </div>

        <div class="flex justify-center mt-6">
            <button id="editButton" class="bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-700">Edit</button>
        </div>
    </div>

    <!-- Edit Section -->
    <div id="editSection" class="p-6 hidden">
        <div class="mb-4">
            <label for="paymentStatusDropdown" class="block text-gray-700">Status Pembayaran</label>
            <select id="paymentStatusDropdown" class="w-full p-2 border border-gray-300 rounded">
                <option value="Lunas">Lunas</option>
                <option value="Belum Lunas">Belum Lunas</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="orderStatusDropdown" class="block text-gray-700">Status Pemesanan</label>
            <select id="orderStatusDropdown" class="w-full p-2 border border-gray-300 rounded">
                <option value="Diproses">Diproses</option>
                <option value="Selesai">Selesai</option>
                <option value="Ditolak">Ditolak</option>
            </select>
        </div>
        <div class="flex justify-center mt-6">
            <button id="saveButton" class="bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-700">Simpan</button>
        </div>
    </div>
</div>

<!-- Modal for Payment Proof -->
<div id="proofModal" class="fixed inset-0 hidden z-50 flex items-center justify-center bg-gray-900 bg-opacity-50">
    <div class="bg-white rounded-lg shadow p-4 max-w-lg w-full">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold">Bukti Pembayaran</h3>
            <button id="closeProofModal" class="text-gray-500 hover:text-gray-800">&times;</button>
        </div>
        <img src="https://i.pinimg.com/564x/26/4f/b6/264fb615836d96ae003543c18fa8454b.jpg" alt="Bukti Pembayaran" class="w-full h-auto max-h-96 object-contain">
    </div>
</div>


    <script>
        document.getElementById('editButton').addEventListener('click', function () {
            document.getElementById('orderDetails').classList.add('hidden');
            document.getElementById('editSection').classList.remove('hidden');
            document.getElementById('pageTitle').textContent = "Edit Detail Pesanan";
        });

        document.getElementById('saveButton').addEventListener('click', function () {
            document.getElementById('orderDetails').classList.remove('hidden');
            document.getElementById('editSection').classList.add('hidden');
            document.getElementById('pageTitle').textContent = "Detail Pesanan";
        });

        document.getElementById('viewProofButton').addEventListener('click', function () {
            document.getElementById('proofModal').classList.remove('hidden');
        });

        document.getElementById('closeProofModal').addEventListener('click', function () {
            document.getElementById('proofModal').classList.add('hidden');
        });
    </script>
@endsection
