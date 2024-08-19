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
            <table class="min-w-full border-separate border-spacing-0 text-sm text-black">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="p-2 text-center">No</th>
                        <th class="p-2 text-center">Tanggal</th>
                        <th class="p-2 text-center">Sisa Produk</th>
                        <th class="p-2 text-center">Dokumentasi</th>
                        <th class="p-2 text-center">Aksi</th>
                    </tr>
                </thead>
                @foreach ($kunjunganToko as $index => $visit)
                    <tbody class="bg-white text-center">
                        <tr class="border-b border-gray-200">
                            <td class="p-2">{{ $index + 1 }}</td>
                            <td class="p-2">{{ $visit->tanggal->format('d/m/Y') }}</td>
                            <td class="p-2">{{ $visit->sisa_produk }}</td>
                            <td class="p-2 align-middle">
                                <img src="{{ $visit->gambar }}" alt="Dokumentasi"
                                    class="w-20 h-20 object-cover rounded-lg mx-auto">
                            </td>
                            <td class="p-2">
                                <button type="button" data-modal-target="#edit-visit-modal-{{ $visit->id_kunjungan_toko }}"
                                    class="inline-flex items-center justify-center w-10 h-10 text-gray-800 bg-gray-200 border border-gray-300 rounded-sm shadow-sm hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500">
                                    <i class="fa-regular fa-pen-to-square text-lg"></i>
                                </button>

                                <form id="delete-form"
                                    action="{{ route('kunjunganToko.destroy', $visit->id_kunjungan_toko) }}" method="POST"
                                    class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button"
                                        class="inline-flex items-center justify-center w-10 h-10 text-white bg-red-700 border border-red-600 rounded-sm shadow-sm hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 ml-2"
                                        onclick="confirmDelete('{{ $visit->tanggal->format('d/m/Y') }}')">
                                        <i class="fa-regular fa-trash-can text-lg"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- Modal Edit Kunjungan -->
                        <div id="edit-visit-modal-{{ $visit->id_kunjungan_toko }}" tabindex="-1" aria-hidden="true"
                            class="fixed top-0 left-0 right-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto h-modal hidden">
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
                                                    class="block text-sm font-medium text-gray-900">Sisa Produk</label>
                                                <input type="number" id="sisa_produk" name="sisa_produk"
                                                    value="{{ $visit->sisa_produk }}"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                    required>
                                            </div>

                                            <div class="text-left">
                                                <label for="gambar"
                                                    class="block text-sm font-medium text-gray-900">Dokumentasi</label>
                                                <input type="file" id="gambar" name="gambar"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    required>
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
                    <form action="" method="POST" class="space-y-4">
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
                                class="block text-sm font-medium text-gray-900 dark:text-gray-300">Sisa Produk</label>
                            <input type="number" id="sisa_produk" name="sisa_produk"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required>
                        </div>
                        <div class="text-left">
                            <label for="gambar"
                                class="block text-sm font-medium text-gray-900 dark:text-gray-300">Dokumentasi</label>
                            <input type="file" id="gambar" name="gambar"
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
  

        function confirmDelete(date) {
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
                    document.getElementById('delete-form').submit();
                }
            });
        }
    </script>
@endsection
