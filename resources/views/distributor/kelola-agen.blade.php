@extends('distributor.default')
@section('content')
<div class="w-full max-w-6xl mx-auto bg-white rounded-lg shadow-lg overflow-x-auto my-20">
    <div class="flex items-center justify-between p-6 border-b">
        <div class="flex-1 text-center">
            <h1 class="text-2xl font-bold text-black">Daftar Akun Agen</h1>
        </div>
        <button data-modal-target="tambah-modal" data-modal-toggle="tambah-modal"
            class="bg-gray-800 text-white py-2 px-4 rounded-md hover:bg-gray-700 transition duration-300" type="button">
            <i class="fa-regular fa-square-plus"></i> Tambah Akun
        </button>
    </div>

    <!-- Tabel Toko -->
    <table class="w-full border-separate border-spacing-0 text-sm text-black">
        <thead class="bg-gray-800 text-white">
            <tr>
                <th class="p-2 text-center">No</th>
                <th class="p-2 text-center">Nama Lengkap</th>
                <th class="p-2 text-center">Username</th>
                <th class="p-2 text-center">Password</th>
                <th class="p-2 text-center">No Telpon</th>
                <th class="p-2 text-center">KTP</th>
                <th class="p-2 text-center">Penjualan</th>
                <th class="p-2 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white text-center">
            <tr class="border-b border-gray-200">
                <td class="p-2">1</td>
                <td class="p-2">Joshua</td>
                <td class="p-2">agen_hong</td>
                <td class="p-2">hongjisoo123</td>
                <td class="p-2">0897654321</td>
                <td class="p-2">
                    <button type="button" data-modal-target="ktp-modal-1" data-modal-toggle="ktp-modal-1"
                        class="bg-green-600 text-white font-bold py-1 px-3 rounded hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 text-xs">Lihat</button>
                </td>
                <td class="p-2 font-semibold">Rp.8.400.000</td>
                <td class="p-2">
                    <div class="flex justify-center space-x-2">
                        <button type="button" data-modal-target="edit-akun-modal" data-modal-toggle="edit-akun-modal"
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

            <tr class="border-b border-gray-200">
                <td class="p-2">2</td>
                <td class="p-2">Upin Ipin</td>
                <td class="p-2">agen_ui</td>
                <td class="p-2">upinipin12</td>
                <td class="p-2">0897654321</td>
                <td class="p-2">
                    <button type="button" data-modal-target="ktp-modal-2" data-modal-toggle="ktp-modal-2"
                        class="bg-green-600 text-white font-bold py-1 px-3 rounded hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 text-xs">Lihat</button>
                </td>
                <td class="p-2 font-semibold">Rp.3.000.000</td>
                <td class="p-2">
                    <div class="flex justify-center space-x-2">
                        <button type="button" data-modal-target="edit-akun-modal" data-modal-toggle="edit-akun-modal"
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
        </tbody>
    </table>
</div>

<!-- Modal Lihat KTP -->
<div id="ktp-modal-1" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow">
            <div class="flex items-center justify-between p-4 border-b border-gray-600">
                <h3 class="text-lg font-semibold text-black">KTP Joshua</h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center"
                    data-modal-toggle="ktp-modal-1">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <div class="p-4">
                <img src="https://i.pinimg.com/originals/37/11/3b/37113bd2dcabec9a0c58b90e2ac038b3.jpg" alt="KTP Joshua Hong" class="w-full rounded-lg">
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Akun -->
<div id="edit-akun-modal" tabindex="-1" aria-hidden="true"
    class="hidden fixed top-0 left-0 right-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto h-modal">
    <div class="relative w-full h-full max-w-md md:h-auto">
        <div class="relative bg-white rounded-lg shadow">
            <div class="flex items-center justify-between p-4 border-b">
                <h3 class="text-lg font-semibold text-black">Edit Akun</h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center"
                    data-modal-toggle="edit-akun-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
                <!-- Form Edit Akun -->
                <form class="p-4">
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <!-- Nama Lengkap -->
                        <div class="col-span-2">
                            <label for="edit-nama" class="block text-sm font-medium text-black mb-2">Nama Lengkap</label>
                            <input type="text" id="edit-nama" name="edit-nama" value="Joshua" 
                                   class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required>
                        </div>
                        
                        <!-- Username -->
                        <div class="col-span-2">
                            <label for="edit-username" class="block text-sm font-medium text-black mb-2">Username</label>
                            <input type="text" id="edit-username" name="edit-username" value="agen_hong" 
                                   class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required>
                        </div>
                        
                        <!-- Password -->
                        <div class="col-span-2">
                            <label for="edit-password" class="block text-sm font-medium text-black mb-2">Password</label>
                            <input type="password" id="edit-password" name="edit-password" value="hongjisoo123" 
                                   class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required>
                        </div>
                        
                        <!-- No Telpon -->
                        <div class="col-span-2">
                            <label for="edit-no-telpon" class="block text-sm font-medium text-black mb-2">No Telpon</label>
                            <input type="tel" id="edit-no-telpon" name="edit-no-telpon" value="0897654321" 
                                   class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required>
                        </div>
                        
                        <!-- KTP -->
                        <div class="col-span-2">
                            <label for="edit-avatar" class="block text-sm font-medium text-black mb-2">KTP</label>
                            <input type="file" id="edit-avatar" class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg cursor-pointer block w-full" />
                        </div>
                        
                        <!-- Simpan Perubahan Button -->
                        <div class="col-span-2 text-center">
                            <button type="submit" class="inline-flex items-center bg-gray-800 text-white py-2 px-4 rounded-md hover:bg-gray-700 transition duration-300">
                                Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </form>
        </div>
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
            <form class="p-4">
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="name" class="block mb-2 text-sm font-medium text-black">Nama Lengkap</label>
                        <input type="text" name="name" id="name" placeholder="Mohd Amirul Zarizan"
                            class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            required>
                    </div>
                    <div class="col-span-2">
                        <label for="username" class="block mb-2 text-sm font-medium text-black">Username</label>
                        <input type="text" name="username" id="username" placeholder="agen_hong"
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
                        <input type="tel" name="phone" id="phone" placeholder="08xxxxxxxxxx"
                            class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            required>
                    </div>
                    <div class="col-span-2">
                        <label for="identity" class="block mb-2 text-sm font-medium text-black">KTP</label>
                        <input type="file" id="identity" name="identity" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50" />
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

@endsection
