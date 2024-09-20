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

        <!-- Tabel Toko -->
        <div class="overflow-x-auto">
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
                <tbody class="bg-white text-center">
                    @php
                        // Menghitung nomor urut awal untuk halaman saat ini
                        $startIndex = $akunSales->perPage() * ($akunSales->currentPage() - 1) + 1;
                    @endphp
                    @foreach ($akunSales as $index => $akunSale)
                        <tr class="border-b border-gray-200">
                            <td class="p-2">{{ $startIndex + $index }}</td>
                            <td class="p-2">{{ $akunSale['nama_lengkap'] }}</td>
                            <td class="p-2">{{ $akunSale['username'] }}</td>
                            <td class="p-2">{{ $akunSale['status'] == 1 ? 'Aktif' : 'Off' }}</td>
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
                                        data-modal-target="edit-akun-modal-{{ $akunSale['id_user_sales'] }}"
                                        data-modal-toggle="edit-akun-modal-{{ $akunSale['id_user_sales'] }}"
                                        class="inline-flex items-center justify-center w-10 h-10 text-gray-800 bg-gray-200 border border-gray-300 rounded-sm shadow-sm hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500">
                                        <i class="fa-regular fa-pen-to-square text-lg"></i>
                                    </button>
                                    <button type="button"
                                        class="inline-flex items-center justify-center w-10 h-10 text-white bg-red-700 border border-red-600 rounded-sm shadow-sm hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-500">
                                        <i class="fa-regular fa-trash-can text-lg"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <!-- Modal Lihat KTP -->
                        <div id="ktp-modal-{{ $akunSale['id_user_sales'] }}" tabindex="-1" aria-hidden="true"
                            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-md max-h-full">
                                <div class="relative bg-white rounded-lg shadow">
                                    <div class="flex items-center justify-between p-4 border-b border-gray-600">
                                        <h3 class="text-lg font-semibold text-black">KTP {{ $akunSale['nama_lengkap'] }}
                                        </h3>
                                        <button type="button"
                                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center"
                                            data-modal-toggle="ktp-modal-{{ $akunSale['id_user_sales'] }}">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
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
                            <div class="relative w-full h-full max-w-md md:h-auto">
                                <div class="relative bg-white rounded-lg shadow">
                                    <div class="flex items-center justify-between p-4 border-b">
                                        <h3 class="text-lg font-semibold text-black">Edit Akun</h3>
                                        <button type="button"
                                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center"
                                            data-modal-toggle="edit-akun-modal-{{ $akunSale['id_user_sales'] }}">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('pengaturanSales.update', $akunSale['id_user_sales']) }}"
                                        id="edit-akun-form" class="p-4" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="grid gap-4 mb-4 grid-cols-2">
                                            <div class="col-span-2">
                                                <label for="edit-name"
                                                    class="block mb-2 text-sm font-medium text-black">Nama</label>
                                                <input type="text" value="{{ $akunSale['nama_lengkap'] }}"
                                                    name="nama_lengkap" id="nama_lengkap"
                                                    class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                                    required>
                                            </div>
                                            <div class="col-span-2">
                                                <label for="edit-username"
                                                    class="block mb-2 text-sm font-medium text-black">Username</label>
                                                <input type="text" value="{{ $akunSale['username'] }}"
                                                    name="username" id="username"
                                                    class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                                    required>
                                            </div>
                                            <div class="col-span-2">
                                                <label for="edit-password"
                                                    class="block mb-2 text-sm font-medium text-black">Password</label>
                                                <input type="text" value="Masukkan Password Baru Anda" name="password"
                                                    id="password"
                                                    class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                            </div>
                                            <div class="col-span-2">
                                                <label for="edit-phone"
                                                    class="block mb-2 text-sm font-medium text-black">No. Telepon</label>
                                                <input type="tel" value="{{ $akunSale['no_telp'] }}" name="no_telp"
                                                    id="no_telp"
                                                    class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                                    required>
                                            </div>
                                            <div class="col-span-2">
                                                <label for="edit-avatar"
                                                    class="block mb-2 text-sm font-medium text-gray-90">KTP</label>
                                                <input
                                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50"
                                                    aria-describedby="edit-avatar_help" name="gambar_ktp" id="gambar_ktp"
                                                    type="file" />
                                            </div>
                                            <div class="col-span-2 text-center">
                                                <button type="submit"
                                                    class="inline-flex items-center bg-gray-800 text-white py-2 px-4 rounded-md hover:bg-gray-700 transition duration-300">
                                                    Simpan Perubahan
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>




    <!-- Modal Tambah Akun-->
    <div id="tambah-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow">
                <div class="flex items-center justify-between p-4 border-b border-gray-600">
                    <h3 class="text-lg font-semibold text-black">Tambah Akun</h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center"
                        data-modal-toggle="tambah-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <form action="{{ route('pengaturanSales.input') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="name" class="block mb-2 text-sm font-medium text-black">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" id="nama_lengkap"
                                placeholder="Mohd Amirul Zarizan"
                                class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                required>
                        </div>
                        <div class="col-span-2">
                            <label for="username" class="block mb-2 text-sm font-medium text-black">Username</label>
                            <input type="text" name="username" id="username" placeholder="sales_dzul"
                                class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                required>
                        </div>
                        <div class="col-span-2">
                            <label for="password" class="block mb-2 text-sm font-medium text-black">Password</label>
                            <input type="password" name="password" id="password" placeholder="dzul123"
                                class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                required>
                        </div>
                        <div class="col-span-2">
                            <label for="phone" class="block mb-2 text-sm font-medium text-black">No. Telepon</label>
                            <input type="tel" name="no_telp" id="no_telp" placeholder="08xxxxxxxxxx"
                                class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                required>
                        </div>
                        <div class="col-span-2">
                            <label for="identity" class="block mb-2 text-sm font-medium text-black">KTP</label>
                            <input type="file" id="gambar_ktp" name="gambar_ktp"
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50" />
                        </div>
                    </div>
                    <div class="flex justify-center">
                        <button type="submit"
                            class="bg-gray-800 text-white py-2 px-4 rounded-md hover:bg-gray-700 transition duration-300">
                            Simpan
                        </button>
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
                <span class="font-semibold text-gray-900 dark:text-white">{{ $akunSales->total() }}</span> transaksi
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
    </script>
@endsection
