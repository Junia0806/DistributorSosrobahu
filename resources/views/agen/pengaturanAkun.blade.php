@extends('agen.default')

@section('content')
    <div class="w-full max-w-6xl mx-auto bg-white rounded-lg shadow-lg overflow-x-auto my-20">
        <div class="flex items-center justify-between p-6 border-b">
            <div class="flex-1 text-center">
                <h1 class="text-2xl font-bold text-black">Daftar Sales</h1>
            </div>
            <button data-modal-target="tambah-modal" data-modal-toggle="tambah-modal"
                class="bg-gray-800 text-white py-2 px-4 rounded-md hover:bg-gray-700 transition duration-300" type="button">
                <i class="fa-regular fa-square-plus"></i> Akun Sales
            </button>
        </div>

        <div class="overflow-x-auto">
            <div class="my-4 flex justify-center">
                <form action="{{ route('pengaturanSales') }}" method="GET" class="flex w-full max-w-xl">
                    <input type="text" name="search" id="searchInput" placeholder="Cari Berdasarkan Nama atau Username"
                        class="border border-gray-300 p-2 rounded-lg mx-2 w-full pl-10 placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 ease-in-out"
                        value="{{ request()->query('search') }}">
                    <button type="submit"
                        class="bg-blue-500 text-white p-2 rounded-lg hover:bg-blue-600 transition duration-200 ease-in-out">
                        Cari
                    </button>
                </form>
            </div>



            <table class="w-full border-separate border-spacing-0 text-sm text-black">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="p-2 text-center">No</th>
                        <th class="p-2 text-center">Nama Lengkap</th>
                        <th class="p-2 text-center">Username</th>
                        <th class="p-2 text-center">Status</th>
                        <th class="p-2 text-center">No Telpon</th>
                        <th class="p-2 text-center">KTP</th>
                        <th class="p-2 text-center">Penjualan</th>
                        <th class="p-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white text-center" id="tableBody">
                    @php
                        $startIndex = $akunSales->perPage() * ($akunSales->currentPage() - 1) + 1;
                    @endphp
                    @if ($akunSales->isEmpty())
                        <tr>
                            <td colspan="8" class="p-2">
                                <p class="text-center text-red-500">Nama maupun username sales yang anda cari tidak ada.</p>
                            </td>
                        </tr>
                    @else
                        @foreach ($akunSales as $index => $akunSale)
                            <tr class="border-b border-gray-200">
                                <td class="p-2">{{ $startIndex + $index }}</td>
                                <td class="p-2">{{ $akunSale['nama_lengkap'] }}</td>
                                <td class="p-2">{{ $akunSale['username'] }}</td>
                                <td class="p-2">{{ $akunSale['status'] == 1 ? 'Aktif' : 'Tidak Aktif' }}</td>
                                <td class="p-2">{{ $akunSale['no_telp'] }}</td>
                                <td class="p-2">
                                    <button type="button" data-modal-target="ktp-modal-{{ $akunSale['id_user_sales'] }}"
                                        data-modal-toggle="ktp-modal-{{ $akunSale['id_user_sales'] }}"
                                        class="bg-green-600 text-white font-bold py-1 px-3 rounded hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 text-xs">Lihat</button>
                                </td>
                                <td class="p-2 font-semibold">
                                    Rp.{{ number_format($totalPricePerSales[$akunSale['id_user_sales']] ?? 0, 0, ',', '.') }}
                                </td>
                                <td class="p-2">
                                    <div class="flex justify-center space-x-2">
                                        <button type="button"
                                            data-modal-target="edit-akun-modal-{{ $akunSale->id_user_sales }}"
                                            data-modal-toggle="edit-akun-modal-{{ $akunSale->id_user_sales }}"
                                            class="inline-flex items-center justify-center w-10 h-10 text-gray-800 bg-gray-200 border border-gray-300 rounded-sm shadow-sm hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500">
                                            <i class="fa-regular fa-pen-to-square text-lg"></i>
                                        </button>
                                        <form id="delete-form-{{ $akunSale->id_user_sales }}"
                                            action="{{ route('pengaturanSales.delete', $akunSale->id_user_sales) }}"
                                            method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"
                                                class="inline-flex items-center justify-center w-10 h-10 text-white bg-red-700 border border-red-600 rounded shadow-sm hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 ml-1"
                                                onclick="confirmDelete('{{ $akunSale->id_user_sales }}', '{{ $akunSale->nama_lengkap }}')">
                                                <i class="fa-regular fa-trash-can text-base"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            <!-- Modal Lihat KTP -->
                            <div id="ktp-modal-{{ $akunSale['id_user_sales'] }}" tabindex="-1" aria-hidden="true"
                                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-md max-h-full">
                                    <div class="relative bg-white rounded-lg shadow">
                                        <div class="flex items-center justify-between p-4 border-b border-gray-600">
                                            <h3 class="text-lg font-semibold text-black">KTP
                                                {{ $akunSale['nama_lengkap'] }}
                                            </h3>
                                            <button type="button"
                                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center"
                                                data-modal-toggle="ktp-modal-{{ $akunSale['id_user_sales'] }}">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <div class="p-4">
                                            <img src="{{ asset('storage/ktp/' . $akunSale['gambar_ktp']) }}"
                                                alt="KTP {{ $akunSale['nama_lengkap'] }}" class="w-full rounded-lg">
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <!-- Modal Edit Akun -->
                            <div id="edit-akun-modal-{{ $akunSale['id_user_sales'] }}" tabindex="-1" aria-hidden="true"
                                class="hidden fixed top-0 left-0 right-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto h-modal">
                                <div class="relative w-full max-w-full md:max-w-md h-full max-h-full md:h-auto">
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <div class="flex items-center justify-between p-4 border-b border-gray-200">
                                            <h3 class="text-xl font-semibold text-gray-700">Edit Akun {{ $akunSale->username }}</h3>
                                            <button type="button"
                                                class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:text-gray-500 dark:hover:bg-gray-600 dark:hover:text-white"
                                                data-modal-hide="edit-akun-modal-{{ $akunSale->id_user_sales }}">
                                                <svg aria-hidden="true" class="w-5 h-5" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <div class="p-6 ">

                                            <form action="{{ route('pengaturanSales.update', $akunSale->id_user_sales) }}"
                                                id="edit-akun-form" method="POST" enctype="multipart/form-data"
                                                class="space-y-4">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="page"
                                                    value="{{ request()->input('page', 1) }}">

                                                <div class="grid grid-cols-2 gap-2">
                                                    <div>
                                                        <label for="edit-name"
                                                            class="block mb-2 text-sm font-semibold text-gray-600">Nama</label>
                                                        <input type="text" value="{{ $akunSale->nama_lengkap }}"
                                                            name="nama_lengkap" id="nama_lengkap"
                                                            class="mb-4 bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                                            required>
                                                    </div>
                                                    <div>
                                                        <label for="edit-username"
                                                            class="block mb-2 text-sm font-semibold text-gray-600">Username</label>
                                                        <input type="text" value="{{ $akunSale->username }}"
                                                            name="username" id="username"
                                                            class="mb-4 bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="grid grid-cols-2 gap-4">
                                                <div class="relative">
                                                    <label for="password-edit" class="block mb-2 text-sm font-semibold text-gray-600">Password Baru</label>
                                                    <input type="password" id="password-edit" name="password" placeholder="Password Baru Anda"
                                                     class="w-full mb-4 py-1.5 px-3 text-sm bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out">
                                                    <span id="togglePasswordEdit"
                                                        class="text-gray-500 absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer"
                                                        onclick="togglePassword('password-edit', 'togglePasswordEdit')">
                                                        <i class="fa-solid fa-eye-slash"></i>
                                                    </span>
                                                </div>
                                                    <div>
                                                        <label for="edit-phone"
                                                            class="block mb-2 text-sm  font-semibold text-gray-600">No.
                                                            Telepon</label>
                                                        <input type="tel" value="{{ $akunSale->no_telp }}"
                                                            name="no_telp" id="no_telp"
                                                            class="mb-4 bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="grid grid-cols-2 gap-4">
                                                    <div class="text-left">
                                                        <label for="edit-status"
                                                            class="block mb-2 text-sm  font-semibold text-gray-600">Status</label>
                                                        <select name="status" id="edit-status"
                                                            class="mb-4 bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                                            <option value="1"
                                                                {{ $akunSale->status == 1 ? 'selected' : '' }}>
                                                                Aktif
                                                            </option>
                                                            <option value="0"
                                                                {{ $akunSale->status == 0 ? 'selected' : '' }}>
                                                                Tidak Aktif</option>
                                                        </select>
                                                    </div>
                                                    <div class="text-left">
                                                        <label for="edit-avatar"
                                                            class="block mb-2 text-sm  font-semibold text-gray-600">KTP</label>
                                                        <input
                                                            class="block mb-2 w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50"
                                                            aria-describedby="edit-avatar_help" name="gambar_ktp"
                                                            id="gambar_ktp-{{ $akunSale['id_user_sales'] }}"
                                                            type="file" accept=".jpg, .jpeg, .png" />
                                                        <p id="sizeWarning-{{ $akunSale['id_user_sales'] }}"
                                                            class="text-red-600 mt-1 hidden text-sm">Foto KTP tidak boleh
                                                            melebihi 1 MB
                                                        </p>
                                                        <p id="ktp-file-name-{{ $akunSale['id_user_sales'] }}"
                                                            class="text-sm text-gray-500">
                                                            File saat ini:
                                                            {{ $akunSale['gambar_ktp'] ? $akunSale['gambar_ktp'] : 'Tidak ada file saat ini.' }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-span-2 text-center">
                                                    <button type="submit"
                                                        class="inline-flex items-center bg-green-800 text-white py-2 px-4 rounded-md hover:bg-green-700 transition duration-300 mt-3">
                                                        Simpan Perubahan
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                </tbody>
                @endif
            </table>
        </div>
    </div>

    <div id="tambah-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-6 w-full max-w-lg max-h-full">
            <div class="relative bg-white rounded-lg shadow-lg ring-1 ring-gray-200">
                <div class="flex items-center justify-between p-4 border-b border-gray-200">
                    <h3 class="text-xl font-semibold text-gray-700">Tambah Akun</h3>
                    <button type="button"
                        class="text-gray-400 hover:bg-gray-100 rounded-lg p-1.5 inline-flex justify-center items-center"
                        data-modal-toggle="tambah-modal">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <form action="{{ route('pengaturanSales.input') }}" method="POST" enctype="multipart/form-data"
                    class="p-4 space-y-1">
                    @csrf
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <label for="nama_lengkap" class="block mb-1 text-sm font-semibold text-gray-600">Nama
                                Lengkap</label>
                            <input type="text" name="nama_lengkap" id="nama_lengkap" placeholder="Nama lengkap"
                                class="w-full bg-gray-50 border border-gray-300 text-gray-800 text-sm rounded-lg py-1.5 px-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out"
                                required>
                        </div>
                        <div>
                            <label for="username" class="block mb-1 text-sm font-semibold text-gray-600">Username</label>
                            <input type="text" name="username" id="username" placeholder="Username"
                                class="w-full bg-gray-50 border border-gray-300 text-gray-800 text-sm rounded-lg py-1.5 px-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out"
                                required>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                    <div class="relative">
                        <label for="password-add" class="block mb-1 text-sm font-semibold text-gray-600">Password</label>
                        <input type="password" id="password-add" name="password" placeholder="Password"
                            class="w-full py-1.5 px-3 text-sm bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out"
                             required />
                        <span id="togglePasswordAdd"
                            class="text-gray-500 absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer"
                            onclick="togglePassword('password-add', 'togglePasswordAdd')">
                            <i class="fa-solid fa-eye-slash mt-6"></i>
                        </span>
                    </div>
                        <div>
                            <label for="no_telp" class="block mb-1 text-sm font-semibold text-gray-600">No.
                                Telepon</label>
                            <input type="tel" name="no_telp" id="no_telp" placeholder="08xxxxxxxxxx"
                                class="w-full bg-gray-50 border border-gray-300 text-gray-800 text-sm rounded-lg py-1.5 px-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out"
                                required>
                        </div>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-gray-600" for="gambar_ktp">Foto KTP</label>
                        <input
                            class="block w-full mb-2 text-xs text-gray-600 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            type="file" id="gambar_ktp" name="gambar_ktp" accept=".jpg, .jpeg, .png" required>
                        <p id="sizeWarning" class="text-red-600 hidden text-xs">Foto KTP tidak boleh melebihi 1
                            MB</p>
                    </div>
                    <div class="flex justify-center">
                        <button type="submit"
                            class="bg-green-600 text-white py-1.5 px-6 rounded-lg shadow-md hover:bg-blue-500 transition duration-200 ease-in-out focus:ring-2 focus:ring-blue-600 focus:outline-none">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Custom Pagination -->
    @if ($akunSales->total() > 10)
        <div class="flex flex-col items-center my-6">
            <!-- Help text -->
            <span class="text-sm text-gray-700 dark:text-gray-400">
                Menampilkan <span class="font-semibold text-gray-900 dark:text-white">{{ $akunSales->firstItem() }}</span>
                sampai
                <span class="font-semibold text-gray-900 dark:text-white">{{ $akunSales->lastItem() }}</span> dari
                <span class="font-semibold text-gray-900 dark:text-white">{{ $akunSales->total() }}</span> sales
            </span>
            <!-- Buttons -->
            <div class="inline-flex mt-2 xs:mt-0">
                <!-- Previous Button -->
                <button {{ $akunSales->onFirstPage() ? 'disabled' : '' }}
                    class="flex items-center justify-center px-3 h-8 text-sm font-medium text-white bg-gray-800 rounded-s hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                    {{ $akunSales->previousPageUrl() ? 'onclick=window.location.href=\'' . $akunSales->previousPageUrl() . '\'' : '' }}>
                    Sebelumnya
                </button>
                <!-- Next Button -->
                <button {{ !$akunSales->hasMorePages() ? 'disabled' : '' }}
                    class="flex items-center justify-center px-3 h-8 text-sm font-medium text-white bg-gray-800 border-0 border-s border-gray-700 rounded-e hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                    {{ $akunSales->nextPageUrl() ? 'onclick=window.location.href=\'' . $akunSales->nextPageUrl() . '\'' : '' }}>
                    Selanjutnya
                </button>
            </div>
        </div>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Validasi foto KTP tidak boleh lebih dari 1 mb
        document.getElementById('gambar_ktp').addEventListener('change', function() {
            const file = this.files[0];
            const maxSize = 1 * 1024 * 1024;
            const warningText = document.getElementById('sizeWarning');

            if (file.size > maxSize) {
                warningText.classList.remove('hidden');
                this.value = '';
            } else {
                warningText.classList.add('hidden');
            }
        });
        // Seleksi semua input file yang ID-nya dimulai dengan "gambar_ktp-"
        document.querySelectorAll("input[id^='gambar_ktp-']").forEach(function(fileInput) {
            const userId = fileInput.id.split('-')[1]; // Mendapatkan ID pengguna dari ID input
            const warningText = document.getElementById(`sizeWarning-${userId}`);

            // Tambahkan event listener untuk setiap input file
            fileInput.addEventListener('change', function() {
                const file = this.files[0];
                const maxSize = 1 * 1024 * 1024; // 1 MB

                if (file && file.size > maxSize) {
                    warningText.classList.remove('hidden'); // Tampilkan peringatan
                    this.value = ''; // Kosongkan input file
                } else {
                    warningText.classList.add('hidden'); // Sembunyikan peringatan jika ukuran sesuai
                }
            });
        });
        // Mengosongkan input pencarian dan menghapus query string saat halaman dimuat
        document.addEventListener("DOMContentLoaded", function() {
            const searchInput = document.getElementById("searchInput");
            if (performance.navigation.type === 1) {
                const url = new URL(window.location);
                url.search = '';
                window.history.replaceState({}, document.title, url);
            }
        });
        // Event listener untuk membuka modal
        document.querySelectorAll('[data-modal-target]').forEach(button => {
            button.addEventListener('click', () => {
                const modalId = button.getAttribute('data-modal-target');
                document.querySelector(modalId).classList.remove('hidden');
            });
        });

        function togglePassword(inputId, toggleId) {
            const passwordInput = document.getElementById(inputId);
            const toggleIcon = document.getElementById(toggleId).querySelector('i');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            }
        }

        // Event listener untuk menutup modal
        document.querySelectorAll('[data-modal-hide]').forEach(button => {
            button.addEventListener('click', () => {
                const modalId = button.getAttribute('data-modal-hide');
                document.querySelector(modalId).classList.add('hidden');
            });
        });

        // Event listener untuk menampilkan peringatan jika ada error username
        document.addEventListener('DOMContentLoaded', function() {
            @if ($errors->has('username'))
                Swal.fire({
                    title: 'Peringatan!',
                    text: 'Username sudah digunakan, pilih username yang lain.',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                });
            @endif
        });

        // Fungsi untuk konfirmasi penghapusan akun
        function confirmDelete(id, namaUser) {
            Swal.fire({
                title: 'Anda yakin?',
                text: `Anda akan menghapus akun ${namaUser} ini.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>
@endsection
