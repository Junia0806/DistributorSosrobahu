@extends('distributor.default')

@section('content')
    <section class="container mx-auto py-6 my-20">
        <div class="bg-white shadow-lg rounded-lg p-3">
            <h2 class="text-3xl font-bold text-center text-gray-900 mb-2 leading-tight">
                <span class="text-yellow-600">Produk Terbaru</span> Sosrobahu
            </h2>
            <div
                class="bg-gradient-to-r from-yellow-400 via-yellow-500 to-yellow-600 text-white p-2 mb-4 rounded-lg shadow-md">
                <div class="flex items-center mb-2">
                    <i class="fas fa-info-circle text-medium mr-2"></i>
                    <p class="font-semibold text-lg">Informasi Penting!</p>
                </div>
                <p class="text-sm">
                    Pilih produk sosrobahu terbaru untuk dikelola dan dijual kepada Agen, kemudian sesuaikan harganya.
                </p>
            </div>

            <form action="{{ route('storeSelectedProductsDistributor') }}" method="POST">
                @csrf
                <div class="grid grid-cols-2 gap-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 py-3">
                    {{-- Card Produk --}}
                    @foreach ($newDistributorProducts as $index => $barang)
                        <label class="relative block cursor-pointer">
                            <input type="checkbox" class="absolute opacity-0 peer" id="product{{ $barang->id_master_barang }}"
                                name="products[]" value="{{ $barang->id_master_barang }}">
                            <div
                                class="bg-white p-3 rounded-lg border border-gray-200 shadow-md transition-colors duration-150 peer-checked:bg-gray-300 peer-checked:border-green-500 peer-checked:border-2 peer-checked:shadow-lg w-full max-w-[180px] mx-auto">
                                <div class="relative mb-2">
                                    <img src="{{ asset('storage/produk/' . $gambarRokokList[$index]) }}" alt="{{ $namaRokokList[$index] }}"
                                        class="w-full h-[200px] object-cover rounded-md border border-gray-200">
                                </div>
                                <div class="text-center">
                                    <h2 class="text-sm font-bold text-gray-800">{{ $namaRokokList[$index] }}</h2>
                                    <p class="text-gray-600 text-sm">Rp {{ number_format($barang->harga_karton_pabrik, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </label>
                    @endforeach
                </div>

                <div class="sticky bottom-0 bg-white w-full flex justify-center p-4">
                    <button type="submit"
                        class="bg-gray-800 text-white font-semibold py-3 px-8 rounded-md hover:bg-gray-700 transition duration-300 w-2/3 lg:w-1/4 text-center flex justify-center items-center">
                        <i class="fa-solid fa-plus mr-2"></i> Tambahkan Produk 
                    </button>
                </div>
            </form>

        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            form.addEventListener('submit', function(event) {
                const checkboxes = document.querySelectorAll('input[name="products[]"]:checked');
                if (checkboxes.length === 0) {
                    event.preventDefault();
                    Swal.fire({
                        icon: 'warning',
                        title: 'Produk Belum Dipilih',
                        text: 'Silakan pilih produk terlebih dahulu sebelum menambahkan.',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });
    </script>
@endsection
