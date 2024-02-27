@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Data Siswa - Rio</title>
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

            a {
                color: #17a2b8; /* Warna teks untuk link */
            }

            .btn {
                background-color: #17a2b8; /* Warna tombol */
                color: #fff;
            }

            .btn:hover {
                background-color: #138496; /* Warna tombol pada hover */
            }

            table {
                color: #fff; /* Warna teks pada tabel */
            }

            tbody {
                background: #1e1e1e; /* Warna latar belakang tbody pada tabel */
            }

            .form-inline button {
                background-color: #17a2b8; /* Warna tombol pada formulir pencarian */
                color: #fff;
            }

            .form-inline button:hover {
                background-color: #138496; /* Warna tombol pada hover pada formulir pencarian */
            }

            th, td {
                color: #fff; /* Warna teks pada kolom "GAMBAR," "NAMA," "KELAS," dan "AKSI" */
            }
        </style>
    </head>
    <body>

        <div class="container mt-5 mb-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="card border-0 shadow rounded">
                        <div class="card-body">
                            <form action="{{ route('pembayaran.update', $data->id) }}" method="POST" enctype="multipart/form-data">

                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label class="font-weight-bold">Nama Siswa</label>
                                    <select class="form-control" name="id_siswa" id="namaDropdown">
                                        <option value="">Select Nama Siswa</option>
                                        @foreach($siswah as $siswa)
                                            <option value="{{ $siswa->id }}" {{ $siswa->id == $data->id_siswa ? 'selected' : '' }}>{{ $siswa->nama }} ({{ $siswa->kelas }})</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-bold">Tanggal Bayar</label>
                                    <input type="date" class="form-control @error('tgl_bayar') is-invalid @enderror" name="tgl_bayar" value="{{ old('tgl_bayar', $data->tgl_bayar) }}" placeholder="Masukkan Tanggal Bayar">

                                    @error('tgl_bayar')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-bold">Jumalah Bayar</label>
                                    <input type="text" class="form-control @error('jumlah_bayar') is-invalid @enderror" name="jumlah_bayar" value="{{ old('jumlah_bayar', $data->jumlah_bayar) }}" placeholder="Masukkan Jumalah Bayar">

                                    @error('jumlah_bayar')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-md btn-primary">Update</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
        <script>
            CKEDITOR.replace( 'content' );
        </script>
    </body>
</html>

@endsection
