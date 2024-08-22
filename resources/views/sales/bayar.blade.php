@extends('sales.default')

@section('content')
    <section class="bg-gray-100 py-5 my-20">
        <div class="max-w-3xl mx-auto bg-white shadow-md rounded-lg p-8">
            <h2 class="text-2xl font-bold mb-6">Edit Nota Pesanan</h2>
            @if ($errors->any())
                <div class="bg-red-500 text-white p-4 rounded mb-6">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('bayar_nota', $id_nota) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="mb-4">
                    <label for="gambar" class="block text-gray-700 font-bold mb-2">Upload Gambar:</label>
                    <input type="file" name="bukti_transfer" id="gambar" class="w-full p-2 border border-gray-300 rounded">
                </div>

                <div class="justify-end">
                    <button type="submit"
                        class="">
                        Update Nota
                    </button>
                </div>
            </form>
        </div>
    </section>
@endsection
