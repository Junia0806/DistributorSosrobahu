@extends('distributor.default')
@section('content')
<div class="w-full max-w-7xl mx-auto bg-white rounded-lg shadow-lg overflow-x-auto my-20">
    <div class="flex items-center justify-between p-6 border-b">
        <div class="flex-1 text-center">
            <h1 class="text-2xl font-bold text-black">Daftar Akun Agen</h1>
        </div>
        <button data-modal-target="tambah-modal" data-modal-toggle="tambah-modal"
            class="bg-gray-800 text-white py-2 px-4 rounded-md hover:bg-gray-700 transition duration-300" type="button">
            <i class="fa-regular fa-square-plus"></i> Tambah Akun
        </button>
    </div>
    <div class="overflow-x-auto">
        <div class="my-4 flex justify-center">
            <form action="{{ route('pengaturanAgen') }}" method="GET" class="flex w-full max-w-xl">
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
                    <th class="p-2 text-left">Alamat</th>
                    <th class="p-2 text-left">Provinsi</th>
                    <th class="p-2 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @php
                    $startIndex = $akunAgen->perPage() * ($akunAgen->currentPage() - 1) + 1;
                @endphp
                @if ($akunAgen->isEmpty())
                    <tr>
                        <td colspan="10" class="p-2">
                            <p class="text-center text-red-500">Nama maupun username agen yang anda cari tidak ada.</p>
                        </td>
                    </tr>
                @else
                        @foreach ($akunAgen as $index => $akunAgens)
                            <tr class="border-b border-gray-200">
                                <td class="p-2">{{ $startIndex + $index }}</td>
                                <td class="p-2">{{ $akunAgens['nama_lengkap'] }}</td>
                                <td class="p-2">{{ $akunAgens['username'] }}</td>
                                <td class="p-2">{{ $akunAgens['status'] == 1 ? 'Aktif' : 'Tidak Aktif' }}</td>
                                <td class="p-2">{{ $akunAgens['no_telp'] }}</td>
                                <td class="p-2">
                                    <button type="button" data-modal-target="ktp-modal-{{ $akunAgens['id_user_agen'] }}"
                                        data-modal-toggle="ktp-modal-{{ $akunAgens['id_user_agen'] }}"
                                        class="bg-green-600 text-white font-bold py-1 px-3 rounded hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 text-xs">Lihat</button>
                                </td>
                                <td class="p-2 font-semibold">
                                    Rp.{{ number_format($totalPricePerAgens[$akunAgens['id_user_agen']] ?? 0, 0, ',', '.') }}
                                </td>
                                <td class="p-2">{{ $akunAgens['nama_bank'] }}</td> <!-- Kolom Nama Bank -->
                                <td class="p-2">{{ $akunAgens['no_rek'] }}</td> <!-- Kolom No Rekening -->
                                <td class="p-2">{{ $akunAgens['alamat'] }}</td> <!-- Kolom Alamat -->
                                <td class="p-2">{{ $akunAgens['provinsi'] }}</td> <!-- Kolom Provinsi -->
                                <td class="p-2">
                                    <div class="flex justify-center space-x-2">
                                        <button type="button" data-modal-target="edit-akun-modal-{{ $akunAgens->id_user_agen }}"
                                            data-modal-toggle="edit-akun-modal-{{ $akunAgens->id_user_agen }}"
                                            class="inline-flex items-center justify-center w-8 h-8 text-gray-800 bg-gray-200 border border-gray-300 rounded-sm shadow-sm hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500">
                                            <i class="fa-regular fa-pen-to-square text-md"></i>
                                        </button>
                                        <form id="delete-form-{{ $akunAgens->id_user_agen }}"
                                            action="{{ route('pengaturanAgen.delete', $akunAgens->id_user_agen) }}" method="POST"
                                            class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"
                                                class="inline-flex items-center justify-center w-8 h-8 text-white bg-red-700 border border-red-600 rounded shadow-sm hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 ml-1"
                                                onclick="confirmDelete('{{ $akunAgens->id_user_agen }}', '{{ $akunAgens->nama_lengkap }}')">
                                                <i class="fa-regular fa-trash-can text-md"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            <!-- Modal Lihat KTP -->
                            <div id="ktp-modal-{{ $akunAgens['id_user_agen'] }}" tabindex="-1" aria-hidden="true"
                                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-md max-h-full">
                                    <div class="relative bg-white rounded-lg shadow">
                                        <div class="flex items-center justify-between p-4 border-b border-gray-600">
                                            <h3 class="text-lg font-semibold text-black">KTP
                                                {{ $akunAgens['nama_lengkap'] }}
                                            </h3>
                                            <button type="button"
                                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center"
                                                data-modal-toggle="ktp-modal-{{ $akunAgens['id_user_agen'] }}">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <div class="p-4">
                                            <img src="{{ asset('storage/ktp/' . $akunAgens['gambar_ktp']) }}"
                                                alt="KTP {{ $akunAgens['nama_lengkap'] }}" class="w-full rounded-lg">
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- Modal Edit Akun -->
                            <div id="edit-akun-modal-{{ $akunAgens['id_user_agen'] }}" tabindex="-1" aria-hidden="true"
                                class="hidden fixed top-0 left-0 right-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto h-modal">
                                <div class="relative w-full max-w-full md:max-w-md h-full max-h-full md:h-auto">
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <div class="flex items-center justify-between p-4 border-b border-gray-200">
                                            <h3 class="text-xl font-semibold text-gray-700">Edit Akun
                                                {{ $akunAgens->username }}
                                            </h3>
                                            <button type="button"
                                                class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:text-gray-500 dark:hover:bg-gray-600 dark:hover:text-white"
                                                data-modal-hide="edit-akun-modal-{{ $akunAgens->id_user_agen }}">
                                                <svg aria-hidden="true" class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <div class="p-6 ">
                                            <form action="{{ route('pengaturanAgen.update', $akunAgens->id_user_agen) }}"
                                                id="edit-akun-form" method="POST" enctype="multipart/form-data" class="space-y-4">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="page" value="{{ request()->input('page', 1) }}">

                                                <div class="grid grid-cols-2 gap-2">
                                                    <div class="text-left">
                                                        <label for="edit-name"
                                                            class="block mb-2 text-sm font-semibold text-gray-600">Nama</label>
                                                        <input type="text" value="{{ $akunAgens->nama_lengkap }}"
                                                            name="nama_lengkap" id="nama_lengkap"
                                                            class="mb-4 bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                                            required>
                                                    </div>

                                                    <div class="text-left">
                                                        <label for="edit-username"
                                                            class="block mb-2 text-sm font-semibold text-gray-600">Username</label>
                                                        <input type="text" value="{{ $akunAgens->username }}" name="username"
                                                            id="username"
                                                            class="mb-4 bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                                            required>
                                                    </div>
                                                </div>

                                                <div class="grid grid-cols-2 gap-2">
                                                    <div class="relative text-left">
                                                        <label for="edit-password"
                                                            class="block mb-2 text-sm font-semibold text-gray-600">Password</label>
                                                        <input type="password" id="password-edit-{{ $akunAgens['id_user_agen'] }}"
                                                            name="password" placeholder="Password Baru Anda"
                                                            class="mb-4 w-full bg-gray-50 border border-gray-300 text-gray-800 text-sm rounded-lg py-1.5 px-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out">
                                                        <span id="togglePasswordEdit-{{ $akunAgens['id_user_agen'] }}"
                                                            class="text-gray-500 absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer transform -translate-y-1/2 top-1/2"
                                                            onclick="togglePassword('password-edit-{{ $akunAgens['id_user_agen'] }}', this)">
                                                            <i class="fa-solid fa-eye-slash"></i>
                                                        </span>
                                                    </div>

                                                    <div class="text-left">
                                                        <label for="edit-phone"
                                                            class="block mb-2 text-sm font-semibold text-gray-600">No.
                                                            Telepon</label>
                                                        <input type="tel" value="{{ $akunAgens->no_telp }}" name="no_telp"
                                                            id="no_telp"
                                                            class="mb-4 bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                                            required>
                                                    </div>
                                                </div>

                                                <div class="grid grid-cols-2 gap-2">
                                                    <div class="text-left">
                                                        <label for="edit-bank"
                                                            class="block mb-2 text-sm font-semibold text-gray-600">Nama Bank</label>
                                                        <input type="text" value="{{ $akunAgens->nama_bank }}" name="nama_bank"
                                                            id="nama_bank"
                                                            class="mb-4 bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                                    </div>

                                                    <div class="text-left">
                                                        <label for="edit-rekening"
                                                            class="block mb-2 text-sm font-semibold text-gray-600">No.
                                                            Rekening</label>
                                                        <input type="text" value="{{ $akunAgens->no_rek }}" name="no_rek"
                                                            id="no_rek"
                                                            class="mb-4 bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                                    </div>
                                                </div>

                                                <div class="grid grid-cols-2 gap-2">
                                                    <div class="text-left">
                                                        <label for="edit-status"
                                                            class="block mb-2 text-sm font-semibold text-gray-600">Status</label>
                                                        <select name="status" id="edit-status"
                                                            class="mb-4 bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                                            <option value="1" {{ $akunAgens->status == 1 ? 'selected' : '' }}>
                                                                Aktif
                                                            </option>
                                                            <option value="0" {{ $akunAgens->status == 0 ? 'selected' : '' }}>
                                                                Tidak Aktif</option>
                                                        </select>
                                                    </div>

                                                    <div class="text-left">
                                                        <label for="edit-provinsi"
                                                            class="block mb-2 text-sm font-semibold text-gray-600">Provinsi</label>
                                                        <select name="provinsi" id="provinsi"
                                                            class="mb-4 bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                                                            <option value="">Pilih Provinsi</option>
                                                            <option value="Aceh" {{ $akunAgens->provinsi == 'Aceh' ? 'selected' : '' }}>Aceh</option>
                                                            <option value="Bali" {{ $akunAgens->provinsi == 'Bali' ? 'selected' : '' }}>Bali</option>
                                                            <option value="Banten" {{ $akunAgens->provinsi == 'Banten' ? 'selected' : '' }}>Banten</option>
                                                            <option value="Bengkulu" {{ $akunAgens->provinsi == 'Bengkulu' ? 'selected' : '' }}>Bengkulu</option>
                                                            <option value="DI Yogyakarta" {{ $akunAgens->provinsi == 'DI Yogyakarta' ? 'selected' : '' }}>DI Yogyakarta</option>
                                                            <option value="DKI Jakarta" {{ $akunAgens->provinsi == 'DKI Jakarta' ? 'selected' : '' }}>DKI Jakarta</option>
                                                            <option value="Jawa Barat" {{ $akunAgens->provinsi == 'Jawa Barat' ? 'selected' : '' }}>Jawa Barat</option>
                                                            <option value="Jawa Tengah" {{ $akunAgens->provinsi == 'Jawa Tengah' ? 'selected' : '' }}>Jawa Tengah</option>
                                                            <option value="Jawa Timur" {{ $akunAgens->provinsi == 'Jawa Timur' ? 'selected' : '' }}>Jawa Timur</option>
                                                            <option value="Kalimantan Barat" {{ $akunAgens->provinsi == 'Kalimantan Barat' ? 'selected' : '' }}>Kalimantan Barat</option>
                                                            <option value="Kalimantan Selatan" {{ $akunAgens->provinsi == 'Kalimantan Selatan' ? 'selected' : '' }}>Kalimantan Selatan</option>
                                                            <option value="Kalimantan Tengah" {{ $akunAgens->provinsi == 'Kalimantan Tengah' ? 'selected' : '' }}>Kalimantan Tengah</option>
                                                            <option value="Kalimantan Timur" {{ $akunAgens->provinsi == 'Kalimantan Timur' ? 'selected' : '' }}>Kalimantan Timur</option>
                                                            <option value="Kalimantan Utara" {{ $akunAgens->provinsi == 'Kalimantan Utara' ? 'selected' : '' }}>Kalimantan Utara</option>
                                                            <option value="Kepulauan Bangka Belitung" {{ $akunAgens->provinsi == 'Kepulauan Bangka Belitung' ? 'selected' : '' }}>Kepulauan Bangka Belitung</option>
                                                            <option value="Kepulauan Riau" {{ $akunAgens->provinsi == 'Kepulauan Riau' ? 'selected' : '' }}>Kepulauan Riau</option>
                                                            <option value="Lampung" {{ $akunAgens->provinsi == 'Lampung' ? 'selected' : '' }}>Lampung</option>
                                                            <option value="Maluku" {{ $akunAgens->provinsi == 'Maluku' ? 'selected' : '' }}>Maluku</option>
                                                            <option value="Maluku Utara" {{ $akunAgens->provinsi == 'Maluku Utara' ? 'selected' : '' }}>Maluku Utara</option>
                                                            <option value="Nusa Tenggara Barat" {{ $akunAgens->provinsi == 'Nusa Tenggara Barat' ? 'selected' : '' }}>Nusa Tenggara Barat</option>
                                                            <option value="Nusa Tenggara Timur" {{ $akunAgens->provinsi == 'Nusa Tenggara Timur' ? 'selected' : '' }}>Nusa Tenggara Timur</option>
                                                            <option value="Papua" {{ $akunAgens->provinsi == 'Papua' ? 'selected' : '' }}>Papua</option>
                                                            <option value="Papua Barat" {{ $akunAgens->provinsi == 'Papua Barat' ? 'selected' : '' }}>Papua Barat</option>
                                                            <option value="Papua Barat Daya" {{ $akunAgens->provinsi == 'Papua Barat Daya' ? 'selected' : '' }}>Papua Barat Daya</option>
                                                            <option value="Papua Selatan" {{ $akunAgens->provinsi == 'Papua Selatan' ? 'selected' : '' }}>Papua Selatan</option>
                                                            <option value="Papua Tengah" {{ $akunAgens->provinsi == 'Papua Tengah' ? 'selected' : '' }}>Papua Tengah</option>
                                                            <option value="Papua Pegunungan" {{ $akunAgens->provinsi == 'Papua Pegunungan' ? 'selected' : '' }}>Papua Pegunungan</option>
                                                            <option value="Riau" {{ $akunAgens->provinsi == 'Riau' ? 'selected' : '' }}>Riau</option>
                                                            <option value="Sulawesi Barat" {{ $akunAgens->provinsi == 'Sulawesi Barat' ? 'selected' : '' }}>Sulawesi Barat</option>
                                                            <option value="Sulawesi Selatan" {{ $akunAgens->provinsi == 'Sulawesi Selatan' ? 'selected' : '' }}>Sulawesi Selatan</option>
                                                            <option value="Sulawesi Tengah" {{ $akunAgens->provinsi == 'Sulawesi Tengah' ? 'selected' : '' }}>Sulawesi Tengah</option>
                                                            <option value="Sulawesi Tenggara" {{ $akunAgens->provinsi == 'Sulawesi Tenggara' ? 'selected' : '' }}>Sulawesi Tenggara</option>
                                                            <option value="Sulawesi Utara" {{ $akunAgens->provinsi == 'Sulawesi Utara' ? 'selected' : '' }}>Sulawesi Utara</option>
                                                            <option value="Sumatera Barat" {{ $akunAgens->provinsi == 'Sumatera Barat' ? 'selected' : '' }}>Sumatera Barat</option>
                                                            <option value="Sumatera Selatan" {{ $akunAgens->provinsi == 'Sumatera Selatan' ? 'selected' : '' }}>Sumatera Selatan</option>
                                                            <option value="Sumatera Utara" {{ $akunAgens->provinsi == 'Sumatera Utara' ? 'selected' : '' }}>Sumatera Utara</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="text-left">
                                                    <label for="edit-alamat"
                                                        class="block mb-2 text-sm font-semibold text-gray-600">Alamat</label>
                                                    <textarea name="alamat" id="alamat"
                                                        class="mb-4 bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                                        placeholder="Contoh: Jl. Sudirman No. 123, RT/RW 05/02, Kecamatan, Kota, Kode Pos">{{ $akunAgens->alamat }}</textarea>
                                                </div>

                                                <div class="text-left">
                                                    <label for="edit-avatar"
                                                        class="block mb-2 text-sm font-semibold text-gray-600">KTP</label>
                                                    <input
                                                        class="block mb-2 w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50"
                                                        aria-describedby="edit-avatar_help" name="gambar_ktp"
                                                        id="gambar_ktp-{{ $akunAgens['id_user_agen'] }}" type="file"
                                                        accept=".jpg, .jpeg, .png" />
                                                    <p id="sizeWarning-{{ $akunAgens['id_user_agen'] }}"
                                                        class="text-red-600 mt-1 hidden text-sm">Foto KTP tidak boleh
                                                        melebihi 1 MB
                                                    </p>
                                                    <p id="ktp-file-name-{{ $akunAgens['id_user_agen'] }}"
                                                        class="text-sm text-gray-500">
                                                        File saat ini:
                                                        {{ $akunAgens['gambar_ktp'] ? $akunAgens['gambar_ktp'] : 'Tidak ada file saat ini.' }}
                                                    </p>
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
                    </tbody>
                @endif
        </table>
    </div>

</div>
<!-- Modal Tambah Akun-->
<div id="tambah-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow">
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
            <form action="{{ route('pengaturanAgen.input') }}" method="POST" enctype="multipart/form-data"
                class="p-4 space-y-1">
                @csrf

                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label for="nama_lengkap" class="block mb-1 text-sm font-semibold text-gray-600">Nama
                            Lengkap</label>
                        <input type="text" name="nama_lengkap" id="nama_lengkap" placeholder="Nama lengkap"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-800 text-sm rounded-lg py-1.5 px-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out"
                            required>
                    </div>
                    <div>
                        <label for="username" class="block mb-1 text-sm font-semibold text-gray-600">Username</label>
                        <input type="text" name="username" id="username" placeholder="Username"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-800 text-sm rounded-lg py-1.5 px-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out"
                            required>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-2">
                    <div class="relative">
                        <label for="password" class="block mb-2 text-sm font-semibold text-gray-600">Password</label>
                        <input type="password" id="password-add" name="password" placeholder="Password"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-800 text-sm rounded-lg py-1.5 px-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out"
                            required />
                        <span id="togglePasswordAdd"
                            class="text-gray-500 absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer mt-6"
                            onclick="togglePassword('password-add', this)">
                            <i class="fa-solid fa-eye-slash"></i>
                        </span>
                    </div>

                    <div>
                        <label for="no_telp" class="block mb-2 text-sm font-semibold text-gray-600">No.
                            Telepon</label>
                        <input type="tel" name="no_telp" id="no_telp" placeholder="08xxxxxxxxxx"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-800 text-sm rounded-lg py-1.5 px-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out"
                            required>
                    </div>
                </div>
                <!-- Bank dan Nomor Rekening -->
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label for="nama_bank" class="block mb-2 text-sm font-semibold text-gray-600">Bank</label>
                        <input type="text" name="nama_bank" id="nama_bank" placeholder="Nama Bank"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-800 text-sm rounded-lg py-1.5 px-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out"
                            required>
                    </div>
                    <div>
                        <label for="no_rek" class="block mb-2 text-sm font-semibold text-gray-600">No. Rekening</label>
                        <input type="text" name="no_rek" id="no_rek" placeholder="Nomor rekening"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-800 text-sm rounded-lg py-1.5 px-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out"
                            required>
                    </div>
                </div>

                <!-- Provinsi -->
                <div>
                    <label for="provinsi" class="block mb-2 text-sm font-semibold text-gray-600">Provinsi</label>
                    <select id="provinsi" name="provinsi"
                        class="w-full bg-gray-50 border border-gray-300 text-gray-800 text-sm rounded-lg py-1.5 px-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out">
                        <option value="" disabled selected>Pilih Provinsi</option>
                        <option value="Aceh">Aceh</option>
                        <option value="Bali">Bali</option>
                        <option value="Banten">Banten</option>
                        <option value="Bengkulu">Bengkulu</option>
                        <option value="DI Yogyakarta">DI Yogyakarta</option>
                        <option value="DKI Jakarta">DKI Jakarta</option>
                        <option value="Jawa Barat">Jawa Barat</option>
                        <option value="Jawa Tengah">Jawa Tengah</option>
                        <option value="Jawa Timur">Jawa Timur</option>
                        <option value="Kalimantan Barat">Kalimantan Barat</option>
                        <option value="Kalimantan Selatan">Kalimantan Selatan</option>
                        <option value="Kalimantan Tengah">Kalimantan Tengah</option>
                        <option value="Kalimantan Timur">Kalimantan Timur</option>
                        <option value="Kalimantan Utara">Kalimantan Utara</option>
                        <option value="Kepulauan Bangka Belitung">Kepulauan Bangka Belitung</option>
                        <option value="Kepulauan Riau">Kepulauan Riau</option>
                        <option value="Lampung">Lampung</option>
                        <option value="Maluku">Maluku</option>
                        <option value="Maluku Utara">Maluku Utara</option>
                        <option value="Nusa Tenggara Barat">Nusa Tenggara Barat</option>
                        <option value="Nusa Tenggara Timur">Nusa Tenggara Timur</option>
                        <option value="Papua">Papua</option>
                        <option value="Papua Barat">Papua Barat</option>
                        <option value="Papua Barat Daya">Papua Barat Daya</option>
                        <option value="Papua Selatan">Papua Selatan</option>
                        <option value="Papua Tengah">Papua Tengah</option>
                        <option value="Papua Pegunungan">Papua Pegunungan</option>
                        <option value="Riau">Riau</option>
                        <option value="Sulawesi Barat">Sulawesi Barat</option>
                        <option value="Sulawesi Selatan">Sulawesi Selatan</option>
                        <option value="Sulawesi Tengah">Sulawesi Tengah</option>
                        <option value="Sulawesi Tenggara">Sulawesi Tenggara</option>
                        <option value="Sulawesi Utara">Sulawesi Utara</option>
                        <option value="Sumatera Barat">Sumatera Barat</option>
                        <option value="Sumatera Selatan">Sumatera Selatan</option>
                        <option value="Sumatera Utara">Sumatera Utara</option>
                    </select>
                </div>

                <!-- Alamat -->
                <div>
                    <label for="alamat" class="block mb-2 text-sm font-semibold text-gray-600">Alamat</label>
                    <textarea id="alamat" name="alamat"
                        placeholder="Contoh: Jalan Sudirman No. 123, Kelurahan ABC, Kecamatan XYZ, Kota DEF, Provinsi GHI, Kode Pos 12345"
                        class="w-full bg-gray-50 border border-gray-300 text-gray-800 text-sm rounded-lg py-1.5 px-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out"
                        rows="3" required></textarea>
                </div>

                <!-- Upload KTP -->
                <div>
                    <label for="gambar_ktp" class="block mb-2 text-sm font-semibold text-gray-600">KTP</label>
                    <input type="file" id="gambar_ktp" name="gambar_ktp"
                        class="block w-full mb-2 text-xs text-gray-600 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                        accept=".jpg, .jpeg, .png" required />
                    <p id="sizeWarning" class="text-red-600 hidden text-xs">Foto KTP tidak boleh melebihi 1 MB</p>
                </div>

                <!-- Tombol Simpan -->
                <div class="flex justify-center">
                    <button type="submit"
                        class="bg-gray-800 text-white py-2 px-4 rounded-md hover:bg-gray-700 transition duration-300">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Custom Pagination -->
@if ($akunAgen->total() > 10)
    <div class="flex flex-col items-center my-6">
        <!-- Help text -->
        <span class="text-sm text-gray-700 dark:text-gray-400">
            Menampilkan <span class="font-semibold text-gray-900 dark:text-white">{{ $akunAgen->firstItem() }}</span>
            sampai
            <span class="font-semibold text-gray-900 dark:text-white">{{ $akunAgen->lastItem() }}</span> dari
            <span class="font-semibold text-gray-900 dark:text-white">{{ $akunAgen->total() }}</span> agen
        </span>
        <div class="inline-flex mt-2 xs:mt-0">
            <button {{ $akunAgen->onFirstPage() ? 'disabled' : '' }}
                class="flex items-center justify-center px-3 h-8 text-sm font-medium text-white bg-gray-800 rounded-s hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                {{ $akunAgen->previousPageUrl() ? 'onclick=window.location.href=\'' . $akunAgen->previousPageUrl() . '\'' : '' }}>
                Sebelumnya
            </button>
            <button {{ !$akunAgen->hasMorePages() ? 'disabled' : '' }}
                class="flex items-center justify-center px-3 h-8 text-sm font-medium text-white bg-gray-800 border-0 border-s border-gray-700 rounded-e hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                {{ $akunAgen->nextPageUrl() ? 'onclick=window.location.href=\'' . $akunAgen->nextPageUrl() . '\'' : '' }}>
                Selanjutnya
            </button>
        </div>
    </div>
@endif
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Validasi foto KTP tidak boleh lebih dari 1 mb
    document.getElementById('gambar_ktp').addEventListener('change', function () {
        const file = this.files[0];
        const maxSize = 1 * 1024 * 1024;
        const warningText = document.getElementById('sizeWarning');

        if (file.size > maxSize) {
            warningText.classList.remove('hidden');
            this.value = '';
        } else {
            warningText.classList.add('hidden');
        }
    });
    // Seleksi semua input file yang ID-nya dimulai dengan "gambar_ktp-"
    document.querySelectorAll("input[id^='gambar_ktp-']").forEach(function (fileInput) {
        const userId = fileInput.id.split('-')[1];
        const warningText = document.getElementById(`sizeWarning-${userId}`);
        fileInput.addEventListener('change', function () {
            const file = this.files[0];
            const maxSize = 1 * 1024 * 1024;

            if (file && file.size > maxSize) {
                warningText.classList.remove('hidden');
                this.value = '';
            } else {
                warningText.classList.add('hidden');
            }
        });
    });
    // Mengosongkan input pencarian dan menghapus query string saat halaman dimuat
    document.addEventListener("DOMContentLoaded", function () {
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


    function togglePassword(inputId, toggleElement) {
        const passwordInput = document.getElementById(inputId);
        const toggleIcon = toggleElement.children[0];

        console.log('Toggle Password function called for:', inputId);
        console.log('Current type:', passwordInput.type);


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
    document.addEventListener('DOMContentLoaded', function () {
        @if ($errors->has('username'))
            Swal.fire({
                title: 'Peringatan!',
                text: 'Username sudah digunakan, pilih username yang lain.',
                icon: 'warning',
                confirmButtonText: 'OK'
            });
        @endif
    });

    // Fungsi untuk konfirmasi penghapusan akun
    function confirmDelete(id, namaUser) {
        Swal.fire({
            title: 'Anda yakin?',
            text: `Anda akan menghapus akun ${namaUser} ini.`,
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
</script>
@endsection