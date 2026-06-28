<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">
                Daftar Mata Kuliah
            </h2>

            <a href="{{ url('/mata-kuliah/create') }}"
                class="bg-blue-600 text-white px-4 py-2 rounded">
                + Tambah Mata Kuliah
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-6xl mx-auto">

            @if(session('success'))
                <div class="bg-green-100 p-3 rounded mb-3">
                    {{ session('success') }}
                </div>
            @endif

            <table class="w-full border">

                <thead class="bg-gray-200">
                    <tr>
                        <th class="p-2">No</th>
                        <th>Kode</th>
                        <th>Nama Mata Kuliah</th>
                        <th>SKS</th>
                        <th>Semester</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                @foreach($matkuls as $index=>$mk)

                <tr class="border">
                    <td class="text-center">{{ $index+1 }}</td>

                    <td>{{ $mk->kode_mk }}</td>

                    <td>{{ $mk->nama_mk }}</td>

                    <td class="text-center">{{ $mk->sks }}</td>

                    <td class="text-center">{{ $mk->semester }}</td>

                    <td class="text-center">

                        <a href="/mata-kuliah/{{ $mk->id }}/edit"
                            class="text-blue-600">
                            Edit
                        </a>

                        <form action="/mata-kuliah/{{ $mk->id }}"
                            method="POST"
                            class="inline">

                            @csrf
                            @method('DELETE')

                            <button
                                onclick="return confirm('Yakin?')"
                                class="text-red-600">

                                Hapus

                            </button>

                        </form>

                    </td>

                </tr>

                @endforeach

                </tbody>

            </table>

        </div>
    </div>

</x-app-layout>