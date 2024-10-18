@extends('sales.default')

@section('content')
    <div class="w-full max-w-6xl mx-auto bg-white rounded-lg shadow-lg overflow-x-auto my-20">
        <div class="flex items-center justify-between p-6 border-b">
            <h1 class="text-2xl font-bold text-black">Daftar Kunjungan - Toko {{ $storeName }}</h1>
            <button data-modal-target="add-visit-modal" data-modal-toggle="add-visit-modal"
                class="bg-gray-800 text-white py-2 px-4 rounded-md hover:bg-gray-700 transition duration-300" type="button">
                <i class="fa-regular fa-square-plus"></i> Tambah Kunjungan
            </button>
        </div>

        <!-- Tabel Kunjungan -->
        <div class="overflow-x-auto">
            <!-- Pesan jika belum ada kunjungan -->
            @if ($kunjunganToko->isEmpty())
                <div
                    class="text-center p-6 my-6 mx-6 bg-yellow-100 border border-yellow-300 text-yellow-800 rounded-lg mb-6">
                    <p class="text-lg font-semibold">Belum ada kunjungan untuk toko {{ $storeName }}.</p>
                    <p class="mt-2">Silakan tambahkan kunjungan dengan menekan tombol "Tambah Kunjungan" di atas.</p>
                </div>
            @else
                <table class="min-w-full border-separate border-spacing-0 text-sm text-black">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="p-2 text-center">No</th>
                            <th class="p-2 text-center">Tanggal</th>
                            <th class="p-2 text-center">Produk Terjual</th>
                            <th class="p-2 text-center">Dokumentasi</th>
                            <th class="p-2 text-center">Aksi</th>
                        </tr>
                    </thead>
                    @php
                        // Menghitung nomor urut awal untuk halaman saat ini
                        $startIndex = $kunjunganToko->perPage() * ($kunjunganToko->currentPage() - 1) + 1;
                    @endphp
                    @foreach ($kunjunganToko as $index => $visit)
                        <tbody class="bg-white text-center">
                            <tr class="border-b border-gray-200">
                                <td class="p-2">{{ $startIndex + $index }}</td>
                                <td class="p-2">{{ $visit->tanggal->format('d/m/Y') }}</td>
                                <td class="p-2">{{ $visit->sisa_produk }}</td>
                                <td class="p-2 align-middle">
                                    <img src="{{ asset('storage/' . $gambarTokoList[$index]) }}" alt="Dokumentasi"
                                        class="w-20 h-20 object-cover rounded-lg mx-auto">
                                </td>
                                <td class="p-2">
                                    <button type="button"
                                        data-modal-target="#edit-visit-modal-{{ $visit->id_kunjungan_toko }}"
                                        class="inline-flex items-center justify-center w-10 h-10 text-gray-800 bg-gray-200 border border-gray-300 rounded-sm shadow-sm hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500">
                                        <i class="fa-regular fa-pen-to-square text-lg"></i>
                                    </button>

                                    <form id="delete-form-{{ $visit->id_kunjungan_toko }}"
                                        action="{{ route('kunjunganToko.destroy', $visit->id_kunjungan_toko) }}"
                                        method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                            class="inline-flex items-center justify-center w-10 h-10 text-white bg-red-700 border border-red-600 rounded-sm shadow-sm hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 ml-2"
                                            onclick="confirmDelete('{{ $visit->id_kunjungan_toko }}','{{ $visit->tanggal->format('d/m/Y') }}')">
                                            <i class="fa-regular fa-trash-can text-lg"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Modal Edit Kunjungan -->
                            <div id="edit-visit-modal-{{ $visit->id_kunjungan_toko }}" tabindex="-1" aria-hidden="true"
                                class="fixed inset-0 z-50 flex items-center justify-center w-full p-4 overflow-x-hidden overflow-y-auto h-modal hidden">
                                <div class="relative w-full max-w-full md:max-w-md h-full max-h-full md:h-auto">
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <button type="button"
                                            class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:text-gray-500 dark:hover:bg-gray-600 dark:hover:text-white"
                                            data-modal-hide="#edit-visit-modal-{{ $visit->id_kunjungan_toko }}">
                                            <svg aria-hidden="true" class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                        <div class="p-6 text-center">
                                            <h3 class="text-lg font-semibold text-gray-900">Edit Kunjungan</h3>
                                            <form action="{{ route('kunjunganToko.update', $visit->id_kunjungan_toko) }}"
                                                method="POST" enctype="multipart/form-data" class="space-y-4">
                                                @csrf
                                                @method('PUT')

                                                <div class="text-left">
                                                    <input type="hidden" name="id_daftar_toko" id="id_daftar_toko"
                                                        value="{{ $id_toko }}"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                        required>
                                                </div>

                                                <div class="text-left">
                                                    <label for="tanggal"
                                                        class="block text-sm font-medium text-gray-900">Tanggal</label>
                                                    <input type="date" name="tanggal" id="tanggal"
                                                        value="{{ $visit->tanggal->format('Y-m-d') }}"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                        required>
                                                </div>

                                                <div class="text-left">
                                                    <label for="sisa_produk"
                                                        class="block text-sm font-medium text-gray-900">Produk
                                                        Terjual</label>
                                                    <input type="number" id="sisa_produk" name="sisa_produk"
                                                        value="{{ $visit->sisa_produk }}"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                        required>
                                                </div>

                                                <div class="text-left">
                                                    <label for="gambar" id="file-input-label"
                                                        class="block text-sm font-medium text-gray-900">Dokumentasi</label>

                                                    <p id="file-error-{{ $visit->id_kunjungan_toko }}"
                                                        class="mt-1 text-sm text-red-500" style="display:none;">Gambar tidak
                                                        boleh berukuran lebih dari 1 MB.</p>

                                                    <input type="file"
                                                        id="gambar-{{ $visit->id_kunjungan_toko }}"name="gambar"
                                                        accept=".jpg, .jpeg, .png"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        required>

                                                    <p id="ktp-file-name-{{ $visit->id_kunjungan_toko }}"
                                                        class="text-sm text-gray-500">
                                                        File saat ini:
                                                        {{ $visit['gambar'] ? basename($visit['gambar']) : 'Tidak ada file saat ini.' }}
                                                    </p>

                                                </div>

                                                <button type="submit"
                                                    class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-md text-sm px-4 py-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 my-2">
                                                    Simpan
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </tbody>
                    @endforeach
            @endif
            </table>
        </div>


    </div>

    <!-- Modal Tambah Kunjungan -->
    <div id="add-visit-modal" tabindex="-1" aria-hidden="true"
        class="fixed top-0 left-0 right-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto h-modal hidden">
        <div class="relative w-full max-w-full md:max-w-md h-full max-h-full md:h-auto">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button"
                    class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:text-gray-500 dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-toggle="add-visit-modal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-6 text-center">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Tambah Kunjungan</h3>
                    <form action="" enctype="multipart/form-data" method="POST" class="space-y-4">
                        @csrf
                        <div class="text-left">

                            <input type="hidden" name="id_daftar_toko" id="id_daftar_toko" value="{{ $id_toko }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required>
                        </div>
                        <div class="text-left">
                            <label for="tanggal"
                                class="block text-sm font-medium text-gray-900 dark:text-gray-300">Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required>
                        </div>
                        <div class="text-left">
                            <label for="sisa_produk"
                                class="block text-sm font-medium text-gray-900 dark:text-gray-300">Produk Terjual</label>
                            <input type="number" id="sisa_produk" name="sisa_produk"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required>
                        </div>
                        <div class="text-left">
                            <label for="gambar" id="file-input-label"
                                class="block text-sm font-medium text-gray-900 dark:text-gray-300">Dokumentasi</label>
                            <p id="file-error" class="mt-1 text-sm text-red-500" style="display:none;">Gambar tidak
                                boleh berukuran lebih dari 1 MB.</p>
                            <input type="file" id="gambar" name="gambar" accept=".jpg, .jpeg, .png"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required>
                        </div>
                        <button type="submit"
                            class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-md text-sm px-4 py-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                            Simpan
                        </button>

                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- Custom Pagination -->
    @if ($kunjunganToko->total() > 5)
        <div class="flex flex-col items-center my-6">
            <!-- Help text -->
            <span class="text-sm text-gray-700 dark:text-gray-400">
                Menampilkan <span
                    class="font-semibold text-gray-900 dark:text-white">{{ $kunjunganToko->firstItem() }}</span>
                sampai
                <span class="font-semibold text-gray-900 dark:text-white">{{ $kunjunganToko->lastItem() }}</span> dari
                <span class="font-semibold text-gray-900 dark:text-white">{{ $kunjunganToko->total() }}</span>
                kunjungan
            </span>
            <!-- Buttons -->
            <div class="inline-flex mt-2 xs:mt-0">
                <!-- Previous Button -->
                <button {{ $kunjunganToko->onFirstPage() ? 'disabled' : '' }}
                    class="flex items-center justify-center px-3 h-8 text-sm font-medium text-white bg-gray-800 rounded-s hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                    {{ $kunjunganToko->previousPageUrl() ? 'onclick=window.location.href=\'' . $kunjunganToko->previousPageUrl() . '\'' : '' }}>
                    Sebelumnya
                </button>
                <!-- Next Button -->
                <button {{ !$kunjunganToko->hasMorePages() ? 'disabled' : '' }}
                    class="flex items-center justify-center px-3 h-8 text-sm font-medium text-white bg-gray-800 border-0 border-s border-gray-700 rounded-e hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                    {{ $kunjunganToko->nextPageUrl() ? 'onclick=window.location.href=\'' . $kunjunganToko->nextPageUrl() . '\'' : '' }}>
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
        document.querySelectorAll('input[type="file"]').forEach(input => {
            input.addEventListener('change', function() {
                const file = this.files[0];
                const fileError = document.getElementById('file-error-' + this.id.split('-')[
                    1]);
                if (file && file.size > 1048576) {
                    fileError.style.display = 'block';
                    this.value = '';
                    this.classList.add('border-red-500');
                } else {
                    this.classList.remove('border-red-500');
                    fileError.style.display = 'none';
                }
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('form').forEach(form => {
                form.addEventListener('submit', function(event) {
                    const fileInput = this.querySelector('input[type="file"]');
                    const fileError = document.getElementById('file-error-' + fileInput.id.split(
                        '-')[1]);

                    if (fileError.style.display === 'block' || fileInput.value === '') {
                        event.preventDefault();
                        fileError.style.display = 'block';
                    }
                });
            });
        });


        function confirmDelete(id, date) {
            Swal.fire({
                title: 'Anda yakin?',
                text: `Anda akan menghapus kunjungan toko pada ${date} ini.`,
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
