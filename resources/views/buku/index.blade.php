{{-- memanggil halaman template --}}
@extends('template.template')

@section('content')
    <div class="container">
        <div class="card p-2">

            <div class="card-header bg-white mb-4 d-flex justify-content-between">

                {{-- card-title --}}
                <div class="card-title h4">Data Buku</div>

                {{-- area-button --}}
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    tambah
                </button>

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
                            <th>Kategori</th>
                            <th>Pilihan</th>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $item->judul_buku }}</td>
                                    <td>{{ $item->penerbit }}</td>
                                    <td>{{ $item->kategori->nama_kategori }}</td>
                                    <td>
                                        <a href="{{ route('buku.show', $item->id) }}" class="btn">Detail</a>
                                    </td>
                                </tr>
                            @endforeach
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Buku Baru</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ route('buku.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        {{-- judul buku --}}
                        <div class="form-group mt-2">
                            <label for="" class="form-label">Judul Buku</label>
                            <input type="text" name="judul" required class="form-control">
                        </div>

                        {{-- kategori buku --}}
                        <div class="form-group mt-2">
                            <label for="" class="form-label">Kategori</label>
                            <select name="kategori" required class="form-control">
                                <option value="">Pilih Kategori</option>
                                @foreach ($kategori as $item)
                                    <option value="{{$item->id}}">{{$item->nama_kategori}}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Penerbit buku --}}
                        <div class="form-group mt-2">
                            <label for="" class="form-label">Penerbit</label>
                            <input type="text" name="penerbit" required class="form-control">
                        </div>

                        {{-- Cover buku --}}
                        <div class="form-group mt-2">
                            <label for="" class="form-label">Cover Buku</label>
                            <input type="file" name="cover" accept="image/*" required class="form-control">
                        </div>

                        {{-- Penulis buku --}}
                        <div class="form-group mt-2">
                            <label for="" class="form-label">Penulis Buku</label>
                            <input type="text" name="penulis" required class="form-control">
                        </div>

                        {{-- isbn --}}
                        <div class="form-group mt-2">
                            <label for="" class="form-label">ISBN</label>
                            <input type="text" name="isbn" required class="form-control">
                        </div>

                        {{-- deskripsi --}}
                        <div class="form-group mt-2">
                            <label for="" class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control"></textarea>
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
