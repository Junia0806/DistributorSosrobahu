@extends('agen.default')

@section('content')
    <section class="container mx-auto py-6 my-20">
        <div class="bg-white shadow-lg rounded-lg p-3">
            <h2 class="text-2xl font-bold mb-2 text-center text-gray-800">Pilih Produk dalam Ukuran Karton</h2>
            <p class="text-center text-gray-600 mb-6">Silakan pilih produk dalam ukuran karton yang ingin Anda pesan.</p>

            <!-- Pemberitahuan Kuantitas Per Karton -->
            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-2 mb-6 rounded-lg">
                <p class="font-medium">Perhatian!</p>
                <p>Harga yang tertera adalah harga produk per karton. Atur kuantitas setelah klik "Lanjut Pesanan".</p>
            </div>
            <div class="grid grid-cols-2 gap-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 py-3">
                {{-- Card Produk --}}
                @for ($i = 1; $i <= 6; $i++)
                    <label class="relative block cursor-pointer">
                        <input type="checkbox" class="absolute opacity-0 peer" id="product1">
                        <div
                            class="bg-white p-4 rounded-lg border border-gray-200 shadow-md transition-colors duration-150 peer-checked:bg-gray-300 peer-checked:border-green-500 peer-checked:border-2 peer-checked:shadow-lg w-full max-w-[180px] mx-auto">
                            <div class="relative mb-4">
                                <img src="{{ asset('assets/images/produk' . $i . '.jpg') }}" alt="Sosrobahu Kopi Hitam"
                                    class="w-full h-[200px] object-cover rounded-md border border-gray-200">
                            </div>
                            <div class="text-center">
                                <h2 class="text-sm font-bold text-gray-800">Sosrobahu Kopi Hitam</h2>
                                <p class="text-gray-600 text-sm">Rp 600.000</p>
                            
                            </div>
                        </div>
                    </label>
                @endfor       
            </div>

            <div class="sticky bottom-0 bg-white w-full flex justify-center p-2">
                <button onclick="window.location.href='{{ route('agen-detailpesan') }}'"
                    class="bg-gray-800 text-white font-bold py-3 px-6 rounded-md hover:bg-gray-600 transition duration-300 w-2/3 lg:w-1/4">
                    Lanjut Pesanan <i class="fa-solid fa-forward ml-2"></i>
            </div>
        </div>
    </section>
@endsection
