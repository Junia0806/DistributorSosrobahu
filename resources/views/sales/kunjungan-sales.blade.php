@extends('sales.default')

@section('content')
<div class="w-full max-w-6xl mx-auto bg-white rounded-lg shadow-lg overflow-x-auto my-20">
  <div class="flex items-center justify-between p-6 border-b">
      <h1 class="text-2xl font-bold text-black">Daftar Kunjungan - Toko {{ $storeName }}</h1>
      <button data-modal-target="add-visit-modal" data-modal-toggle="add-visit-modal" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2" type="button">
          Tambah Kunjungan
      </button>
  </div>

  <!-- Tabel Kunjungan -->
  <div class="overflow-x-auto">
      <table class="w-full border-separate border-spacing-0 text-sm text-black">
          <thead class="bg-gray-800 text-white">
              <tr>
                  <th class="p-2 text-center">No</th>
                  <th class="p-2 text-center">Tanggal</th>
                  <th class="p-2 text-center">Sisa Produk</th>
                  <th class="p-2 text-center">Dokumentasi</th>
                  <th class="p-2 text-center">Aksi</th>
              </tr>
          </thead>
          <tbody class="bg-white text-center">
              <!-- Contoh data kunjungan -->
              <tr class="border-b border-gray-200">
                  <td class="p-2">1</td>
                  <td class="p-2">09/03/2024</td>
                  <td class="p-2">20</td>
                  <td class="p-2 align-middle">
                      <img src="https://assets.digination.id/crop/0x0:0x0/750x500/photo/2020/07/16/898807242.png" alt="Dokumentasi" class="w-20 h-20 object-cover rounded-lg mx-auto">
                  </td>                        
                  <td class="p-2">
                      <button type="button" data-modal-target="edit-visit-modal" data-modal-toggle="edit-visit-modal" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-1 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-1 me-2 mb-2">Edit</button>
                      <button type="button" class="text-white bg-red-700 hover:bg-red-800 focus:ring-1 focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-1 me-2 mb-2">Hapus</button>
                  </td>
              </tr>
              <tr class="border-b border-gray-200">
                  <td class="p-2">2</td>
                  <td class="p-2">08/08/2024</td>
                  <td class="p-2">8</td>
                  <td class="p-2 align-middle">
                      <img src="https://live.staticflickr.com/108/313616986_2487f555b6_b.jpg" alt="Dokumentasi" class="w-20 h-20 object-cover rounded-lg mx-auto">
                  </td>
                  <td class="p-2">
                      <button type="button" data-modal-target="edit-visit-modal" data-modal-toggle="edit-visit-modal" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-1 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-1 me-2 mb-2">Edit</button>
                      <button type="button" class="text-white bg-red-700 hover:bg-red-800 focus:ring-1 focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-1 me-2 mb-2">Hapus</button>
                  </td>
              </tr>
          </tbody>
      </table>
  </div>
</div>

<!-- Modal Tambah Kunjungan -->
<div id="add-visit-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto h-modal hidden">
  <div class="relative w-full h-full max-w-md md:h-auto">
      <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
          <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:text-gray-500 dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="add-visit-modal">
              <svg aria-hidden="true" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
              </svg>
              <span class="sr-only">Close modal</span>
          </button>
          <div class="p-6 text-center">
              <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Tambah Kunjungan</h3>
              <form action="#" method="POST" class="space-y-4">
                  <div class="text-left">
                      <label for="date" class="block text-sm font-medium text-gray-900 dark:text-gray-300">Tanggal</label>
                      <input type="date" id="date" name="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                  </div>
                  <div class="text-left">
                      <label for="stock" class="block text-sm font-medium text-gray-900 dark:text-gray-300">Sisa Produk</label>
                      <input type="number" id="stock" name="stock" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                  </div>
                  <div class="text-left">
                      <label for="documentation" class="block text-sm font-medium text-gray-900 dark:text-gray-300">Dokumentasi</label>
                      <input type="file" id="documentation" name="documentation" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                  </div>
                  <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Simpan</button>
              </form>
              
          </div>
      </div>
  </div>
</div>

<!-- Modal Edit Kunjungan -->
<div id="edit-visit-modal" tabindex="-1" aria-hidden="true" class="hidden fixed top-0 left-0 right-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto h-modal">
  <div class="relative w-full h-full max-w-md md:h-auto">
      <div class="relative bg-white rounded-lg shadow">
          <div class="flex items-center justify-between p-4 border-b">
              <h3 class="text-lg font-semibold text-black">Edit Kunjungan</h3>
              <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center" data-modal-toggle="edit-visit-modal">
                  <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                  </svg>
                  <span class="sr-only">Close modal</span>
              </button>
          </div>
          <form class="p-4">
              <div class="grid gap-4 mb-4 grid-cols-2">
                  <div class="col-span-2">
                      <label for="edit-date" class="block mb-2 text-sm font-medium text-black">Tanggal</label>
                      <input type="date" name="edit-date" id="edit-date" class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required>
                  </div>                        
                  <div class="col-span-2">
                      <label for="edit-location" class="block mb-2 text-sm font-medium text-black">Sisa Produk</label>
                      <input type="text" name="edit-location" id="edit-location" class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required>
                  </div>
                  <div class="col-span-2">
                      <label class="block mb-2 text-sm font-medium text-gray-90" for="edit-avatar">Dokumentasi</label>
                      <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50" aria-describedby="edit-avatar_help" id="edit-avatar" type="file">
                  </div>
                  <div class="col-span-2 text-center">
                      <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5">
                          Simpan Perubahan
                      </button>
                  </div>
              </div>
          </form>
      </div>
  </div>
</div>
@endsection
