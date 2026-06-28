<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Form Pengajuan KRS
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">

                @if ($errors->any())
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>• {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('krs.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="block font-semibold mb-2">
                            Nama Mahasiswa
                        </label>

                        <input
                            type="text"
                            name="nama_mahasiswa"
                            value="{{ old('nama_mahasiswa', Auth::user()->name) }}"
                            class="w-full rounded border-gray-300"
                            required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-semibold mb-2">
                            NIM
                        </label>

                        <input
                            type="text"
                            name="nim"
                            value="{{ old('nim') }}"
                            class="w-full rounded border-gray-300"
                            required>
                    </div>

                    <div class="mt-4">
                        <label>Dosen PA</label>

                        <select name="dosen_id" class="mt-1 block w-full rounded-md border-gray-300">
                            @foreach($dosens as $dosen)
                                <option value="{{ $dosen->id }}">
                                    {{ $dosen->nama_dosen }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
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

                    <div class="mb-4">
                        <label class="block font-semibold mb-2">
                            Daftar Mata Kuliah
                        </label>

                        <textarea
                            name="daftar_mata_kuliah"
                            rows="4"
                            class="w-full rounded border-gray-300"
                            placeholder="Contoh:
                                        - Pemrograman Framework Web
                                        - Data Mining
                                        - Kecerdasan Buatan"
                            required>{{ old('daftar_mata_kuliah') }}</textarea>
                    </div>

                    <div class="mb-6">
                        <label class="block font-semibold mb-2">
                            Total SKS
                        </label>

                        <input
                            type="number"
                            name="total_sks"
                            value="{{ old('total_sks') }}"
                            class="w-full rounded border-gray-300"
                            required>
                    </div>

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