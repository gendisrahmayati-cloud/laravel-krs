<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Daftar Data Mahasiswa') }}
            </h2>
            <a href="{{ url('/mahasiswa/create') }}" class="bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold py-2 px-4 rounded shadow-sm transition">
                + Tambah Mahasiswa Baru
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-50 border-l-4 border-green-500 rounded text-sm text-green-700 shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border border-gray-100">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 border border-gray-200 rounded-lg">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th scope="col" class="px-6 py-3 border-r text-center">No</th>
                                <th scope="col" class="px-6 py-3 border-r text-center">Pasfoto</th>
                                <th scope="col" class="px-6 py-3 border-r">NIM</th>
                                <th scope="col" class="px-6 py-3 border-r">Nama</th>
                                <th scope="col" class="px-6 py-3 border-r">Program Studi</th>
                                <th scope="col" class="px-6 py-3 border-r text-center">Status</th>
                                <th scope="col" class="px-6 py-3 border-r">Alamat</th>
                                <th scope="col" class="px-6 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($dataMahasiswa as $index => $mhs)
                                <tr class="bg-white hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 font-medium text-gray-900 border-r text-center">{{ $index + 1 }}</td>
                                    
                                    <td class="px-6 py-4 border-r text-center">
                                        @if($mhs->foto) 
                                            <img src="{{ asset('storage/' . $mhs->foto) }}" alt="Foto {{ $mhs->nama }}" class="w-12 h-16 object-cover rounded shadow-sm mx-auto border"> 
                                        @else 
                                            <span class="text-xs text-gray-400 italic">Tidak ada foto</span> 
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 font-semibold text-gray-800 border-r">{{ $mhs->nim }}</td>
                                    <td class="px-6 py-4 font-medium text-gray-900 border-r">{{ $mhs->nama }}</td>
                                    
                                    <td class="px-6 py-4 border-r font-medium text-blue-700">
                                        {{ $mhs->prodi->nama_prodi ?? 'Belum memilih prodi' }}
                                    </td>

                                    <td class="px-6 py-4 border-r text-center">
                                        <span class="px-2 py-1 text-xs font-bold rounded-full {{ $mhs->status == 'Aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $mhs->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 border-r text-xs max-w-xs truncate">{{ $mhs->alamat ?? '-' }}</td>
                                    
                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        @if(Auth::user()->role == 'admin')
                                            <a href="{{ url('/mahasiswa/'.$mhs->id.'/edit') }}" class="text-blue-600 hover:text-blue-900 font-bold mr-2 transition">Edit</a>
                                            <form action="{{ url('/mahasiswa/'.$mhs->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" class="text-red-600 hover:text-red-900 font-bold transition">
                                                    Hapus
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-xs text-gray-400 bg-gray-100 px-2 py-1 rounded">Hanya Baca</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-10 text-center text-gray-400 italic bg-gray-50">
                                        Belum ada data mahasiswa dalam database.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>