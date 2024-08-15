@extends('sales.default')

@section('content')
    <div class="w-full max-w-6xl mx-auto bg-white rounded-lg shadow-lg overflow-x-auto my-20">
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
                        <th class="p-2 text-center">Stok</th>
                        <th class="p-2 text-center">Kunjungi</th>
                    </tr>
                </thead>
                <tbody class="bg-white text-center">
                    @foreach ($toko as $index => $item)
                        <tr class="border-b border-gray-200">
                            <td class="p-2">{{ $index + 1 }}</td>
                            <td class="p-2">{{ $item->nama_toko }}</td>
                            <td class="p-2">{{ $item->lokasi }}</td>
                            <td class="p-2">{{ $item->nama_pemilik }}</td>
                            <td class="p-2">{{ $item->no_telp }}</td>
                            <td></td>
                            <td class="p-2">
                                <a href="{{ url('/kunjunganToko/' . $item->id_daftar_toko) }}"
                                class="bg-green-600 text-white font-bold py-1 px-3 rounded hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 text-xs">Detail</a>
                            </td>
                        </tr>
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
                                class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                required>
                        </div>
                        <div class="col-span-2">
                            <label for="lokasi" class="block mb-2 text-sm font-medium text-black">Alamat Lengkap Toko</label>
                            <input type="text" name="lokasi" id="lokasi"
                                class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                required>
                        </div>
                        <div class="col-span-2">
                            <label for="nama_pemilik" class="block mb-2 text-sm font-medium text-black">Nama Pemilik</label>
                            <input type="text" name="nama_pemilik" id="nama_pemilik"
                                class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                required>
                        </div>
                        <div class="col-span-2">
                            <label for="no_telp" class="block mb-2 text-sm font-medium text-black">No. Telepon</label>
                            <input type="text" name="no_telp" id="no_telp"
                                class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                required>
                        </div>
                    </div>
                    <div class="flex justify-center">
                        <button type="submit"
                            class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
