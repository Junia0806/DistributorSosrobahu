@extends('distributor.default')

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
                <div class="font-bold text-2xl mb-1">NOTA PESANAN</div>
                <div class="text-sm">{{ $notaDistributor['tanggal'] }}</div>
                <div class="text-sm">INVO/SOSRO/00{{ $notaDistributor['id_order'] }} </div>
                <div class="text-sm font-bold">Official CV. Santoso Jaya Tembakau </div>
            </div>
        </div>
        <div class="border-b-2 border-gray-300 pb-3 mb-3">
            <h2 class="text-2xl font-bold mb-2">Pesanan Kepada:</h2>
            <div class="text-gray-700 mb-0">{{ $notaDistributor['nama_distributor'] }}</div>
            <div class="text-gray-700 mb-0">{{ $notaDistributor['no_telp'] }}</div>
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
                @if(!empty($notaDistributor['item_nota']))
                    @foreach ($notaDistributor['item_nota'] as $item)
                        <tr>
                            <td class="py-4 text-gray-700">{{ $item['nama_rokok'] }}</td>
                            <td class="py-4 text-gray-700">Rp {{ number_format($item['harga_satuan'], 0, ',', '.') }}</td>
                            <td class="py-4 text-gray-700">{{ $item['jumlah_item'] }}</td>
                            <td class="py-4 text-gray-700">Rp {{ number_format($item['jumlah_harga'], 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                @else
                    <p>Data tidak tersedia</p>
                @endif
            </tbody>
        </table>
        <div class="flex justify-end mb-8">
            <div class="text-gray-700 mr-2">Total Keseluruhan:</div>
            <div class="text-gray-700 font-bold text-xl">Rp
                {{ number_format($notaDistributor['total_harga'], 0, ',', '.') }}
            </div>
        </div>
        <div class="border-t-2 border-gray-300 pt-8 mb-8 px-6">
            <p class="text-gray-600 mb-2 text-lg font-medium text-justify">
                Terima kasih atas kepercayaan Anda kepada kami, <span class="font-semibold text-gray-800">Distributor Resmi Sosrobahu</span>.
            </p>
            <p class="text-gray-600 text-lg mb-4 text-justify">
                Untuk bantuan atau informasi lebih lanjut, silakan hubungi Admin Official <span class="font-semibold">CV. Santoso Jaya Tembakau</span> melalui WhatsApp di 
                <a href="https://wa.me/{{ $notaDistributor['no_pabrik'] }}" class="text-blue-500 hover:text-blue-700 font-semibold" target="_blank">
                    {{ $notaDistributor['no_pabrik'] }}
                </a>.
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
                filename: 'nota-pesanan.pdf',
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