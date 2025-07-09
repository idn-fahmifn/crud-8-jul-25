{{-- memanggil halaman template --}}
@extends('template.template')

@section('content')
    <div class="container">
        <div class="card p-2">

            <div class="card-header bg-white mb-4 d-flex justify-content-between">

                {{-- card-title --}}
                <div class="card-title h4">{{ $data->judul_buku }}</div>

                {{-- area-button --}}

                <form action="{{ route('kategori.destroy', $data->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formEdit">
                        edit
                    </button>
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus??')">hapus</button>
                </form>
            </div>

            {{-- card bagian body --}}
            <div class="card-body">

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                        <strong>Sukses!</strong> {{ session('success') }}.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                        <strong>Gagal!</strong>
                        <ol>
                            @foreach ($errors->all() as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ol>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="row">
                    <div class="col-md-6">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td>Judul Buku</td>
                                        <td>{{ $data->judul_buku }}</td>
                                    </tr>
                                    <tr>
                                        <td>Penulis</td>
                                        <td>{{ $data->penulis }}</td>
                                    </tr>
                                    <tr>
                                        <td>ISBN</td>
                                        <td>{{ $data->isbn }}</td>
                                    </tr>
                                    <tr>
                                        <td>Penerbit</td>
                                        <td>{{ $data->penerbit }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            {{$data->deskripsi}}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6">
                        gambar
                    </div>
                </div>



            </div>
        </div>
    </div>

    <div class="modal fade" id="formEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah kategori Baru</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ route('kategori.update', $data->id) }}" method="post">
                    @csrf
                    @method('put')

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="" class="form-label">Nama Kategori</label>
                            <input type="text" name="nama_kategori" value="{{ $data->nama_kategori }}" required
                                class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
