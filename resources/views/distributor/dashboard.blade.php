@extends('agen.default')

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
                        <i class="fa-solid fa-store fa-2x"></i>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-xl font-bold">25 Agen</h2>
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
                    <div class="bg-white border border-gray-200 rounded-lg shadow-md p-4">
                        <img src="{{ asset('assets/images/produk' . $i . '.jpg') }}"
                            alt="Sosrobahu Produk {{ $i }}" class="w-full h-40 object-cover rounded-t-lg mb-4">
                        <div class="flex flex-col items-center">
                            <h3 class="text-lg font-bold mb-2">Sosrobahu Produk {{ $i }}</h3>
                            <p class="text-gray-700 text-lg">Stok: <span class="text-black font-bold">{{ rand(7, 50) }}
                                    Karton</span></p>
                        </div>
                    </div>
                @endfor
            </div>
        </div>

        <!-- Grafik Penjualan -->
        <div class="p-6">
            <h2 class="text-2xl font-bold mb-6 text-center">Grafik Penjualan</h2>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Grafik Omset -->
                <div class="bg-white border border-gray-200 rounded-lg shadow-md p-4">
                    <h3 class="text-lg font-bold mb-4 text-center">Omset Penjualan (Rp)</h3>
                    <select id="year-filter-omset" class="mb-4 block w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5">
                        <option value="2024">2024</option>
                        <option value="2023">2023</option>
                        <option value="2022">2022</option>
                    </select>
                    <canvas id="omsetChart"></canvas>
                </div>

                <!-- Grafik Produk Terjual (Karton) -->
                <div class="bg-white border border-gray-200 rounded-lg shadow-md p-4">
                    <h3 class="text-lg font-bold mb-4 text-center">Produk Terjual (Karton)</h3>
                    <select id="year-filter-produk" class="mb-4 block w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5">
                        <option value="2024">2024</option>
                        <option value="2023">2023</option>
                        <option value="2022">2022</option>
                    </select>
                    <canvas id="produkChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctxOmset = document.getElementById('omsetChart').getContext('2d');
        const ctxProduk = document.getElementById('produkChart').getContext('2d');

        const omsetChart = new Chart(ctxOmset, {
            type: 'line',
            data: {
                labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
                datasets: [{
                    label: 'Omset (Rp)',
                    data: [12000000, 15000000, 13000000, 16000000, 17000000, 18000000, 14000000, 19000000, 20000000, 21000000, 22000000, 23000000],
                    borderColor: 'rgba(54, 162, 235, 1)',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    fill: true,
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        const produkChart = new Chart(ctxProduk, {
            type: 'bar',
            data: {
                labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
                datasets: [{
                    label: 'Produk Terjual (Karton)',
                    data: [100, 120, 110, 150, 140, 130, 160, 170, 180, 190, 200, 210],
                    backgroundColor: 'rgba(255, 159, 64, 0.2)',
                    borderColor: 'rgba(255, 159, 64, 1)',
                    borderWidth: 1,
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        document.getElementById('year-filter-omset').addEventListener('change', function() {
            // Add logic to update the chart based on the selected year
            const selectedYear = this.value;
            console.log("Selected year for Omset: ", selectedYear);
            // Update the omsetChart data here based on the selected year
        });

        document.getElementById('year-filter-produk').addEventListener('change', function() {
            // Add logic to update the chart based on the selected year
            const selectedYear = this.value;
            console.log("Selected year for Produk: ", selectedYear);
            // Update the produkChart data here based on the selected year
        });
    </script>
@endsection