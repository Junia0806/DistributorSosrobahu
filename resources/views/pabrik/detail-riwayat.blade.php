@extends('pabrik.default')

@section('content')
<section class="container mx-auto py-14 my-14">
    <div class="max-w-3xl mx-auto mb-6 flex justify-end">
        <button onclick="downloadPDF()"
            class="bg-red-600 text-white py-2 px-4 rounded hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
            <i class="fa fa-file-pdf mr-2"></i>Download PDF
        </button>
    </div>
    <div id="pdf-content" class="rounded-lg shadow-lg px-8 py-6 max-w-3xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center">
                <img class="h-20 w-30 mr-4" src="{{ asset('assets/images/logo.png') }}" alt="Logo" />
            </div>
            <div class="text-gray-700 text-right">
                <div class="font-bold text-2xl mb-1">RESTOCK PRODUK</div>
                <div class="text-sm">{{ $notaPabrik['tanggal'] }}</div>
                <div class="text-sm">RST1234{{$notaPabrik['id_restock']}}</div>
                <div class="text-sm font-semibold">Official CV. Santoso Jaya Tembakau</div>
            </div>
        </div>
        <table class="w-full border-separate border-spacing-0 mb-6 rounded-lg">
            <thead class="bg-gray-800 text-gray-300">
                <tr>
                    <th class="p-3 text-center">Nama Produk</th>
                    <th class="p-3 text-center">Jumlah (Karton)</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalJumlah = 0; // Inisialisasi total jumlah
                @endphp
                @if(!empty($notaPabrik['item_nota']))
                    @foreach ($notaPabrik['item_nota'] as $item)
                        <tr class="border-b">
                            <td class="p-3 text-center">{{ $item['nama_rokok'] }}</td>
                            <td class="p-4 text-center">{{ $item['jumlah_item'] }}</td>
                        </tr>
                        @php
                            $totalJumlah += $item['jumlah_item']; // Tambahkan jumlah ke total
                        @endphp
                    @endforeach
                @else
                    <tr>
                        <td colspan="2" class="text-center">Data tidak tersedia</td>
                    </tr>
                @endif
                <!-- Baris untuk total keseluruhan -->
                <tr class="bg-white text-lg font-semibold">
                    <td class="p-3 text-right">Total Keseluruhan</td>
                    <td class="p-3 text-center" id="total-jumlah">{{ $totalJumlah }} Karton</td>
                </tr>
            </tbody>
        </table>
        <div class="border-t-2 border-gray-300 pt-8">
            <p class="text-gray-600 mb-2">Detail riwayat restock produk ini adalah dokumen yang dicetak secara otomatis
                oleh sistem berdasarkan data yang diinput oleh perusahaan.</p>
        </div>
    </div>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
<script>
    function downloadPDF() {
        const element = document.getElementById('pdf-content'); // Select the correct element
        html2pdf()
            .from(element)
            .set({
                margin: 1,
                filename: 'bukti-restock.pdf',
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