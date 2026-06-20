<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Data Master Dosen Pembimbing') }}
            </h2>
            @if(Auth::user()->role == 'admin')
                <a href="{{ url('/dosen/create') }}" class="bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold py-2 px-4 rounded shadow-md transition">
                    + Tambah Dosen Baru
                </a>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-50 border-l-4 border-green-500 rounded text-sm text-green-700 shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border border-gray-100">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 text-sm text-left">
                        <thead class="bg-gray-50 text-gray-700 uppercase text-xs font-semibold">
                            <tr>
                                <th class="px-6 py-3">No</th>
                                <th class="px-6 py-3">NIDN</th>
                                <th class="px-6 py-3">Nama Lengkap Dosen</th>
                                @if(Auth::user()->role == 'admin')
                                    <th class="px-6 py-3 text-center">Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-gray-600">
                            @forelse($dataDosen as $index => $d)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 font-medium text-gray-900">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 font-semibold text-blue-600">{{ $d->nidn }}</td>
                                    <td class="px-6 py-4 font-medium text-gray-900">{{ $d->nama_dosen }}</td>
                                    
                                    @if(Auth::user()->role == 'admin')
                                        <td class="px-6 py-4 text-center space-x-2">
                                            <a href="{{ url('/dosen/'.$d->id.'/edit') }}" class="text-indigo-600 hover:text-indigo-900 font-semibold">Edit</a>
                                            <form action="{{ url('/dosen/'.$d->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus dosen ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 font-semibold">Hapus</button>
                                            </form>
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="{{ Auth::user()->role == 'admin' ? 4 : 3 }}" class="px-6 py-8 text-center text-gray-400 italic">
                                        Belum ada data dosen pembimbing dalam database.
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