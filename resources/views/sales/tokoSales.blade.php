@extends('sales.default')

@section('content')
    <div class="w-full max-w-6xl mx-auto bg-white rounded-lg shadow-lg overflow-x-auto mt-20">
        <div class="flex items-center justify-between p-6 border-b">
            <div class="flex-1 text-center">
                <h1 class="text-2xl font-bold text-black">Daftar Toko </h1>
            </div>
            <button data-modal-target="crud-modal" data-modal-toggle="crud-modal"
                class="bg-gray-800 text-white py-2 px-4 rounded-md hover:bg-gray-700 transition duration-300" type="button">
                <i class="fa-regular fa-square-plus"></i> Tambah Toko
            </button>
        </div>

        <!-- Tabel Toko -->
        <div class="overflow-x-auto">
            <table class="w-full border-separate border-spacing-0 text-sm text-black">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="p-2 text-center">No</th>
                        <th class="p-2 text-center">Nama Toko</th>
                        <th class="p-2 text-center">Alamat Lengkap</th>
                        <th class="p-2 text-center">Nama Pemilik</th>
                        <th class="p-2 text-center">No Telp</th>
                        <th class="p-2 text-center">Kunjungi</th>
                        <th class="p-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white text-center">
                    @php
                        // Menghitung nomor urut awal untuk halaman saat ini
                        $startIndex = $toko->perPage() * ($toko->currentPage() - 1) + 1;
                    @endphp
                    @foreach ($toko as $index => $item)
                        <tr class="border-b border-gray-200">
                            <td class="p-2">{{ $startIndex + $index }}</td>
                            <td class="p-2">{{ $item->nama_toko }}</td>
                            <td class="p-2">{{ $item->lokasi }}</td>
                            <td class="p-2">{{ $item->nama_pemilik }}</td>
                            <td class="p-2">{{ $item->no_telp }}</td>
                            <td class="p-2">
                                <a href="{{ url('/kunjunganToko/' . $item->id_daftar_toko) }}"
                                    class="bg-green-600 text-white font-semibold py-2 px-2 rounded hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">Detail</a>
                            </td>
                            <td class="p-2">
                                <button type="button" data-modal-target="#edit-item-modal-{{ $item->id_daftar_toko }}"
                                    class="inline-flex items-center justify-center w-10 h-10 text-gray-800 bg-gray-200 border border-gray-300 rounded-sm shadow-sm hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500">
                                    <i class="fa-regular fa-pen-to-square text-lg"></i>
                                </button>
                                <!-- Tombol Hapus -->
                                <form id="delete-form-{{ $item->id_daftar_toko }}"
                                    action="{{ route('tokoSales.destroy', $item->id_daftar_toko) }}" method="POST"
                                    class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button"
                                        class="inline-flex items-center justify-center w-10 h-10 text-white bg-red-700 border border-red-600 rounded shadow-sm hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 ml-1"
                                        onclick="confirmDelete('{{ $item->id_daftar_toko }}', '{{ $item->nama_toko }}')">
                                        <i class="fa-regular fa-trash-can text-base"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- Modal Edit Toko -->
                        <div id="edit-item-modal-{{ $item->id_daftar_toko }}" tabindex="-1" aria-hidden="true"
                            class="fixed inset-0 z-50 flex items-center justify-center w-full p-4 overflow-x-hidden overflow-y-auto h-modal hidden">
                            <div class="relative w-full max-w-full md:max-w-md h-full max-h-full md:h-auto">
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <button type="button"
                                        class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:text-gray-500 dark:hover:bg-gray-600 dark:hover:text-white"
                                        data-modal-hide="#edit-item-modal-{{ $item->id_daftar_toko }}">
                                        <svg aria-hidden="true" class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                    <div class="p-6 text-center">
                                        <h3 class="text-lg font-semibold text-gray-900">Edit Toko {{ $item->nama_toko }}</h3>
                                        <form action="{{ route('tokoSales.update', $item->id_daftar_toko) }}" method="POST" class="space-y-4">
                                            @csrf
                                            @method('PUT')
                                            
                                            <div class="text-left mt-4">
                                                <label for="nama_toko" class="block text-sm font-medium text-gray-900">Nama Toko</label>
                                                <input type="text" name="nama_toko" id="nama_toko" value="{{ $item->nama_toko }}"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mt-1"
                                                    required>
                                            </div>
                        
                                            <div class="text-left mt-4">
                                                <label for="lokasi" class="block text-sm font-medium text-gray-900">Alamat Lengkap Toko</label>
                                                <input type="text" name="lokasi" id="lokasi" value="{{ $item->lokasi }}"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mt-1"
                                                    required>
                                            </div>
                        
                                            <div class="text-left mt-4">
                                                <label for="nama_pemilik" class="block text-sm font-medium text-gray-900">Nama Pemilik</label>
                                                <input type="text" name="nama_pemilik" id="nama_pemilik" value="{{ $item->nama_pemilik }}"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mt-1"
                                                    required>
                                            </div>
                        
                                            <div class="text-left mt-4">
                                                <label for="no_telp" class="block text-sm font-medium text-gray-900">No. Telepon</label>
                                                <input type="text" name="no_telp" id="no_telp" value="{{ $item->no_telp }}"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mt-1"
                                                    required>
                                            </div>
                        
                                            <button type="submit"
                                                class="bg-gray-800 text-white py-2 px-4 rounded-md hover:bg-gray-700 transition duration-300 font-medium text-sm my-2 mt-4">
                                                Simpan
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                                                
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Tambah Toko -->
    <div id="crud-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow-lg">
                <div class="flex items-center justify-between p-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-black">Tambah Toko</h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center"
                        data-modal-toggle="crud-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <form action="" method="POST" class="p-4">
                    @csrf
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="nama_toko" class="block mb-2 text-sm font-medium text-black">Nama Toko</label>
                            <input type="text" name="nama_toko" id="nama_toko"
                                class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Berkah Makmur"
                                required>
                        </div>
                        <div class="col-span-2">
                            <label for="lokasi" class="block mb-2 text-sm font-medium text-black">Alamat Lengkap
                                Toko</label>
                            <input type="text" name="lokasi" id="lokasi"
                                class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Jl. Melati, Sidoarjo"
                                required>
                        </div>
                        <div class="col-span-2">
                            <label for="nama_pemilik" class="block mb-2 text-sm font-medium text-black">Nama
                                Pemilik</label>
                            <input type="text" name="nama_pemilik" id="nama_pemilik"
                                class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Sujono"
                                required>
                        </div>
                        <div class="col-span-2">
                            <label for="no_telp" class="block mb-2 text-sm font-medium text-black">No. Telepon</label>
                            <input type="text" name="no_telp" id="no_telp"
                                class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="08xxxxxxxxxx"
                                required>
                        </div>
                    </div>
                    <div class="flex justify-center">
                        <button type="submit"
                            class="text-white inline-flex items-center bg-gray-800 hover:bg-gray-700 transition duration-300 font-medium rounded-lg text-sm px-4 py-2.5">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <!-- Custom Pagination -->
    <div class="flex flex-col items-center my-6">
        <!-- Help text -->
        <span class="text-sm text-gray-700 dark:text-gray-400">
            Menampilkan <span class="font-semibold text-gray-900 dark:text-white">{{ $toko->firstItem() }}</span> sampai
            <span class="font-semibold text-gray-900 dark:text-white">{{ $toko->lastItem() }}</span> dari <span
                class="font-semibold text-gray-900 dark:text-white">{{ $toko->total() }}</span> toko
        </span>
        <!-- Buttons -->
        <div class="inline-flex mt-2 xs:mt-0">
            <!-- Previous Button -->
            <button {{ $toko->onFirstPage() ? 'disabled' : '' }}
                class="flex items-center justify-center px-3 h-8 text-sm font-medium text-white bg-gray-800 rounded-s hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                {{ $toko->previousPageUrl() ? 'onclick=window.location.href=\'' . $toko->previousPageUrl() . '\'' : '' }}>
                Sebelumnya
            </button>
            <!-- Next Button -->
            <button {{ !$toko->hasMorePages() ? 'disabled' : '' }}
                class="flex items-center justify-center px-3 h-8 text-sm font-medium text-white bg-gray-800 border-0 border-s border-gray-700 rounded-e hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                {{ $toko->nextPageUrl() ? 'onclick=window.location.href=\'' . $toko->nextPageUrl() . '\'' : '' }}>
                Selanjutnya
            </button>
        </div>
    </div>

    </div>
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

        function confirmDelete(id, namaToko) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda tidak akan dapat mengembalikan toko " + namaToko + " ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus toko!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika konfirmasi, submit form penghapusan
                    document.getElementById('delete-form-' + id).submit();
                }
            })
        }
    </script>
@endsection
