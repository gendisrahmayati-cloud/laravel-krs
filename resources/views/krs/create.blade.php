<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Form Pengajuan KRS
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">

                @if(session('error'))
                    <div class="mb-4 bg-red-100 text-red-700 p-3 rounded">
                        {{ session('error') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-4 bg-red-100 text-red-700 p-3 rounded">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>• {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('krs.store') }}" method="POST">
                    @csrf

                    {{-- DATA MAHASISWA --}}
                    <div class="bg-gray-100 rounded-lg p-5 mb-6">

                        <h3 class="font-bold text-lg mb-4">
                            Data Mahasiswa
                        </h3>

                        <div class="mb-3">
                            <label class="font-semibold">
                                Nama
                            </label>

                            <input
                                type="text"
                                value="{{ $mahasiswa->nama }}"
                                class="w-full rounded border-gray-300 bg-gray-200"
                                readonly>
                        </div>

                        <div class="mb-3">
                            <label class="font-semibold">
                                NIM
                            </label>

                            <input
                                type="text"
                                value="{{ $mahasiswa->nim }}"
                                class="w-full rounded border-gray-300 bg-gray-200"
                                readonly>
                        </div>

                        <div>
                            <label class="font-semibold">
                                Dosen PA
                            </label>

                            <input
                                type="text"
                                value="{{ $mahasiswa->dosen->nama_dosen }}"
                                class="w-full rounded border-gray-300 bg-gray-200"
                                readonly>
                        </div>

                    </div>

                    {{-- PILIH MATA KULIAH --}}
                    <div class="mb-6">

                        <label class="block font-bold text-lg mb-3">
                            Pilih Mata Kuliah
                        </label>

                        @foreach($mataKuliahs as $mk)

                            <div class="mb-2">

                                <label class="flex items-center gap-3">

                                    <input
                                        type="checkbox"
                                        name="mata_kuliah[]"
                                        value="{{ $mk->id }}">

                                    <span class="font-semibold">
                                        {{ $mk->kode_mk }}
                                    </span>

                                    -

                                    {{ $mk->nama_mk }}
                                    ({{ $mk->sks }} SKS)

                                </label>

                            </div>

                        @endforeach

                    </div>

                    {{-- SEMESTER --}}
                    <div class="mb-6">

                        <label class="block font-semibold mb-2">
                            Semester
                        </label>

                        <input
                            type="number"
                            name="semester"
                            value="{{ old('semester') }}"
                            class="w-full rounded border-gray-300"
                            required>

                    </div>

                    {{-- TOMBOL --}}
                    <div class="flex justify-end gap-3">

                        <a href="{{ route('krs.index') }}"
                            class="bg-gray-500 text-white px-5 py-2 rounded hover:bg-gray-600">

                            Batal

                        </a>

                        <button
                            type="submit"
                            class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700">

                            Simpan Pengajuan

                        </button>

                    </div>

                </form>

            </div>
        </div>
    </div>

</x-app-layout>