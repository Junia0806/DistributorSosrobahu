@extends('pabrik.default')

@section('content')
    <section class="bg-gray-100 py-5 my-20">
        <div class="max-w-3xl mx-auto mb-4 flex justify-end">
            <button onclick="downloadPDF()"
                class="bg-gray-800 font-bold text-white py-2 px-10 mt-2 rounded-md hover:bg-gray-700 transition duration-300">
                <i class="fa-solid fa-download"></i> Download PDF
            </button>
        </div>
        <div class="bg-nota bg-center bg-no-repeat bg-cover rounded-lg shadow-lg px-8 py-5 max-w-3xl mx-auto">
            <div class="flex items-center justify-between mb-3">
                <div class="flex items-center">
                    <img class="h-20 w-30 mr-4" src="{{ asset('assets/images/logo.png') }}" alt="Logo" />
                </div>
                <div class="text-gray-700 text-right">
                    <div class="font-bold text-2xl mb-2">DETAIL PESANAN</div>
                    <div class="text-sm">10 Agustus 2024</div>
                    <div class="text-sm">INVO/DISTRIBUTOR/001</div>
                    <div class="text-sm">Pabrik</div>
                </div>
            </div>
            <div class="border-b-2 border-gray-300 pb-3 mb-3">
                <h2 class="text-2xl font-bold mb-2">Pesanan Kepada:</h2>
                <div class="text-gray-700 mb-0">Upin Ipin</div>
                <div class="text-gray-700 mb-0">0897654321</div>
            </div>

            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="text-left">
                        <th class="text-gray-700 font-bold uppercase py-2">Nama Produk</th>
                        <th class="text-gray-700 font-bold uppercase py-2">Harga Satuan</th>
                        <th class="text-gray-700 font-bold uppercase py-2">Jumlah</th>
                        <th class="text-gray-700 font-bold uppercase py-2">Total Harga</th>
                    </tr>
                </thead>
                <tbody>
                        <tr>
                            <td class="py-4 text-gray-700">Kupu Biru Sosrobahu</td>
                            <td class="py-4 text-gray-700">Rp 1.000.000</td>
                            <td class="py-4 text-gray-700">4</td>
                            <td class="py-4 text-gray-700">Rp 4.000.000</td>
                        </tr>
                </tbody>
            </table>
            <div class="flex justify-end mb-8">
                <div class="text-gray-700 mr-2">Total Keseluruhan:</div>
                <div class="text-gray-700 font-bold text-xl">Rp 4.000.000
                </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
    <script>
        function downloadPDF() {
            const element = document.querySelector('.bg-nota');
            html2pdf()
                .from(element)
                .set({
                    margin: 1,
                    filename: 'detail-pesanan.pdf',
                    html2canvas: {
                        scale: 2,
                        background: true,
                        useCORS: true
                    },
                    jsPDF: {
                        orientation: 'portrait',
                        unit: 'in',
                        format: 'letter',
                        compressPDF: true
                    }
                })
                .save();

        }
    </script>
@endsection
