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
            <p class="mb-2 text-gray-700">Nama: <span id="agenName"
                    class="font-semibold">{{ $pesanMasukAgen['nama_sales'] }}</span></p>
            <p class="mb-2 text-gray-700">Tanggal Pemesanan:
                <span id="orderDate" class="font-semibold">{{ $pesanMasukAgen['tanggal'] }}</span>
            </p>
            <button data-modal-target="gambar" data-modal-toggle="gambar"
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
                    @foreach ($pesanMasukAgen['item_nota'] as $item)
                        <tr class="border-b">
                            <td class="p-2">{{ $item['nama_rokok'] }}</td>
                            <td class="p-2 text-center">{{ $item['jumlah_item'] }}</td>
                            <td class="p-2 text-center">Rp {{ number_format($item['harga_satuan'], 0, ',', '.') }}</td>
                            <td class="p-2 text-right">Rp {{ number_format($item['jumlah_harga'], 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="bg-gray-100">
                    <tr>
                        <td colspan="3" class="p-2 text-right font-semibold">Total Harga Keseluruhan:</td>
                        <td class="p-2 text-right font-semibold" id="total-amount">Rp
                            {{ number_format($pesanMasukAgen['total_harga'], 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>

            <!-- Payment Status -->
            <p class="mb-4 text-gray-700">
                Status Pembayaran:
                <span class="font-bold {{ $pesanMasukAgen['gambar'] ? 'text-green-600' : 'text-red-600' }}">
                    {{ $pesanMasukAgen['gambar'] ? 'Lunas' : 'Belum Lunas' }}
                </span>
            </p>
            <p class="mb-4 text-gray-700">Status Pemesanan:
                <span id="orderStatus"
                    class="font-bold {{ $pesanMasukAgen['status'] == 1 ? 'text-green-600' : ($pesanMasukAgen['status'] == 2 ? 'text-red-600' : 'text-orange-600') }}">
                    {{ $pesanMasukAgen['status'] == 1 ? 'Selesai' : ($pesanMasukAgen['status'] == 2 ? 'Ditolak' : 'Diproses') }}
                </span>
            </p>


            <!-- Edit Button (only show when status is 0) -->
            @if ($pesanMasukAgen['status'] == 0)
                <div class="flex justify-end mt-6">
                    <button id="editButton"
                        class="bg-gray-800 text-white px-6 py-3 rounded-lg hover:bg-gray-500 transition-transform duration-200 shadow-lg focus:ring-4 focus:ring-red-400">
                        <i class="fa-solid fa-pencil-alt mr-2"></i>Edit Status Pesanan
                    </button>
                </div>
            @endif
        </div>

        <!-- Edit Section -->
        <div id="editSection" class="p-6 hidden bg-white shadow-lg rounded-lg">
            <!-- Peringatan Saat Edit -->
            <div class="mb-6 p-4 bg-yellow-50 border-l-4 border-yellow-400 rounded-lg flex items-center space-x-3">
                <span><i class="fa-solid fa-exclamation-circle h-5 w-5 text-yellow-600"></i></span>
                <div class="text-gray-800">
                    <p class="text-sm">Pastikan perubahan status pesanan sudah sesuai dengan bukti pembayaran yang diterima.
                        <strong> Perubahan hanya dapat dilakukan satu kali,</strong> pastikan data telah benar sebelum
                        melanjutkan.
                    </p>
                </div>
            </div>


            <!-- Status Pemesanan -->
            <form id="statusForm" action="{{ route('updateStatusPesanan', $pesanMasukAgen['id_order']) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="orderStatusDropdown" class="block text-gray-700 font-medium mb-2">Status Pemesanan</label>
                    <select id="orderStatusDropdown" name="status"
                        class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="0" {{ $pesanMasukAgen['status'] == 0 ? 'selected' : '' }}>Diproses</option>
                        <option value="1" {{ $pesanMasukAgen['status'] == 1 ? 'selected' : '' }}>Selesai</option>
                        <option value="2" {{ $pesanMasukAgen['status'] == 2 ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>
                <div class="flex justify-end mt-6">
                    <button type="submit" id="submitBtn"
                        class="bg-gray-800 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition duration-300 ease-in-out">
                        Simpan
                    </button>
                </div>
            </form>
        </div>

    </div>

    <!-- Modal for Payment Proof -->
    <div id="gambar" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="bg-white rounded-lg shadow-lg p-6 max-w-lg w-full">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-700">Bukti Pembayaran</h3>
                <div class="flex items-center justify-between p-4 border-b border-gray-200">
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center"
                        data-modal-toggle="gambar">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
            </div>

            @if ($pesanMasukAgen['gambar'])
                <img src="{{ asset('storage/' . $pesanMasukAgen['gambar']) }}" alt="Bukti Pembayaran"
                    class="w-full h-auto max-h-96 object-contain">
            @else
                <p class="text-red-500 font-semibold text-center">Sales belum mengupload bukti pembayaran</p>
            @endif
        </div>
    </div>


    <script>
        document.getElementById('editButton').addEventListener('click', function() {
            document.getElementById('orderDetails').classList.add('hidden');
            document.getElementById('editSection').classList.remove('hidden');
            document.getElementById('pageTitle').textContent = "Edit Status Pesanan";
        });

        document.querySelectorAll('[data-modal-target]').forEach(button => {
            button.addEventListener('click', () => {
                const modalId = button.getAttribute('data-modal-target');
                document.querySelector(modalId).classList.remove('hidden');
            });
        });
        document.querySelectorAll('[data-modal-hide]').forEach(button => {
            button.addEventListener('click', () => {
                const modalId = button.getAttribute('data-modal-hide');
                document.querySelector(modalId).classList.add('hidden');
            });
        });

        document.getElementById('submitBtn').addEventListener('click', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda tidak dapat mengubah status kembali setelah disimpan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, simpan perubahan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('statusForm').submit();
                }
            });
        });
    </script>
@endsection
