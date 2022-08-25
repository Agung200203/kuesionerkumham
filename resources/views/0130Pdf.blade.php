<html>

<head>
    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
            border-radius: 10px;
            overflow: hidden;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #297aff;
            color: white;
        }
    </style>
</head>
<body style="font-family: Monospace;">
    <h1 align="center">KEMENTRIAN HUKUM DAN HAM REPUBLIK INDONESIA</h1>
    <h1 align="center" style="margin-top: -15px;">SEKRETARIAT JENDRAL</h1>
    <h1 align="center" style="margin-top: -15px;">Laporan Pegawai</h1>
    <h2 align="center" style="margin-top: -15px;">Laman: www.kemenkumhan.co.id</h2>
    <hr style="width: 75%; border-width:1; border-style: solid; ;margin-bottom:2rem">
    <table id="customers">
        <tr>
            <th><b>NAMA</b></th>
            <th><b>ID</b></th>
            <th><b>NIM</b></th>
            <th><b>ALAMAT</b></th>
            <th><b>JUDUL</b></th>
            <th><b>DOSBIM</b></th>
            <th><b>DOSEN PENGUJI</b></th>
            <th><b>TANGGAL SIDANG</b></th>
        </tr>
        @foreach($data as $dt0130)
        <tr>
            <td>{{ $loop->index+1 }}</td>
            <td>{{$dt0130->nama}}</td>
            <td>{{$dt0130->nim}}</td>
            <td>{{$dt0130->alamat}}</td>
            <td>{{$dt0130->skripsi->judul}}</td>
            <td>{{$dt0130->skripsi->dosbim}}</td>
            <td>{{$dt0130->skripsi->dosen_penguji}}</td>
            <td>{{$dt0130->skripsi->tgl_sidang}}</td>
        </tr>
        @endforeach
        @foreach($data as $dt0130)
        <tr>
            <td>{{ $loop->index+1 }}</td>
            <td>{{$dt0130->nama}}</td>
            <td>{{$dt0130->nim}}</td>
            <td>{{$dt0130->alamat}}</td>
            <td>{{$dt0130->skripsi->judul}}</td>
            <td>{{$dt0130->skripsi->dosbim}}</td>
            <td>{{$dt0130->skripsi->dosen_penguji}}</td>
            <td>{{$dt0130->skripsi->tgl_sidang}}</td>
        </tr>
        @endforeach
        @foreach($data as $dt0130)
        <tr>
            <td>{{ $loop->index+1 }}</td>
            <td>{{$dt0130->nama}}</td>
            <td>{{$dt0130->nim}}</td>
            <td>{{$dt0130->alamat}}</td>
            <td>{{$dt0130->skripsi->judul}}</td>
            <td>{{$dt0130->skripsi->dosbim}}</td>
            <td>{{$dt0130->skripsi->dosen_penguji}}</td>
            <td>{{$dt0130->skripsi->tgl_sidang}}</td>
        </tr>
        @endforeach
        @foreach($data as $dt0130)
        <tr>
            <td>{{ $loop->index+1 }}</td>
            <td>{{$dt0130->nama}}</td>
            <td>{{$dt0130->nim}}</td>
            <td>{{$dt0130->alamat}}</td>
            <td>{{$dt0130->skripsi->judul}}</td>
            <td>{{$dt0130->skripsi->dosbim}}</td>
            <td>{{$dt0130->skripsi->dosen_penguji}}</td>
            <td>{{$dt0130->skripsi->tgl_sidang}}</td>
        </tr>
        @endforeach
    </table>

</body>

</html>