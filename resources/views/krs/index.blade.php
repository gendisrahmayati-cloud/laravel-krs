<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Data Pengajuan KRS
        </h2>
    </x-slot>

    <style>
        .container{
            width:95%;
            margin:auto;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        th,td{
            border:1px solid #ddd;
            padding:12px;
            text-align:center;
        }

        th{
            background:#4CAF50;
            color:white;
        }

        tr:nth-child(even){
            background:#f8f8f8;
        }

        .btn-tambah{
            background:#2563eb;
            color:white;
            padding:10px 15px;
            border-radius:6px;
            text-decoration:none;
        }

        .btn-edit{
            background:orange;
            color:white;
            padding:8px 10px;
            border-radius:5px;
            text-decoration:none;
        }

        .btn-hapus{
            background:red;
            color:white;
            border:none;
            padding:8px 10px;
            border-radius:5px;
            cursor:pointer;
        }

        .btn-acc{
            background:green;
            color:white;
            border:none;
            padding:8px 10px;
            border-radius:5px;
            cursor:pointer;
        }

        .status-pending{
            background:orange;
            color:white;
            padding:5px 10px;
            border-radius:5px;
        }

        .status-acc{
            background:green;
            color:white;
            padding:5px 10px;
            border-radius:5px;
        }

        .notif{
            background:#d4edda;
            color:#155724;
            padding:10px;
            margin-bottom:15px;
            border-radius:5px;
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

        @if(Auth::user()->role == 'user')
            <a href="{{ route('krs.create') }}" class="btn-tambah">
                + Tambah Pengajuan
            </a>
        @endif

        <br><br>

        <table>

            <thead>
            <tr>
                <th>Nama Mahasiswa</th>
                <th>NIM</th>
                <th>Semester</th>
                <th>Daftar Mata Kuliah</th>
                <th>Total SKS</th>
                <th>Status Persetujuan</th>

                @if(Auth::user()->role == 'admin')
                    <th>Aksi</th>
                @endif
            </tr>
            </thead>

            <tbody>

            @foreach($krs as $item)

            <tr>

                <td>{{ $item->nama_mahasiswa }}</td>

                <td>{{ $item->nim }}</td>

                <td>{{ $item->semester }}</td>

                <td>{{ $item->daftar_mata_kuliah }}</td>

                <td>{{ $item->total_sks }}</td>

                <td>

                    @if($item->status_persetujuan == 'Pending')

                        <span class="status-pending">
                            Pending
                        </span>

                    @else

                        <span class="status-acc">
                            Disetujui
                        </span>

                    @endif

                </td>

                @if(Auth::user()->role == 'admin')

                <td>

                    @if($item->status_persetujuan == 'Pending')

                    <form action="/krs/{{ $item->id }}/acc"
                          method="POST">

                        @csrf
                        @method('PUT')

                        <button
                            class="btn-acc"
                            onclick="return confirm('ACC KRS ini?')">

                            ACC

                        </button>

                    </form>

                    <br>

                    @endif

                    <a href="/krs/{{ $item->id }}/edit"
                       class="btn-edit">

                        Edit

                    </a>

                    <br><br>

                    <form action="/krs/{{ $item->id }}"
                          method="POST"
                          onsubmit="return confirm('Yakin ingin menghapus data ini?')">

                        @csrf
                        @method('DELETE')

                        <button
                            class="btn-hapus">

                            Hapus

                        </button>

                    </form>

                </td>

                @endif

            </tr>

            @endforeach

            </tbody>

        </table>

    </div>

</x-app-layout>