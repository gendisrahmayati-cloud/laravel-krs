<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Data Pengajuan KRS
        </h2>
    </x-slot>

    <style>
        .container {
            width: 95%;
            margin: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        .btn-tambah {
            background-color: blue;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
        }

        .btn-edit {
            background-color: orange;
            color: white;
            padding: 8px 10px;
            text-decoration: none;
            border-radius: 5px;
        }

        .btn-hapus {
            background-color: red;
            color: white;
            border: none;
            padding: 8px 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        .status {
            background-color: orange;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
        }

        .notif {
            background: #d4edda;
            color: #155724;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
        }
    </style>

    <div class="container">

        <h2>Data Pengajuan KRS</h2>

        @if(session('success'))

        <div class="notif">

            {{ session('success') }}

        </div>

        @endif

        <br>

        <a href="/krs/create" class="btn-tambah">

            + Tambah Data

        </a>

        <br><br>

        <table>

            <tr>

                <th>Nama Mahasiswa</th>
                <th>NIM</th>
                <th>Semester</th>
                <th>Daftar Mata Kuliah</th>
                <th>Total SKS</th>
                <th>Status Persetujuan</th>
                <th>Aksi</th>

            </tr>

            @foreach($krs as $item)

            <tr>

                <td>{{ $item->nama_mahasiswa }}</td>

                <td>{{ $item->nim }}</td>

                <td>{{ $item->semester }}</td>

                <td>{{ $item->daftar_mata_kuliah }}</td>

                <td>{{ $item->total_sks }}</td>

                <td>

                    @if($item->status_persetujuan == 'ACC')
                        <span style="background:green;color:white;padding:5px 10px;border-radius:5px;">
                            ACC
                        </span>
                    @else
                        <span style="background:orange;color:white;padding:5px 10px;border-radius:5px;">
                            Pending
                        </span>
                    @endif

                </td>

                <td>

                    {{-- Tombol ACC hanya muncul jika status masih Pending --}}
                    @if($item->status_persetujuan == 'Pending')
                        <form action="/krs/{{ $item->id }}/acc" method="POST" style="display:inline;">
                            @csrf
                            @method('PUT')

                            <button type="submit"
                                onclick="return confirm('ACC pengajuan KRS ini?')"
                                style="background:green;color:white;padding:8px 10px;border:none;border-radius:5px;cursor:pointer;">
                                ACC
                            </button>
                        </form>

                        <br><br>
                    @endif

                    <a href="/krs/{{ $item->id }}/edit" class="btn-edit">
                        Edit
                    </a>

                    <br><br>

                    <form action="/krs/{{ $item->id }}"
                        method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus data ini?')">

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn-hapus">
                            Hapus
                        </button>

                    </form>

                </td>

            </tr>

            @endforeach

        </table>

    </div>

</x-app-layout>