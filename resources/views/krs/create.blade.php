<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Formulir Pengajuan KRS Mahasiswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="p-6 text-gray-900">
                    
                    <form method="POST" action="{{ route('krs.store') }}" class="space-y-6">
                        @csrf

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nama Mahasiswa</label>
                            <input type="text" value="{{ Auth::user()->name }}" class="mt-1 block w-full rounded-md border-gray-300 bg-gray-100 text-gray-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" readonly>
                            <input type="hidden" name="mahasiswa_id" value="{{ Auth::user()->id }}">
                        </div>

                        <div>
                            <label for="mata_kuliah" class="block text-sm font-medium text-gray-700">Mata Kuliah</label>
                            <input type="text" name="mata_kuliah" id="mata_kuliah" required placeholder="Contoh: Pemrograman Framework Web" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>

                        <div>
                            <label for="sks" class="block text-sm font-medium text-gray-700">Jumlah SKS</label>
                            <select name="sks" id="sks" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <option value="2">2 SKS</option>
                                <option value="3">3 SKS</option>
                                <option value="4">4 SKS</option>
                            </select>
                        </div>

                        <div>
                            <label for="kelas" class="block text-sm font-medium text-gray-700">Kelas</label>
                            <input type="text" name="kelas" id="kelas" required placeholder="Contoh: TI-4A" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>

                        <div class="flex justify-end space-x-3 pt-4 border-t border-gray-100">
                            <a href="{{ route('krs.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 transition ease-in-out duration-150">
                                Batal
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 transition ease-in-out duration-150 shadow-sm">
                                Simpan Pengajuan
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>