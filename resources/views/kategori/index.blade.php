{{-- memanggil halaman template --}}
@extends('template.template')

@section('content')
    <div class="container">
        <div class="card p-2">

            <div class="card-header bg-white mb-4 d-flex justify-content-between">

                {{-- card-title --}}
                <div class="card-title h4">Kategori buku</div>

                {{-- area-button --}}
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    tambah
                </button>

            </div>

            {{-- card bagian body --}}
            <div class="card-body">

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                        <strong>Sukses!</strong> {{session('success')}}.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                        <strong>Gagal!</strong>
                        <ol>
                            @foreach ($errors->all() as $item)
                                <li>{{$item}}</li>
                            @endforeach
                        </ol>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                {{-- menampilkan tabel kategori --}}
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <th>Nama Kategori</th>
                            <th>Pilihan</th>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{$item->nama_kategori}}</td>
                                    <td>
                                        <a href="{{route('kategori.show',$item->id)}}" class="btn">Detail</a>
                                    </td>
                                </tr>
                            @endforeach

                             @if ($data->isEmpty())
                                <tr>
                                    <td colspan="4" class="text-center py-4">kategori belu ada saat ini.</td>
                                </tr>
                            @endif

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah kategori Baru</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ route('kategori.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="" class="form-label">Nama Kategori</label>
                            <input type="text" name="nama_kategori" required class="form-control">
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
