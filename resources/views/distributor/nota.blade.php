@extends('distributor.default')

@section('content')
    <section class="bg-white py-14 my-14">
        <div class="max-w-3xl mx-auto mb-6 flex justify-end">
            <button onclick="downloadPDF()"
                class="bg-gray-800 font-bold text-white py-2 px-6 rounded-md hover:bg-gray-700 transition duration-300">
                <i class="fa-solid fa-download"></i> Download PDF
            </button>
        </div>
        <div class="bg-nota bg-center bg-no-repeat bg-cover rounded-lg shadow-lg px-8 py-6 max-w-3xl mx-auto">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center">
                    <img class="h-20 w-30 mr-4" src="{{ asset('assets/images/logo.png') }}" alt="Logo" />
                </div>
                <div class="text-gray-700 text-right">
                    <div class="font-bold text-2xl mb-1">NOTA PESANAN</div>
                    <div class="text-sm">01/08/2024</div>
                    <div class="text-sm">INVO/DIST/05</div>
                    <div class="text-sm font-semibold">Official CV. Santoso Jaya Tembakau</div>
                </div>
            </div>
            <div class="border-b-2 border-gray-300 pb-4 mb-6">
                <h2 class="text-2xl font-bold mb-2">Pesanan Kepada:</h2>
                <div class="text-gray-700">Moch. Samsul Abidin</div>
                <div class="text-gray-700">0891-0875-8936</div>
            </div>

            <table class="w-full text-left text-sm mb-6">
                <thead>
                    <tr>
                        <th class="text-gray-700 font-bold uppercase py-2">Nama Produk</th>
                        <th class="text-gray-700 font-bold uppercase py-2">Harga Satuan</th>
                        <th class="text-gray-700 font-bold uppercase py-2">Jumlah</th>
                        <th class="text-gray-700 font-bold uppercase py-2">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="py-4 text-gray-700">Sosrobahu Kopi Hitam</td>
                        <td class="py-4 text-gray-700">Rp 600.000</td>
                        <td class="py-4 text-gray-700">10</td>
                        <td class="py-4 text-gray-700">Rp 6.000.000</td>
                    </tr>
                    <tr>
                        <td class="py-4 text-gray-700">Sosrobahu D&H</td>
                        <td class="py-4 text-gray-700">Rp 800.000</td>
                        <td class="py-4 text-gray-700">3</td>
                        <td class="py-4 text-gray-700">Rp 2.400.000</td>
                    </tr>
                </tbody>
            </table>

            <div class="flex justify-end mb-8">
                <div class="text-gray-700 mr-4">Total Keseluruhan:</div>
                <div class="text-gray-700 font-bold text-xl">Rp 8.400.000</div>
            </div>
            <div class="border-t-2 border-gray-300 pt-8">
                <p class="text-gray-600 mb-2">Terima kasih atas kepercayaan Anda menjadi bagian dari jaringan distributor
                    kami.</p>
                <p class="text-gray-600">Jika Anda memerlukan bantuan atau memiliki pertanyaan terkait pesanan, jangan ragu
                    untuk menghubungi kami melalui WhatsApp di
                    <a href="https://wa.me/6289938328392" class="text-blue-500 underline"
                        target="_blank">089-9383-28392</a>. Kami siap mendukung kesuksesan Anda.
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
                    filename: 'nota-distributor.pdf',
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
