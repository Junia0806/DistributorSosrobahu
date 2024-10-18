@extends('distributor.default')

@section('content')
    <div class="w-full max-w-6xl mx-auto bg-white overflow-x-auto my-20">
        <!-- Atas -->
        <div class="p-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Total Stok -->
                <div class="bg-green-400 text-white rounded-lg shadow p-4 flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-box-open fa-2x"></i>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-xl font-bold">{{ $finalStockKarton }} Karton</h2>
                        <p class="text-lg">Total Stok</p>
                    </div>
                </div>

                <!-- Produk Rokok Terlaris -->
                <div class="bg-yellow-400 text-white rounded-lg shadow p-4 flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-star fa-2x"></i>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-xl font-bold">{{ $topProductName }}</h2>
                        <p class="text-lg">Produk Terlaris</p>
                    </div>
                </div>

                <!-- Pendapatan Bulan Ini -->
                <div class="bg-blue-400 text-white rounded-lg shadow p-4 flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-money-bill-wave fa-2x"></i>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-xl font-bold">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h2>
                        <p class="text-lg">Seluruh Pendapatan</p>
                    </div>
                </div>

                <!-- Jumlah Agen -->
                <div class="bg-orange-400 text-white rounded-lg shadow p-4 flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fa-solid fa-user-tie fa-2x"></i>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-xl font-bold">{{ $totalAgen }} Orang</h2>
                        <p class="text-lg">Jumlah Agen</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stok per Produk -->
        <div class="p-6">
            <h2 class="text-2xl font-bold mb-6 text-center">Rincian Stok</h2>
            <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-6 gap-4">
                @foreach ($barangDistributors as $index => $barang)
                    <div
                        class="bg-white p-3 rounded-lg border border-gray-200 shadow-md transition-colors duration-150 peer-checked:bg-gray-300 peer-checked:border-green-500 peer-checked:border-2 peer-checked:shadow-lg w-full max-w-[180px] mx-auto">
                        <div class="relative mb-2">
                            <img src="{{ asset('storage/produk/' . $gambarRokokList[$index]) }}"
                                alt="{{ $barang->nama_rokok }}"
                                class="w-full h-[200px] object-cover rounded-md border border-gray-200">
                        </div>
                        <div class="text-center">
                            <h2 class="text-sm font-bold text-gray-800">{{ $namaRokokList[$index] }}</h2>
                            <p class="text-gray-700 text-md">Stok: <span
                                    class="text-black font-bold">{{ $totalProdukList[$index] }} Karton</span></p>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Grafik Penjualan -->
            <div class="container mx-auto p-4 mt-8 bg-gray-50 rounded-lg shadow overflow-x-auto">
                <!-- Dropdown untuk Pilihan Tahun -->
                <div class="mb-4">
                    <label for="yearFilter" class="block text-sm font-medium text-gray-700 ">Pilih Tahun:</label>
                    <select id="yearFilter"
                        class="mt-1 block w-full pl-3 pr-10 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                        onchange="updateChart()">
                        @foreach ($availableYears as $year)
                            <option value="{{ $year }}" class="font-bold">{{ $year }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Grafik Omset -->
                <div class="mb-8">
                    <h2 class="text-xl font-bold mb-2 text-center">Grafik Omset per Bulan</h2>
                    <div class="relative">
                        <canvas id="omsetChart" class="w-full h-64 bg-white rounded-lg shadow-lg p-4"></canvas>
                    </div>
                </div>

                <!-- Grafik Produk Terjual (Karton) -->
                <div>
                    <h2 class="text-xl font-bold mb-2 text-center">Grafik Produk Terjual (Karton) per Bulan</h2>
                    <div class="relative">
                        <canvas id="productChart" class="w-full h-64 bg-white rounded-lg shadow-lg p-4"></canvas>
                    </div>
                </div>
            </div>

            <!-- Chart.js Script -->
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                // Tetapkan label bulan dalam bahasa Indonesia
                let monthLabels = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September',
                    'Oktober', 'November', 'Desember'
                ];

                // Ambil data dari controller (pesanan per bulan)
                let pesananPerBulan = @json($pesananPerBulan);

                // Fungsi untuk mendapatkan data berdasarkan tahun yang dipilih
                function getDataByYear(selectedYear) {
                    let omsetDataValues = [];
                    let productDataValues = [];

                    monthLabels.forEach((month, index) => {
                        let formattedMonth = `${selectedYear}-${String(index + 1).padStart(2, '0')}`;
                        if (pesananPerBulan[formattedMonth]) {
                            omsetDataValues.push(pesananPerBulan[formattedMonth].total_omset);
                            productDataValues.push(pesananPerBulan[formattedMonth].total_karton);
                        } else {
                            omsetDataValues.push(0); // Jika tidak ada data untuk bulan ini, omset 0
                            productDataValues.push(0); // Jika tidak ada data untuk bulan ini, produk terjual 0
                        }
                    });

                    return {
                        omsetDataValues,
                        productDataValues
                    };
                }

                // Inisialisasi data chart pertama kali
                let selectedYear = document.getElementById('yearFilter').value;
                let initialData = getDataByYear(selectedYear);

                const ctxOmset = document.getElementById('omsetChart').getContext('2d');
                const ctxProduct = document.getElementById('productChart').getContext('2d');

                let omsetChart = new Chart(ctxOmset, {
                    type: 'bar',
                    data: {
                        labels: monthLabels, // Gunakan monthLabels sebagai label tetap
                        datasets: [{
                            label: 'Omset (Rp)',
                            data: initialData.omsetDataValues, // Data omset sesuai bulan
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1,
                            hoverBackgroundColor: 'rgba(54, 162, 235, 0.3)',
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function(value) {
                                        return 'Rp ' + value.toLocaleString();
                                    }
                                }
                            }
                        }
                    }
                });

                let productChart = new Chart(ctxProduct, {
                    type: 'bar',
                    data: {
                        labels: monthLabels, // Gunakan monthLabels sebagai label tetap
                        datasets: [{
                            label: 'Produk Terjual (Karton)',
                            data: initialData.productDataValues, // Data produk terjual sesuai bulan
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1,
                            hoverBackgroundColor: 'rgba(75, 192, 192, 0.3)',
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });

                // Update chart saat dropdown berubah
                function updateChart() {
                    selectedYear = document.getElementById('yearFilter').value;
                    let newData = getDataByYear(selectedYear);

                    // Update chart omset
                    omsetChart.data.datasets[0].data = newData.omsetDataValues;
                    omsetChart.update();

                    // Update chart produk terjual
                    productChart.data.datasets[0].data = newData.productDataValues;
                    productChart.update();
                }
            </script>
        </div>
    </div>
@endsection
