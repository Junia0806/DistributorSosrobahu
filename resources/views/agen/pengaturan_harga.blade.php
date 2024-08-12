@extends('agen.default')

@section('content')
<section class="container mx-auto p-6">
  <div class="bg-white shadow-lg rounded-lg max-w-full overflow-x-auto">
    <h2 class="text-2xl font-bold border-b-2 mb-3 pb-3 text-center">Pengaturan Harga</h2>
    <div class="overflow-x-auto">
      <table class="w-full border-separate border-spacing-0">
        <thead class="bg-gray-800 text-white">
          <tr>
            <th class="px-4 py-2 text-left text-sm font-medium">Nama produk</th>
            <th class="px-4 py-2 text-left text-sm font-medium">Harga</th>
            <th class="px-4 py-2 text-left text-sm font-medium">Aksi</th>
          </tr>
        </thead>
        <tbody class="bg-white text-sm">
          <tr class="border-b border-gray-200 hover:bg-gray-100">
            <td class="px-4 py-2">Sosrobahu Kopi Hitam</td>
            <td class="px-4 py-2">Rp. 120.000</td>
            <td class="px-4 py-2">
              <button class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-700" onclick="openModal('Sosrobahu Kopi Hitam', 120000)">Edit</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</section>

<!-- Modal -->
<div id="editModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
  <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md relative">
    <h3 class="text-2xl font-semibold mb-4">Edit Harga Produk</h3>
    <form id="editForm">
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">Nama Produk</label>
        <p class="block text-sm font-medium text-gray-900 mt-1">Sosrobahu Kopi Hitam</p>
      </div>
      <div class="mb-4">
        <label for="productPrice" class="block text-sm font-medium text-gray-700">Harga</label>
        <input type="number" id="productPrice" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
      </div>
      <div class="flex justify-end space-x-2 mt-4">
        <button type="button" class="bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-700" onclick="closeModal()">Batal</button>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
      </div>
    </form>
    <button class="absolute top-2 right-2 text-gray-500 hover:text-gray-700" onclick="closeModal()">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
      </svg>
    </button>
  </div>
</div>


<script>
  function openModal(productName, productPrice) {
    document.getElementById('productPrice').value = productPrice;
    document.getElementById('editModal').classList.remove('hidden');
  }

  function closeModal() {
    document.getElementById('editModal').classList.add('hidden');
  }
</script>
@endsection
