{{-- memanggil halaman template --}}
@extends('template.template')

@section('content')
    <div class="container">
        <div class="card p-2">

            <div class="card-header bg-white mb-4 d-flex justify-content-between">

                {{-- card-title --}}
                <div class="card-title h4">Kategori {{ $data->nama_kategori }}</div>

                {{-- area-button --}}

                <form action="{{route('kategori.destroy', $data->id)}}" method="post">
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

                {{-- menampilkan tabel kategori --}}
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <th>Judul Buku</th>
                            <th>Penerbit</th>
                            <th>Penulis</th>
                            <th>Pilihan</th>
                        </thead>
                        <tbody>

                            @foreach ($buku as $item)
                                <tr>
                                    <td>{{$item->judul_buku}}</td>
                                    <td>{{$item->penerbit}}</td>
                                    <td>{{$item->penulis}}</td>
                                    <td>
                                        <a href="{{route('buku.show', $item->id)}}" class="btn">Detail</a>
                                    </td>
                                </tr>
                            @endforeach

                            @if ($buku->isEmpty())
                                <tr>
                                    <td colspan="4" class="text-center py-4">Buku belum ditambahkan pada kategori ini.</td>
                                </tr>
                            @endif
                        </tbody>


                    </table>
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
