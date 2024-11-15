@extends('pabrik.default')

@section('content')
<section class="container mx-auto p-6 relative my-20">
    <div class="p-6 border rounded-lg bg-white shadow-lg">
        <h2 class="text-2xl font-bold border-b-2 mb-3 pb-3 text-center">Kelola Produk</h2>
        <div class="mb-4 text-right">
            <button type="button"
                class="bg-gray-800 text-white py-2 px-4 rounded-md hover:bg-gray-700 transition duration-300"
                onclick="openAddProductModal()">
                <i class="fa-regular fa-square-plus"></i>
                Tambah Produk
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full border-separate border-spacing-0">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-medium">Foto Produk</th>
                        <th class="px-4 py-2 text-left text-sm font-medium">Nama Produk</th>
                        <th class="px-4 py-2 text-left text-sm font-medium">Jumlah Slop per Karton</th>
                        <th class="px-4 py-2 text-left text-sm font-medium">Harga Jual</th>
                        <th class="px-4 py-2 text-left text-sm font-medium">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white text-sm">
                    @foreach ($rokokPabriks as $index => $rokok)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="px-4 py-2">
                                <img src="{{ asset('storage/produk/' . $gambarRokokList[$index]) }}"
                                    alt="{{ $namaRokokList[$index] }}" class="w-16 h-16 object-cover">
                            </td>
                            <td class="px-4 py-2">{{ $namaRokokList[$index] }}</td>
                            <td class="px-4 py-2">{{ $stokSlopList[$index] }}</td>
                            <td class="px-4 py-2">{{ 'Rp ' . number_format($rokok->harga_karton_pabrik, 0, ',', '.') }}</td>
                            <td class="px-4 py-2 flex space-x-2">
                                <button type="button"
                                    class="inline-flex items-center justify-center w-10 h-10 text-gray-800 bg-gray-200 border border-gray-300 rounded-sm shadow-sm hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500"
                                    onclick="openModal('{{ $namaRokokList[$index] }}', {{ $rokok->harga_karton_pabrik }}, {{ $stokSlopList[$index] }}, {{ $rokok->id_master_barang }},'{{ asset('storage/produk/' . $gambarRokokList[$index]) }}')">
                                    <i class="fa-regular fa-pen-to-square text-lg"></i>
                                </button>

                                <form id="delete-form-{{ $rokok->id_master_barang }}"
                                    action="{{ route('pengaturanHargaPabrik.delete', $rokok->id_master_barang) }}"
                                    method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button"
                                        class="inline-flex items-center justify-center w-10 h-10 text-red-800 bg-red-200 border border-red-300 rounded-sm shadow-sm hover:bg-red-300 focus:outline-none focus:ring-2 focus:ring-red-500"
                                        onclick="deleteProduct('{{ $namaRokokList[$index] }}', {{ $rokok->id_master_barang }})">
                                        <i class="fa-solid fa-trash text-lg"></i>
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Custom Pagination -->
        @if ($rokokPabriks->total() > 10)
            <div class="flex flex-col items-center my-4">
                <span class="text-sm text-gray-700 dark:text-gray-400">
                    Menampilkan <span
                        class="font-semibold text-gray-900 dark:text-white">{{ $rokokPabriks->firstItem() }}</span>
                    sampai
                    <span class="font-semibold text-gray-900 dark:text-white">{{ $rokokPabriks->lastItem() }}</span> dari
                    <span class="font-semibold text-gray-900 dark:text-white">{{ $rokokPabriks->total() }}</span>
                    produk
                </span>
                <div class="inline-flex mt-2 xs:mt-0">
                    <!-- Previous Button -->
                    <button {{ $rokokPabriks->onFirstPage() ? 'disabled' : '' }}
                        class="flex items-center justify-center px-3 h-8 text-sm font-medium text-white bg-gray-800 rounded-s hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                        {{ $rokokPabriks->previousPageUrl() ? 'onclick=window.location.href=\'' . $rokokPabriks->previousPageUrl() . '\'' : '' }}>
                        Sebelumnya
                    </button>
                    <!-- Next Button -->
                    <button {{ !$rokokPabriks->hasMorePages() ? 'disabled' : '' }}
                        class="flex items-center justify-center px-3 h-8 text-sm font-medium text-white bg-gray-800 border-0 border-s border-gray-700 rounded-e hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                        {{ $rokokPabriks->nextPageUrl() ? 'onclick=window.location.href=\'' . $rokokPabriks->nextPageUrl() . '\'' : '' }}>
                        Selanjutnya
                    </button>
                </div>
            </div>
        @endif
    </div>
</section>


<!-- Modal Edit -->
<div id="editModal" style="display: none;"
    class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-sm sm:max-w-md md:max-w-3xl mx-4 relative">
        <h3 class="text-2xl font-semibold mb-4">Edit Produk</h3>
        <!-- Flex diubah menjadi flex-col di layar kecil, dan flex-row di layar lebih besar -->
        <div class="flex flex-col md:flex-row md:space-x-6">
            <!-- Flex untuk membagi menjadi 2 kolom pada layar besar -->
            <!-- Bagian kiri untuk Foto Produk -->
            <div class="w-full md:w-1/2 flex flex-col items-center mb-4 md:mb-0">
                <img id="editProductImage" class="w-64 h-80 object-cover mb-4"
                    src="{{ asset('storage/produk/' . $gambarRokokList[$index] ?? 'default.jpg') }}"
                    alt="{{ $namaRokokList[$index] }}">
            </div>
            <!-- Bagian kanan untuk Form -->
            <div class="w-full md:w-1/2">
                <form id="editForm" method="POST"
                    action="{{ route('pengaturanHargaPabrik.update', ['id' => $rokok->id_master_barang]) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="nama_produk" class="block text-sm font-medium text-gray-700">Nama Produk</label>
                        <input type="text" name="nama_produk" id="nama_produk"
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                    </div>
                    <div class="mb-4">
                        <label for="stok_slop" class="block text-sm font-medium text-gray-700">Jumlah Slop per
                            Karton</label>
                        <input type="number" name="stok_slop" id="stok_slop"
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                    </div>
                    <div class="mb-4">
                        <label for="productPrice" class="block text-sm font-medium text-gray-700">Harga</label>
                        <input type="number" name="harga_karton_pabrik" id="harga_karton_pabrik"
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                    </div>
                    <div class="mb-4">
                        <label for="productImageInput" class="block text-sm font-medium text-gray-700">Foto Produk
                            (Edit)</label>
                        <input type="file" id="productImageInput" name="gambar"
                            class="mt-1 block w-full border border-gray-300 rounded-md" accept="image/*">
                        <span id="file-error-productImageInput" class="text-red-500 text-sm mt-1 hidden">Ukuran file
                            maksimum adalah 1 MB.</span>
                    </div>

                    <div class="flex justify-end space-x-2 mt-4">
                        <button type="submit"
                            class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Simpan</button>
                        <button type="button" class="bg-red-800 text-white px-4 py-2 rounded hover:bg-red-700"
                            onclick="closeModal()">Batal</button>
                    </div>
                </form>
                <button class="absolute top-2 right-2 text-gray-500 hover:text-gray-700" onclick="closeModal()">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Tambah Produk -->
<div id="addProductModal" style="display: none;"
    class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md relative">
        <h3 class="text-2xl font-semibold mb-4">Tambah Produk</h3>
        <form id="addProductForm" method="POST" action="{{ route('pengaturanHargaPabrik.store') }}"
            enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="newProductName" class="block text-sm font-medium text-gray-700">Nama Produk</label>
                <input type="text" id="newProductName" name="nama_produk"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
            </div>
            <div class="mb-4">
                <label for="newProductPrice" class="block text-sm font-medium text-gray-700">Harga Jual</label>
                <input type="number" id="newProductPrice" name="harga_karton_pabrik"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
            </div>
            <div class="mb-4">
                <label for="newProductSlop" class="block text-sm font-medium text-gray-700">Jumlah Slop per
                    Karton</label>
                <input type="number" id="newProductSlop" name="stok_slop"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
            </div>
            <div class="mb-4">
                <label for="newProductImage" class="block text-sm font-medium text-gray-700">Foto Produk
                    (Tambah)</label>
                <input type="file" id="newProductImage" name="gambar"
                    class="mt-1 block w-full border border-gray-300 rounded-md" accept="image/*">
                <span id="file-error-newProductImage" class="text-red-500 text-sm mt-1 hidden">Ukuran file maksimum
                    adalah 1 MB.</span>
            </div>
            <div class="flex justify-end space-x-2 mt-4">
                <button type="submit"
                    class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Simpan</button>
                <button type="button" class="bg-red-800 text-white px-4 py-2 rounded hover:bg-red-700"
                    onclick="closeAddProductModal()">Batal</button>
            </div>
        </form>
        <button class="absolute top-2 right-2 text-gray-500 hover:text-gray-700" onclick="closeAddProductModal()">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
</div>

<script>
    function previewImage(event) {
        const image = document.getElementById('editProductImage');
        const file = event.target.files[0];

        if (file) {
            image.src = URL.createObjectURL(file);
        }
    }

    // Fungsi untuk membuka modal edit produk
    function openModal(nama_produk, harga_karton_pabrik, stok_slop, productId, currentImageUrl) {
        document.getElementById('nama_produk').value = nama_produk;
        document.getElementById('harga_karton_pabrik').value = harga_karton_pabrik;
        document.getElementById('stok_slop').value = stok_slop;

        // Update form action URL untuk menyertakan product ID
        const form = document.getElementById('editForm');
        form.action = `{{ route('pengaturanHargaPabrik.update', '') }}/${productId}`;

        const imageElement = document.getElementById('editProductImage');
        imageElement.src = currentImageUrl; // Gambar yang sudah tersimpan akan muncul

        document.getElementById('editModal').style.display = 'flex'; // Menampilkan modal edit
    }

    // Fungsi untuk menutup modal edit produk
    function closeModal() {
        document.getElementById('editModal').style.display = 'none';
    }

    function openAddProductModal() {
        document.getElementById('addProductModal').style.display = 'flex';
    }

    function closeAddProductModal() {
        document.getElementById('addProductModal').style.display = 'none';
    }

    // Tambahkan event listener untuk form submit produk baru
    document.getElementById('addProductForm').addEventListener('submit', function (event) {
        event.preventDefault(); // Mencegah form reload halaman

        // Ambil data dari form
        const productName = document.getElementById('newProductName').value;
        const productPrice = document.getElementById('newProductPrice').value;
        const productSlop = document.getElementById('newProductSlop').value;
        const productImage = document.getElementById('newProductImage').files[0];

        // Cek apakah semua data telah diisi
        if (!productName || !productPrice || !productSlop || !productImage) {
            alert("Mohon lengkapi semua field.");
            return;
        }

        // Lakukan sesuatu dengan data (bisa gunakan AJAX di sini jika perlu)
        console.log("Nama Produk:", productName);
        console.log("Harga:", productPrice);
        console.log("Isian (slop):", productSlop);
        console.log("Foto Produk:", productImage);

        // Submit form ke server atau gunakan AJAX
        this.submit();

        // Tutup modal setelah submit
        closeAddProductModal();
    });

    // Fungsi untuk menampilkan SweetAlert konfirmasi hapus produk
    function deleteProduct(productName, productId) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: `Anda akan menghapus produk ${productName}`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit form hapus produk
                document.getElementById('delete-form-' + productId).submit();
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        // Ambil kedua input file dengan ID yang sudah ditentukan
        const inputFileEdit = document.getElementById('productImageInput');
        const inputFileTambah = document.getElementById('newProductImage');

        // Fungsi validasi ukuran file
        function validateFile(inputFile, errorId) {
            const file = inputFile.files[0];
            const fileError = document.getElementById(errorId);

            if (file && file.size > 1048576) { // Validasi jika ukuran file lebih dari 1 MB
                fileError.style.display = 'block'; // Tampilkan pesan error
                inputFile.classList.add('border-red-500'); // Beri border merah
                inputFile.value = ''; // Reset input file
            } else {
                fileError.style.display = 'none'; // Sembunyikan pesan error
                inputFile.classList.remove('border-red-500'); // Hapus border merah
            }
        }

        // Event listener untuk input file edit
        if (inputFileEdit) {
            inputFileEdit.addEventListener('change', function () {
                validateFile(inputFileEdit, 'file-error-productImageInput');
            });
        }

        // Event listener untuk input file tambah
        if (inputFileTambah) {
            inputFileTambah.addEventListener('change', function () {
                validateFile(inputFileTambah, 'file-error-newProductImage');
            });
        }
    });



</script>

@endsection