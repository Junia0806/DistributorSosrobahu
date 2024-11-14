@extends('agen.default')

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
                    Pilih produk sosrobahu terbaru untuk dikelola dan dijual kepada Sales, kemudian sesuaikan harganya.
                </p>
            </div>


            <!-- Form Pilih Produk -->
            <form action="" method="POST">
                @csrf
                <div class="grid grid-cols-2 gap-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 py-3">
                    @for ($i = 1; $i <= 6; $i++)
                        <label class="relative block cursor-pointer transition-all duration-300">
                            <input type="checkbox" class="absolute opacity-0 peer" name="products[]"
                                value="product{{ $i }}">
                            <div
                                class="bg-white p-3 rounded-lg border border-gray-200 shadow-md transition-colors duration-150 peer-checked:bg-gray-300 peer-checked:border-green-500 peer-checked:border-2 peer-checked:shadow-lg w-full max-w-[180px] mx-auto">
                                <div class="relative mb-2">
                                    <img src="{{ asset('assets/images/produk' . $i . '.jpg') }}"
                                        alt="Produk {{ $i }}"
                                        class="w-full h-[200px] object-cover rounded-md border border-gray-200">
                                </div>
                                <div class="text-center">
                                    <h3 class="text-lg font-semibold text-gray-800">Produk Baru {{ $i }}</h3>
                                </div>
                            </div>
                        </label>
                    @endfor
                </div>

                <!-- Tombol Tambahkan Produk -->
                <div class="sticky bottom-0 bg-white w-full flex justify-center p-6">
                    <a href="{{ route('pengaturanHarga') }}"
                        class="bg-gray-800 text-white font-semibold py-3 px-8 rounded-md hover:bg-gray-700 transition duration-300 w-2/3 lg:w-1/4 text-center flex justify-center items-center">
                        <i class="fa-solid fa-plus mr-2"></i> Tambahkan Produk
                    </a>
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
