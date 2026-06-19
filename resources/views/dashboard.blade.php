<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard Tugas Akhir') }}
            </h2>
            
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white text-xs font-bold py-2 px-4 rounded shadow-sm transition duration-150">
                    Keluar / Log Out
                </button>
            </form>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100">
                <div class="p-6 text-gray-900">
                    <p class="text-lg font-medium mb-2">{{ __("You're logged in!") }}</p>
                    <p class="text-sm text-gray-600">
                        Selamat datang, <strong class="text-blue-600">{{ Auth::user()->name }}</strong>. 
                        Hak akses Anda saat ini adalah: 
                        <span class="ml-1 px-2.5 py-1 bg-blue-100 text-blue-800 text-xs font-extrabold rounded uppercase tracking-wider">
                            {{ Auth::user()->role ?? 'user' }}
                        </span>
                    </p>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100">
                <div class="p-6 text-gray-900">
                    <h3 class="font-bold text-gray-800 mb-4 text-base">🔗 Menu Manajemen Data </h3>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        
                        @if(Auth::user()->role == 'admin')
                        <a href="{{ url('/dosen') }}" class="flex items-center p-4 bg-gray-50 hover:bg-blue-50 border border-gray-200 hover:border-blue-300 rounded-lg transition group">
                            <div class="p-3 bg-blue-500 rounded-lg text-white group-hover:bg-blue-600">
                                🧑‍🏫
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-semibold text-gray-900">Kelola Data Master Dosen</p>
                                <p class="text-xs text-gray-500">Akses rute dosen dengan proteksi Middleware</p>
                            </div>
                        </a>
                        @endif

                        <a href="{{ url('/krs') }}" class="flex items-center p-4 bg-gray-50 hover:bg-indigo-50 border border-gray-200 hover:border-indigo-300 rounded-lg transition group">
                            <div class="p-3 bg-indigo-500 rounded-lg text-white group-hover:bg-indigo-600">
                                📝
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-semibold text-gray-900">Kelola Pengajuan KRS</p>
                                <p class="text-xs text-gray-500">Lihat dan manipulasi data KRS kelompok</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>