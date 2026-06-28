<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Data Mahasiswa') }}
            </h2>
            <a href="{{ url('/mahasiswa') }}" class="bg-gray-500 hover:bg-gray-600 text-white text-xs font-bold py-2 px-4 rounded shadow-sm transition">
                Kembali ke Daftar
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-50 border-l-4 border-red-500 rounded text-sm text-red-700 shadow-sm">
                    <p class="font-bold mb-1">Periksa kembali isian Anda:</p>
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border border-gray-100">
                
                <form action="{{ url('/mahasiswa/'.$mahasiswa->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="nim" class="block text-sm font-semibold text-gray-700 mb-1">NIM Mahasiswa</label>
                        <input type="text" id="nim" name="nim" value="{{ old('nim', $mahasiswa->nim) }}" 
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm" 
                               placeholder="Contoh: 24010123" required>
                    </div>

                    <div>
                        <label for="nama" class="block text-sm font-semibold text-gray-700 mb-1">Nama Lengkap</label>
                        <input type="text" id="nama" name="nama" value="{{ old('nama', $mahasiswa->nama) }}" 
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm" 
                               placeholder="Masukkan nama mahasiswa" required>
                    </div>

                    <div>
                        <label for="prodi_id" class="block text-sm font-semibold text-gray-700 mb-1">Program Studi</label>
                        <select id="prodi_id" name="prodi_id" 
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm" required>
                            <option value="">-- Pilih Program Studi --</option>
                            @foreach($prodis as $prodi)
                                <option value="{{ $prodi->id }}" {{ old('prodi_id', $mahasiswa->prodi_id) == $prodi->id ? 'selected' : '' }}>
                                    {{ $prodi->nama_prodi }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="dosen_id" class="block text-sm font-semibold text-gray-700 mb-1">Dosen Pembimbing Akademik (PA)</label>
                        <select id="dosen_id" name="dosen_id" 
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm" required>
                            <option value="">-- Pilih Dosen PA --</option>
                            @foreach($dosens as $dosen)
                                <option value="{{ $dosen->id }}" {{ old('dosen_id', $mahasiswa->dosen_id) == $dosen->id ? 'selected' : '' }}>
                                    {{ $dosen->nama_dosen }} (NIDN: {{ $dosen->nidn }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-semibold text-gray-700 mb-1">Status Keaktifan</label>
                        <select id="status" name="status" 
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm" required>
                            <option value="Aktif" {{ old('status', $mahasiswa->status) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="Tidak Aktif" {{ old('status', $mahasiswa->status) == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                    </div>

                    <div>
                        <label for="alamat" class="block text-sm font-semibold text-gray-700 mb-1">Alamat Rumah</label>
                        <textarea id="alamat" name="alamat" rows="3" 
                                  class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm" 
                                  placeholder="Tuliskan alamat lengkap mahasiswa...">{{ old('alamat', $mahasiswa->alamat) }}</textarea>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-md border border-dashed border-gray-300">
                        <label for="foto" class="block text-sm font-semibold text-gray-700 mb-1">Pasfoto Mahasiswa</label>
                        <p class="text-xs text-gray-500 mb-2">Format dokumen gambar resmi (.png, .jpg, .jpeg) ukuran maksimal 2 Megabytes.</p>
                        <input type="file" id="foto" name="foto" accept="image/*" 
                               class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>

                    <div class="bg-gray-50 p-4 rounded-md border border-dashed border-gray-300">
                        <label for="bukti_ukt" class="block text-sm font-semibold text-gray-700 mb-1">Bukti Pembayaran UKT/SPP</label>
                        <p class="text-xs text-gray-500 mb-2">Format berkas pengajuan (.pdf, .jpg, .jpeg, .png) ukuran maksimal 3 Megabytes.</p>
                        <input type="file" id="bukti_ukt" name="bukti_ukt" accept=".pdf,image/*" 
                               class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100" required>
                    </div>

                    <div class="flex justify-end pt-4 border-t border-gray-100">
                        <a href="{{ url('/mahasiswa') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-2 px-5 rounded mr-3 text-sm transition">
                            Batal
                        </a>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-5 rounded text-sm shadow-md transition">
                            Simpan Data Mahasiswa
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>