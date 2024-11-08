@extends('pabrik.default')
@section('content')
    <div class="w-full max-w-6xl mx-auto bg-white rounded-lg shadow-lg overflow-x-auto my-20">
        <div class="flex items-center justify-between p-6 border-b">
            <div class="flex-1 text-center">
                <h1 class="text-2xl font-bold text-black">Daftar Akun Distributor</h1>
            </div>
            <button data-modal-target="tambah-modal" data-modal-toggle="tambah-modal"
                class="bg-gray-800 text-white py-2 px-4 rounded-md hover:bg-gray-700 transition duration-300" type="button">
                <i class="fa-regular fa-square-plus"></i> Tambah Akun
            </button>
        </div>
        <div class="overflow-x-auto">
            <div class="my-4 flex justify-center">
                <form method="GET" class="flex w-full max-w-xl">
                    <input type="text" name="search" id="searchInput" placeholder="Cari Berdasarkan Nama atau Username"
                        class="border border-gray-300 p-2 rounded-lg mx-2 w-full pl-10 placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 ease-in-out"
                        value="{{ request()->query('search') }}">
                    <button type="submit"
                        class="bg-blue-500 text-white p-2 rounded-lg hover:bg-blue-600 transition duration-200 ease-in-out">
                        Cari
                    </button>
                </form>
            </div>

            <!-- Tabel Toko -->
            <table class="w-full border-separate border-spacing-0 text-sm text-black">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="p-2 text-left">No</th>
                        <th class="p-2 text-left">Nama Lengkap</th>
                        <th class="p-2 text-left">Username</th>
                        <th class="p-2 text-left">Status</th>
                        <th class="p-2 text-left">No Telpon</th>
                        <th class="p-2 text-left">KTP</th>
                        <th class="p-2 text-left">Penjualan</th>
                        <th class="p-2 text-left">Bank</th>
                        <th class="p-2 text-left">Rekening</th>
                        <th class="p-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @php
                        $startIndex = $akunDistributor->perPage() * ($akunDistributor->currentPage() - 1) + 1;
                    @endphp
                    @if ($akunDistributor->isEmpty())
                        <tr>
                            <td colspan="10" class="p-2">
                                <div class="flex flex-col items-center justify-center py-4">
                                    <i class="fa-solid fa-triangle-exclamation text-4xl text-red-500"></i>
                                    <p class="text-lg text-gray-700 font-semibold">Distributor tidak ditemukan</p>
                                    <p class="text-gray-500">Nama maupun username distributor yang anda cari tidak ada.</p>
                                </div>
                            </td>
                        </tr>
                    @else
                        @foreach ($akunDistributor as $index => $akunDistributors)
                            <tr class="border-b border-gray-200">
                                <td class="p-2">{{ $startIndex + $index }}</td>
                                <td class="p-2">{{ $akunDistributors['nama_lengkap'] }}</td>
                                <td class="p-2">{{ $akunDistributors['username'] }}</td>
                                <td class="p-2">{{ $akunDistributors['status'] == 1 ? 'Aktif' : 'Tidak Aktif' }}</td>
                                <td class="p-2">{{ $akunDistributors['no_telp'] }}</td>
                                <td class="p-2">
                                    <button type="button"
                                        data-modal-target="ktp-modal-{{ $akunDistributors['id_user_distributor'] }}"
                                        data-modal-toggle="ktp-modal-{{ $akunDistributors['id_user_distributor'] }}"
                                        class="bg-green-600 text-white font-bold py-1 px-3 rounded hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 text-xs">Lihat</button>
                                </td>
                                <td class="p-2 font-semibold">
                                    Rp.{{ number_format($totalPricePerAgens[$akunDistributors['id_user_distributor']] ?? 0, 0, ',', '.') }}
                                </td>
                                <td class="p-2">{{ $akunDistributors['nama_bank'] }}</td>
                                <td class="p-2">{{ $akunDistributors['no_rek'] }}</td>
                                <td class="p-2">
                                    <div class="flex justify-center space-x-2">
                                        <button type="button"
                                            data-modal-target="edit-akun-modal-{{ $akunDistributors->id_user_distributor }}"
                                            data-modal-toggle="edit-akun-modal-{{ $akunDistributors->id_user_distributor }}"
                                            class="inline-flex items-center justify-center w-8 h-8 text-gray-800 bg-gray-200 border border-gray-300 rounded-sm shadow-sm hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500">
                                            <i class="fa-regular fa-pen-to-square text-md"></i>
                                        </button>
                                        <form id="delete-form-{{ $akunDistributors->id_user_distributor }}"
                                            action="{{ route('pengaturanDistributor.delete', $akunDistributors->id_user_distributor) }}"
                                            method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"
                                                class="inline-flex items-center justify-center w-8 h-8 text-white bg-red-700 border border-red-600 rounded shadow-sm hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 ml-1"
                                                onclick="confirmDelete('{{ $akunDistributors->id_user_distributor }}', '{{ $akunDistributors->nama_lengkap }}')">
                                                <i class="fa-regular fa-trash-can text-md"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            <!-- Modal Lihat KTP -->
                            <div id="ktp-modal-{{ $akunDistributors['id_user_distributor'] }}" tabindex="-1"
                                aria-hidden="true"
                                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-md max-h-full">
                                    <div class="relative bg-white rounded-lg shadow">
                                        <div class="flex items-center justify-between p-4 border-b border-gray-600">
                                            <h3 class="text-lg font-semibold text-black">KTP
                                                {{ $akunDistributors['nama_lengkap'] }}
                                            </h3>
                                            <button type="button"
                                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center"
                                                data-modal-toggle="ktp-modal-{{ $akunDistributors['id_user_distributor'] }}">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <div class="p-4">
                                            <img src="{{ asset('storage/ktp/' . $akunDistributors['gambar_ktp']) }}"
                                                alt="KTP {{ $akunDistributors['nama_lengkap'] }}"
                                                class="w-full rounded-lg">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal Edit Akun Distributor-->
                            <div id="edit-akun-modal-{{ $akunDistributors['id_user_distributor'] }}" tabindex="-1" aria-hidden="true"
                                class="hidden fixed top-0 left-0 right-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto h-modal">
                                <div class="relative w-full max-w-full md:max-w-md h-full max-h-full md:h-auto">
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <div class="flex items-center justify-between p-4 border-b border-gray-200">
                                            <h3 class="text-xl font-semibold text-gray-700">Edit Akun
                                                {{ $akunDistributors->username }}</h3>
                                            <button type="button"
                                                class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:text-gray-500 dark:hover:bg-gray-600 dark:hover:text-white"
                                                data-modal-hide="edit-akun-modal-{{ $akunDistributors->id_user_distributor }}">
                                                <svg aria-hidden="true" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <div class="p-6">
                                            <form action="{{ route('pengaturanDistributor.update', $akunDistributors->id_user_distributor) }}"
                                                id="edit-akun-form" method="POST" enctype="multipart/form-data" class="space-y-4">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="page" value="{{ request()->input('page', 1) }}">
                                                <div class="grid grid-cols-2 gap-2">
                                                    <div class="text-left">
                                                        <label for="edit-name" class="block mb-2 text-sm font-semibold text-gray-600">Nama</label>
                                                        <input type="text" value="{{ $akunDistributors->nama_lengkap }}" name="nama_lengkap" id="nama_lengkap"
                                                            class="mb-4 bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                                            required>
                                                    </div>

                                                    <div class="text-left">
                                                        <label for="edit-username" class="block mb-2 text-sm font-semibold text-gray-600">Username</label>
                                                        <input type="text" value="{{ $akunDistributors->username }}" name="username" id="username"
                                                            class="mb-4 bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="grid grid-cols-2 gap-2">
                                                    <div class="text-left">
                                                        <label for="edit-password" class="block mb-2 text-sm font-semibold text-gray-600">Password</label>
                                                        <input type="password" placeholder="Masukkan Password Baru Anda" name="password" id="password-edit"
                                                            class="mb-4 bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                                    </div>
                                                    <div class="text-left">
                                                        <label for="edit-phone" class="block mb-2 text-sm font-semibold text-gray-600">No. Telepon</label>
                                                        <input type="tel" value="{{ $akunDistributors->no_telp }}" name="no_telp" id="no_telp"
                                                            class="mb-4 bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="grid grid-cols-2 gap-4">
                                                    <div class="text-left">
                                                        <label for="edit-status" class="block mb-2 text-sm font-semibold text-gray-600">Status</label>
                                                        <select name="status" id="edit-status"
                                                            class="mb-4 bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                                            <option value="1" {{ $akunDistributors->status == 1 ? 'selected' : '' }}>Aktif</option>
                                                            <option value="0" {{ $akunDistributors->status == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                                                        </select>
                                                    </div>
                                                    <div class="text-left">
                                                        <label for="edit-avatar" class="block mb-2 text-sm font-medium text-gray-90">KTP</label>
                                                        <input class="block mb-2 w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50"
                                                            aria-describedby="edit-avatar_help" name="gambar_ktp" id="gambar_ktp-{{ $akunDistributors['id_user_distributor'] }}"
                                                            type="file" accept=".jpg, .jpeg, .png" />
                                                        <p id="file-error-gambar_ktp-{{ $akunDistributors['id_user_distributor'] }}" class="text-red-500 text-sm mt-1 hidden">Ukuran file maksimum adalah 1 MB.</p>
                                                        <p id="ktp-file-name-{{ $akunDistributors['id_user_distributor'] }}" class="text-sm text-gray-500">
                                                            File saat ini: {{ $akunDistributors['gambar_ktp'] ? $akunDistributors['gambar_ktp'] : 'Tidak ada file saat ini.' }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-span-2 text-center">
                                                    <button type="submit"
                                                        class="inline-flex items-center bg-gray-800 text-white py-2 px-4 rounded-md hover:bg-gray-700 transition duration-300 mt-3">
                                                        Simpan Perubahan
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <!-- Modal Tambah Akun-->
        {{-- <div id="tambah-modal" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow">
                    <div class="flex items-center justify-between p-4 border-b border-gray-600">
                        <h3 class="text-lg font-semibold text-black">Tambah Akun</h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center"
                            data-modal-toggle="tambah-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <form action="{{ route('pengaturanDistributor.input') }}" method="POST"
                        enctype="multipart/form-data" class="p-2 space-y-4">
                        @csrf
                        <div>
                            <label for="nama_lengkap" class="block mb-2 text-sm font-medium text-black">Nama
                                Lengkap</label>
                            <input type="text" name="nama_lengkap" id="nama_lengkap"
                                placeholder="Masukkan nama lengkap"
                                class="w-full bg-gray-50 border border-gray-300 text-black text-sm rounded-lg p-2.5"
                                required>
                        </div>
                        <div>
                            <label for="username" class="block mb-2 text-sm font-medium text-black">Username</label>
                            <input type="text" name="username" id="username" placeholder="Masukkan username"
                                class="w-full bg-gray-50 border border-gray-300 text-black text-sm rounded-lg p-2.5"
                                required>
                            <!-- Pesan error username ditampilkan di sini -->
                            @if ($errors->has('username'))
                                <span class="text-danger">{{ $errors->first('username') }}</span>
                            @endif
                        </div>
                        <div class="relative">
                            <label for="password" class="block mb-2 text-sm font-medium text-black">Password</label>
                            <input type="password" id="password-add" name="password" placeholder="Masukkan Password"
                                class="w-full p-3 text-sm bg-gray-100 border border-gray-300 rounded-lg focus:ring-gray-500 focus:border-gray-500"
                                required />
                            <span id="togglePassword"
                                class="text-gray-500 absolute inset-y-0 right-0 flex items-center pr-3 pt-6 cursor-pointer"
                                onclick="togglePassword()">
                                <i class="fa-solid fa-eye-slash"></i>
                            </span>
                        </div>
                        <div>
                            <label for="no_telp" class="block mb-2 text-sm font-medium text-black">No. Telepon</label>
                            <input type="tel" name="no_telp" id="no_telp" placeholder="08xxxxxxxxxx"
                                class="w-full bg-gray-50 border border-gray-300 text-black text-sm rounded-lg p-2.5"
                                required>
                        </div>
                        <div>
                            <label for="nama_bank" class="block mb-2 text-sm font-medium text-black">Bank</label>
                            <input type="text" name="nama_bank" id="nama_bank" placeholder="Masukkan nama Bank"
                                class="w-full bg-gray-50 border border-gray-300 text-black text-sm rounded-lg p-2.5"
                                required>
                        </div>
                        <div>
                            <label for="no_rek" class="block mb-2 text-sm font-medium text-black">No. Rekening</label>
                            <input type="text" name="no_rek" id="no_rek" placeholder="Masukkan nomor rekening"
                                class="w-full bg-gray-50 border border-gray-300 text-black text-sm rounded-lg p-2.5"
                                required>
                        </div>
                        <div>
                            <label for="gambar_ktp" class="block mb-2 text-sm font-medium text-black">KTP</label>
                            <input type="file" id="gambar_ktp" name="gambar_ktp"
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50"
                                accept=".jpg, .jpeg, .png" required />
                        </div>
                        <div class="flex justify-center">
                            <button type="submit"
                                class="bg-gray-800 text-white py-2 px-4 rounded-md hover:bg-gray-700 transition duration-300">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>

        </div> --}}
        <!-- Modal Tambah Akun Distributor --> 
        <div id="tambah-modal" tabindex="-1" aria-hidden="true"
            class="@if ($errors->has('username')) flex @else hidden @endif overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow-lg">
                    <div class="flex items-center justify-between p-4 border-b border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-700">Tambah Akun</h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center"
                            data-modal-toggle="tambah-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <form action="{{ route('pengaturanDistributor.input') }}" method="POST" enctype="multipart/form-data"
                        class="p-4 space-y-1">
                        @csrf
                        <div class="grid grid-cols-2 gap-2">
                            <div>
                                <label for="nama_lengkap" class="block mb-1 text-sm font-semibold text-gray-600">Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" id="nama_lengkap" placeholder="Nama lengkap"
                                    class="w-full bg-gray-50 border border-gray-300 text-gray-800 text-sm rounded-lg py-1.5 px-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out"
                                    value="{{ old('nama_lengkap') }}" required>
                            </div>
                            <div>
                                <label for="username" class="block mb-1 text-sm font-semibold text-gray-600">Username</label>
                                @if ($errors->has('username'))
                                    <span class="text-sm text-red-500">Username telah digunakan</span>
                                @endif
                        <input type="text" name="username" id="username" placeholder="Username"
                                    class="w-full bg-gray-50 border border-gray-300 text-gray-800 text-sm rounded-lg py-1.5 px-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out"
                                    value="{{ old('username') }}" required>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-2">
                            <div class="relative">
                                <label for="password-add" class="block mb-2 text-sm font-semibold text-gray-600">Password</label>
                                <input type="password" id="password-add" name="password" placeholder="Password"
                                    class="w-full bg-gray-50 border border-gray-300 text-gray-800 text-sm rounded-lg py-1.5 px-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out"
                                    required />
                                <span id="togglePasswordAdd"
                                    class="text-gray-500 absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer mt-6"
                                    onclick="togglePassword('password-add', 'togglePasswordAdd')">
                                    <i class="fa-solid fa-eye-slash"></i>
                                </span>
                            </div>
                            <div>
                                <label for="no_telp" class="block mb-2 text-sm font-semibold text-gray-600">No. Telepon</label>
                                <input type="tel" name="no_telp" id="no_telp" placeholder="08xxxxxxxxxx"
                                    class="w-full bg-gray-50 border border-gray-300 text-gray-800 text-sm rounded-lg py-1.5 px-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out"
                                    value="{{ old('no_telp') }}" required>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-2">
                            <div>
                                <label for="nama_bank" class="block mb-2 text-sm font-semibold text-gray-600">Bank</label>
                                <input type="text" name="nama_bank" id="nama_bank" placeholder="Nama Bank"
                                    class="w-full bg-gray-50 border border-gray-300 text-gray-800 text-sm rounded-lg py-1.5 px-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out"
                                    value="{{ old('nama_bank') }}" required>
                            </div>
                            <div>
                                <label for="no_rek" class="block mb-2 text-sm font-semibold text-gray-600">No. Rekening</label>
                                <input type="text" name="no_rek" id="no_rek" placeholder="Nomor rekening"
                                    class="w-full bg-gray-50 border border-gray-300 text-gray-800 text-sm rounded-lg py-1.5 px-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out"
                                    value="{{ old('no_rek') }}" required>
                            </div>
                        </div>
                        <div>
                            <label for="gambar_ktp" class="block mb-2 text-sm font-semibold text-gray-600">KTP</label>
                            <input type="file" id="gambar_ktp" name="gambar_ktp"
                                class="block w-full mb-2 text-xs text-gray-600 border border-gray-300 rounded-lg cursor-pointer bg-gray-50"
                                accept=".jpg, .jpeg, .png" required />
                            <span id="file-error-gambar_ktp" class="text-red-500 text-xs mt-1 hidden">Ukuran file maksimum adalah 1 MB.</span>
                        </div>
                        <div class="flex justify-center">
                            <button type="submit"
                                class="bg-gray-800 text-white py-2 px-4 rounded-md hover:bg-gray-700 transition duration-300">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom Pagination -->
    @if ($akunDistributor->total() > 10)
        <div class="flex flex-col items-center my-6">
            <!-- Help text -->
            <span class="text-sm text-gray-700 dark:text-gray-400">
                Menampilkan <span
                    class="font-semibold text-gray-900 dark:text-white">{{ $akunDistributor->firstItem() }}</span>
                sampai
                <span class="font-semibold text-gray-900 dark:text-white">{{ $akunDistributor->lastItem() }}</span>
                dari
                <span class="font-semibold text-gray-900 dark:text-white">{{ $akunDistributor->total() }}</span> distributor
            </span>
            <!-- Buttons -->
            <div class="inline-flex mt-2 xs:mt-0">
                <!-- Previous Button -->
                <button {{ $akunDistributor->onFirstPage() ? 'disabled' : '' }}
                    class="flex items-center justify-center px-3 h-8 text-sm font-medium text-white bg-gray-800 rounded-s hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                    {{ $akunDistributor->previousPageUrl() ? 'onclick=window.location.href=\'' . $akunDistributor->previousPageUrl() . '\'' : '' }}>
                    Sebelumnya
                </button>
                <!-- Next Button -->
                <button {{ !$akunDistributor->hasMorePages() ? 'disabled' : '' }}
                    class="flex items-center justify-center px-3 h-8 text-sm font-medium text-white bg-gray-800 border-0 border-s border-gray-700 rounded-e hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                    {{ $akunDistributor->nextPageUrl() ? 'onclick=window.location.href=\'' . $akunDistributor->nextPageUrl() . '\'' : '' }}>
                    Selanjutnya
                </button>
            </div>
        </div>
    @endif
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Mengosongkan input pencarian dan menghapus query string saat halaman dimuat
        document.addEventListener("DOMContentLoaded", function() {
            const searchInput = document.getElementById("searchInput");

            // Menghapus semua query parameter saat halaman di-reload
            if (performance.navigation.type === 1) { // Cek apakah halaman di-reload
                const url = new URL(window.location);
                url.search = ''; // Hapus semua parameter dari URL
                window.history.replaceState({}, document.title, url); // Perbarui URL
            }
        });
        // Event listener untuk membuka modal
        document.querySelectorAll('[data-modal-target]').forEach(button => {
            button.addEventListener('click', () => {
                const modalId = button.getAttribute('data-modal-target');
                document.querySelector(modalId).classList.remove('hidden');
            });
        });

        function togglePassword(inputId, toggleId) {
            const passwordInput = document.getElementById(inputId);
            const toggleIcon = document.getElementById(toggleId).querySelector('i');
    
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            }
        }

        // Event listener untuk menutup modal
        document.querySelectorAll('[data-modal-hide]').forEach(button => {
            button.addEventListener('click', () => {
                const modalId = button.getAttribute('data-modal-hide');
                document.querySelector(modalId).classList.add('hidden');
            });
        });

        // Event listener untuk menampilkan peringatan jika ada error username
        document.addEventListener('DOMContentLoaded', function() {
            @if ($errors->has('username'))
                const modal = document.getElementById('tambah-modal');
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                const usernameInput = document.getElementById('username');
                const errorMessage = document.createElement('span');
                errorMessage.classList.add('text-danger'); 
                errorMessage.textContent = '{{ $errors->first('username') }}';
                usernameInput.parentNode.insertBefore(errorMessage, usernameInput.nextSibling);
            @endif
        });

        // Fungsi untuk konfirmasi penghapusan akun
        function confirmDelete(id, namaUser) {
            Swal.fire({
                title: 'Anda yakin?',
                text: `Anda akan menghapus akun ${namaUser} secara permanen.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function () {
        // Menangani perubahan pada setiap input file
        document.querySelectorAll('input[type="file"]').forEach(input => {
            input.addEventListener('change', function () {
                const file = this.files[0];
                const fileErrorId = 'file-error-' + this.id;
                const fileError = document.getElementById(fileErrorId);

                if (file && file.size > 1048576) { // 1 MB in bytes
                    fileError.style.display = 'block';
                    this.value = ''; // Reset input jika ukuran file lebih dari 1 MB
                    this.classList.add('border-red-500'); // Menambahkan kelas untuk memberi border merah
                } else {
                    this.classList.remove('border-red-500'); // Menghapus border merah jika file valid
                    fileError.style.display = 'none'; // Menyembunyikan pesan kesalahan
                }
            });
        });

        // Menangani pengiriman formulir
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function (event) {
                const fileInputs = this.querySelectorAll('input[type="file"]'); // Mengambil semua input file
                let hasError = false; // Flag untuk mendeteksi error

                fileInputs.forEach(fileInput => {
                    const fileErrorId = 'file-error-' + fileInput.id;
                    const fileError = document.getElementById(fileErrorId);

                    // Memeriksa apakah ada error
                    if (fileError.style.display === 'block' || fileInput.value === '') {
                        hasError = true;
                        fileError.style.display = 'block'; // Menampilkan pesan kesalahan
                    }
                });

                if (hasError) {
                    event.preventDefault(); // Mencegah pengiriman formulir jika ada error
                }
            });
        });
    });
    </script>
@endsection
