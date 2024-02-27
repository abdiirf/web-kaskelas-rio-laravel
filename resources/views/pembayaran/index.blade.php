@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Data Posts - Rio</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

        <!-- Menambahkan CSS untuk Mode Gelap -->
        <style>
            body {
                background: #121212; /* Warna latar belakang */
                color: #fff; /* Warna teks */
            }

            .navbar {
                background: #343a40 !important; /* Warna latar belakang navbar */
            }

            .card {
                background: #1e1e1e; /* Warna latar belakang card */
                color: #fff; /* Warna teks card */
            }

            /* Penyesuaian warna teks untuk link */
            a {
                color: #17a2b8;
            }

            /* Menyesuaikan warna tombol */
            .btn {
                background-color: #17a2b8;
                color: #fff;
            }

            /* Menyesuaikan warna tombol pada hover */
            .btn:hover {
                background-color: #138496;
            }

            /* Menyesuaikan warna tabel */
            table {
                color: #fff;
            }

            /* Menyesuaikan warna latar belakang tbody pada tabel */
            tbody {
                background: #1e1e1e;
            }

            /* Menyesuaikan warna tombol pada formulir pencarian */
            .form-inline button {
                background-color: #17a2b8;
                color: #fff;
            }

            /* Menyesuaikan warna tombol pada hover pada formulir pencarian */
            .form-inline button:hover {
                background-color: #138496;
            }

            /* Menyesuaikan warna teks pada kolom "GAMBAR," "JUDUL," "CONTENT," dan "AKSI" */
            th, td {
                color: #fff;
            }

            .pagination {
            justify-content: flex-end;
            margin-top: 20px;
            }

            .pagination > li > a,
            .pagination > li > span {
                color: #fff;
                background-color: #343a40;
                border: 1px solid #262929;
                margin: 0 3px; /* Adjust margin as needed */
            }

            .pagination > li > a:hover,
            .pagination > li > span:hover,
            .pagination > li > a:focus,
            .pagination > li > span:focus {
                color: #fff;
                background-color: #262929;
                border: 1px solid #262929;
            }

            .pagination > .active > a,
            .pagination > .active > span,
            .pagination > .active > a:hover,
            .pagination > .active > span:hover,
            .pagination > .active > a:focus,
            .pagination > .active > span:focus {
                color: #fff;
                background-color: #262929;
                border: 1px solid #262929;
            }
        </style>
    </head>
<body>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <a href="{{ route('pembayaran.create') }}" class="btn btn-md btn-success mb-3">TAMBAH PEMBAYARAN</a>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">NO</th>
                                    <th scope="col">ID Siswa</th>
                                    <th scope="col">Tanggal Bayar</th>
                                    <th scope="col">Jumlah Bayar</th>
                                    <th scope="col">Aksi</th>

                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pembayarans as $index => $pembayaran)
                                    <tr>
                                        <td>{{ $pembayarans->firstItem() + $index }}</td>
                                        <td>{{ $pembayaran->siswa->nama }}</td>
                                        <td>{{ $pembayaran->tgl_bayar }}</td>
                                        <td>Rp {{ number_format($pembayaran->jumlah_bayar, 0, ',', '.') }}</td>
                                        <td class="text-left">
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('pembayaran.destroy', $pembayaran->id) }}" method="POST">
                                                <a href="{{ route('pembayaran.edit', $pembayaran->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                                <a href="{{ route('pembayaran.history', $pembayaran->id) }}" class="btn btn-sm btn-info">HISTORY</a>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">No records found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $pembayarans->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        //message with toastr
        @if(session()->has('success'))

            toastr.success('{{ session('success') }}', 'BERHASIL!');

        @elseif(session()->has('error'))

            toastr.error('{{ session('error') }}', 'GAGAL!');

        @endif
    </script>

</body>
</html>

@endsection
