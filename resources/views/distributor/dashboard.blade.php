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
                    <h2 class="text-xl font-bold">185 Karton</h2>
                    <p class="text-lg">Total Stok</p>
                </div>
            </div>

            <!-- Produk Rokok Terlaris -->
            <div class="bg-yellow-400 text-white rounded-lg shadow p-4 flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-star fa-2x"></i>
                </div>
                <div class="ml-4">
                    <h2 class="text-xl font-bold">Sosrobahu Premium</h2>
                    <p class="text-lg">Produk Terlaris</p>
                </div>
            </div>

            <!-- Pendapatan Bulan Ini -->
            <div class="bg-blue-400 text-white rounded-lg shadow p-4 flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-money-bill-wave fa-2x"></i>
                </div>
                <div class="ml-4">
                    <h2 class="text-xl font-bold">Rp 15.000.000</h2>
                    <p class="text-lg">Pendapatan Bulan Ini</p>
                </div>
            </div>

            <!-- Jumlah Agen -->
            <div class="bg-orange-400 text-white rounded-lg shadow p-4 flex items-center">
                <div class="flex-shrink-0">
                    <i class="fa-solid fa-user-tie fa-2x"></i>
                </div>
                <div class="ml-4">
                    <h2 class="text-xl font-bold">25 Orang</h2>
                    <p class="text-lg">Jumlah Agen</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Stok per Produk -->
    <div class="p-6">
            <h2 class="text-2xl font-bold mb-6 text-center">Rincian Stok</h2>
            <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-6 gap-4">
                @for ($i = 1; $i <= 6; $i++)
                    <div class="bg-white border border-gray-200 rounded-lg shadow-md p-2">
                        <img src="{{ asset('assets/images/produk' . $i . '.jpg') }}"
                            alt="Sosrobahu Produk {{ $i }}" class="w-full h-40 object-cover rounded-t-lg mb-2">
                        <div class="flex flex-col">
                            <h3 class="text-md font-bold mb-0">Sosrobahu Produk {{ $i }}</h3>
                            <p class="text-gray-700 text-md">Stok: <span class="text-black font-bold">{{ rand(7, 50) }}
                                    Karton</span></p>
                        </div>
                    </div>
                @endfor
            </div>

        <!-- Grafik Penjualan-->
        <div class="container mx-auto p-4 mt-8 bg-gray-50 rounded-lg shadow overflow-x-auto">
            <!-- Dropdown untuk Pilihan Tahun -->
            <div class="mb-4">
                <label for="yearFilter" class="block text-sm font-medium text-gray-700 font-bold">Pilih Tahun:</label>
                <select id="yearFilter"
                    class="mt-1 block w-full pl-3 pr-10 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                    onchange="updateChart()">
                    <option value="2024" class="font-bold">2024</option>
                    <option value="2023" class="font-bold">2023</option>
                    <option value="2022" class="font-bold">2022</option>
                    <option value="2021" class="font-bold">2021</option>
                    <option value="2020" class="font-bold">2020</option>
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
            const ctxOmset = document.getElementById('omsetChart').getContext('2d');
            const ctxProduct = document.getElementById('productChart').getContext('2d');

            let omsetData = {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Omset (Rp)',
                    data: [12000000, 19000000, 30000000, 5000000, 20000000, 30000000, 45000000, 22000000, 28000000, 32000000, 36000000, 40000000],
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1,
                    hoverBackgroundColor: 'rgba(54, 162, 235, 0.3)',
                }]
            };

            let productData = {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Produk Terjual (Karton)',
                    data: [200, 300, 400, 150, 600, 450, 300, 500, 450, 600, 750, 900],
                    backgroundColor: 'rgba(255, 159, 64, 0.2)',
                    borderColor: 'rgba(255, 159, 64, 1)',
                    borderWidth: 1,
                    hoverBackgroundColor: 'rgba(255, 159, 64, 0.3)',
                }]
            };

            const omsetChart = new Chart(ctxOmset, {
                type: 'bar',
                data: omsetData,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function (value) {
                                    return 'Rp ' + value.toLocaleString();
                                }
                            }
                        }
                    }
                }
            });

            const productChart = new Chart(ctxProduct, {
                type: 'bar',
                data: productData,
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

            // Function untuk update chart berdasarkan tahun
            function updateChart() {
                const selectedYear = document.getElementById('yearFilter').value;
                // Fetch atau update data sesuai dengan tahun yang dipilih
                // omsetChart.data.datasets[0].data = updateOmsetData(selectedYear);
                // productChart.data.datasets[0].data = updateProductData(selectedYear);
                omsetChart.update();
                productChart.update();
            }
        </script>
@endsection
