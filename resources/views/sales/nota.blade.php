@extends('sales.default')

@section('content')
    <section class="bg-gray-100 py-5">
        <div class="max-w-3xl mx-auto mb-4 flex justify-end">
            <button onclick="downloadPDF()"
                class="bg-blue-600 text-white font-semibold py-2 px-4 rounded-md hover:bg-blue-700 transition duration-300">
                <i class="fa-solid fa-download"></i> Download PDF
            </button>
        </div>
        <div class="bg-nota bg-center bg-no-repeat bg-cover rounded-lg shadow-lg px-8 py-5 max-w-3xl mx-auto">
            <div class="flex items-center justify-between mb-3">
                <div class="flex items-center">
                    <img class="h-28 w-28 mr-4" src="{{ asset('assets/images/logo.png') }}" alt="Logo" />
                </div>
                <div class="text-gray-700 text-right">
                    <div class="font-bold text-2xl mb-2">NOTA PESANAN</div>
                    <div class="text-sm">01/05/2023</div>
                    <div class="text-sm">INVO/SOSRO/01 </div>
                    <div class="text-sm">Agen Enrique Lazuardi</div>
                </div>
            </div>
            <div class="border-b-2 border-gray-300 pb-3 mb-3">
                <h2 class="text-2xl font-bold mb-2">Pesanan Kepada:</h2>
                <div class="text-gray-700 mb-0">Hari Supriadi</div>
                <div class="text-gray-700 mb-0">0891-0875-8936</div>
            </div>

            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="text-left">
                        <th class="text-gray-700 font-bold uppercase py-2">Nama Produk</th>
                        <th class="text-gray-700 font-bold uppercase py-2">Harga Satuan</th>
                        <th class="text-gray-700 font-bold uppercase py-2">Jumlah</th>
                        <th class="text-gray-700 font-bold uppercase py-2">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="py-4 text-gray-700">Sosrobahu Kopi Hitam</td>
                        <td class="py-4 text-gray-700">Rp 100.000</td>
                        <td class="py-4 text-gray-700">1</td>
                        <td class="py-4 text-gray-700">Rp 100.000</td>
                    </tr>
                    <tr>
                        <td class="py-4 text-gray-700">Sosrobahu D&H</td>
                        <td class="py-4 text-gray-700">Rp 100.000</td>
                        <td class="py-4 text-gray-700">1</td>
                        <td class="py-4 text-gray-700">Rp 200.000</td>
                    </tr>
                </tbody>
            </table>
            <div class="flex justify-end mb-8">
                <div class="text-gray-700 mr-2">Total Keseluruhan:</div>
                <div class="text-gray-700 font-bold text-xl">Rp 300.000</div>
            </div>
            <div class="border-t-2 border-gray-300 pt-8 mb-8">
                <p class="text-gray-600 mb-2">Kami menghargai kepercayaan Anda dalam melakukan pembelian dengan kami.</p>
                <p class="text-gray-600">Jika Anda memiliki pertanyaan lebih lanjut, jangan ragu untuk menghubungi kami di
                    <a href="mailto:info@ecommerce.com" class="text-blue-500 underline">info@ecommerce.com</a>. Tim kami
                    selalu siap membantu Anda.
                </p>
            </div>
        </div>
    </section>
@endsection
