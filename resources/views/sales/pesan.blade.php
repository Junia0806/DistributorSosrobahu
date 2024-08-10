@extends('sales.default')

@section('content')
    <section class="container mx-auto py-6">
        <div class="bg-white shadow-lg rounded-lg p-3">
            <h2 class="text-2xl font-bold mb-2 text-center text-gray-800">Pilih Produk</h2>
            <p class="text-center text-gray-600 mb-6">Pilih kartu produk yang ingin Anda pesan, lalu klik tombol "Lanjut Pesanan" untuk melanjutkan.</p>
            <div class="flex justify-end mb-6">
                <button onclick="window.location.href='{{ route('detail') }}'"
                    class="bg-gray-800 text-white py-2 px-4 rounded-md hover:bg-gray-700 transition duration-300">Lanjut Pesanan <i class="fa-solid fa-forward-step ml-2"></i></button>
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2  md:grid-cols-2 lg:grid-cols-3 py-3">
                {{-- Card Produk 1 --}}
                <label class="relative block cursor-pointer">
                    <input type="checkbox" class="absolute opacity-0 peer" id="product1">
                    <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-md transition-colors duration-150 peer-checked:bg-gray-300 peer-checked:border-green-500 peer-checked:border-2 peer-checked:shadow-lg w-full max-w-md mx-auto">
                        <div class="relative mb-4">
                            <img src="{{ asset('assets/images/produk.jpg') }}" alt="Sosrobahu Kopi Hitam"
                                class="w-full h-48 object-cover rounded-md border border-gray-200">
                        </div>
                        <div class="text-center">
                            <h2 class="text-lg font-bold text-gray-800">Sosrobahu Kopi Hitam</h2>
                            <p class="text-gray-600">Rp 100.000</p>
                        </div>
                    </div>
                </label>

                {{-- Card Produk 2 --}}
                <label class="relative block cursor-pointer">
                    <input type="checkbox" class="absolute opacity-0 peer" id="product2">
                    <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-md transition-colors duration-150 peer-checked:bg-gray-300 peer-checked:border-green-500 peer-checked:border-2 peer-checked:shadow-lg w-full max-w-md mx-auto">
                        <div class="relative mb-4">
                            <img src="{{ asset('assets/images/produk2.jpg') }}" alt="Sosrobahu D&H"
                                class="w-full h-48 object-cover rounded-md border border-gray-200">
                        </div>
                        <div class="text-center">
                            <h2 class="text-lg font-bold text-gray-800">Sosrobahu D&H</h2>
                            <p class="text-gray-600">Rp 200.000</p>
                        </div>
                    </div>
                </label>

                {{-- Card Produk 3 --}}
                <label class="relative block cursor-pointer">
                    <input type="checkbox" class="absolute opacity-0 peer" id="product3">
                    <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-md transition-colors duration-150 peer-checked:bg-gray-300 peer-checked:border-green-500 peer-checked:border-2 peer-checked:shadow-lg w-full max-w-md mx-auto">
                        <div class="relative mb-4">
                            <img src="{{ asset('assets/images/produk3.jpg') }}" alt="Sosrobahu Kupu Biru"
                                class="w-full h-48 object-cover rounded-md border border-gray-200">
                        </div>
                        <div class="text-center">
                            <h2 class="text-lg font-bold text-gray-800">Sosrobahu Kupu Biru</h2>
                            <p class="text-gray-600">Rp 200.000</p>
                        </div>
                    </div>
                </label>

                {{-- Card Produk 4 --}}
                <label class="relative block cursor-pointer">
                    <input type="checkbox" class="absolute opacity-0 peer" id="product4">
                    <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-md transition-colors duration-150 peer-checked:bg-gray-300 peer-checked:border-green-500 peer-checked:border-2 peer-checked:shadow-lg w-full max-w-md mx-auto">
                        <div class="relative mb-4">
                            <img src="{{ asset('assets/images/produk4.jpg') }}" alt="Sosrobahu Premium"
                                class="w-full h-48 object-cover rounded-md border border-gray-200">
                        </div>
                        <div class="text-center">
                            <h2 class="text-lg font-bold text-gray-800">Sosrobahu Premium</h2>
                            <p class="text-gray-600">Rp 300.000</p>
                        </div>
                    </div>
                </label>

                {{-- Card Produk 5 --}}
                <label class="relative block cursor-pointer">
                    <input type="checkbox" class="absolute opacity-0 peer" id="product5">
                    <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-md transition-colors duration-150 peer-checked:bg-gray-300 peer-checked:border-green-500 peer-checked:border-2 peer-checked:shadow-lg w-full max-w-md mx-auto">
                        <div class="relative mb-4">
                            <img src="{{ asset('assets/images/produk5.jpg') }}" alt="Sosrobahu Original"
                                class="w-full h-48 object-cover rounded-md border border-gray-200">
                        </div>
                        <div class="text-center">
                            <h2 class="text-lg font-bold text-gray-800">Sosrobahu Original</h2>
                            <p class="text-gray-600">Rp 100.000</p>
                        </div>
                    </div>
                </label>

                {{-- Card Produk 6 --}}
                <label class="relative block cursor-pointer">
                    <input type="checkbox" class="absolute opacity-0 peer" id="product6">
                    <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-md transition-colors duration-150 peer-checked:bg-gray-300 peer-checked:border-green-500 peer-checked:border-2 peer-checked:shadow-lg w-full max-w-md mx-auto">
                        <div class="relative mb-4">
                            <img src="{{ asset('assets/images/produk6.jpg') }}" alt="Sosrobahu Mangga Alpukat"
                                class="w-full h-48 object-cover rounded-md border border-gray-200">
                        </div>
                        <div class="text-center">
                            <h2 class="text-lg font-bold text-gray-800">Sosrobahu Mangga Alpukat</h2>
                            <p class="text-gray-600">Rp 300.000</p>
                        </div>
                    </div>
                </label>
            </div>
        </div>
    </section>
@endsection
