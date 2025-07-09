{{-- memanggil halaman template --}}
@extends('template.template')

@section('content')
    <div class="container">
        <div class="card p-2">

            <div class="card-header bg-white mb-4 d-flex justify-content-between">

                {{-- card-title --}}
                <div class="card-title h4">{{ $data->judul_buku }}</div>

                {{-- area-button --}}

                <form action="{{ route('buku.destroy', $data->id) }}" method="post">
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
                        <img src="{{asset('storage/images/cover/'.$data->cover)}}" alt="Cover" width="400">
                    </div>
                </div>



            </div>
        </div>
    </div>

    <div class="modal fade" id="formEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit {{$data->judul_buku}}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ route('buku.update', $data->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="modal-body">
                        {{-- judul buku --}}
                        <div class="form-group mt-2">
                            <label for="" class="form-label">Judul Buku</label>
                            <input type="text" name="judul" value="{{$data->judul_buku}}" required class="form-control">
                        </div>

                        {{-- kategori buku --}}
                        <div class="form-group mt-2">
                            <label for="" class="form-label">Kategori</label>
                            <select name="kategori" required class="form-control">
                                <option value="{{$data->id_kategori}}">{{$data->kategori->nama_kategori}}</option>
                                @foreach ($kategori as $item)
                                    <option value="{{$item->id}}">{{$item->nama_kategori}}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Penerbit buku --}}
                        <div class="form-group mt-2">
                            <label for="" class="form-label">Penerbit</label>
                            <input type="text" name="penerbit" value="{{$data->penerbit}}" required class="form-control">
                        </div>

                        {{-- Cover buku --}}
                        <div class="form-group mt-2">
                            <label for="" class="form-label">Cover Buku</label>
                            <input type="file" name="cover" accept="image/*" value="{{$data->cover}}" class="form-control">
                        </div>

                        {{-- Penulis buku --}}
                        <div class="form-group mt-2">
                            <label for="" class="form-label">Penulis Buku</label>
                            <input type="text" name="penulis" value="{{$data->penulis}}" required class="form-control">
                        </div>

                        {{-- isbn --}}
                        <div class="form-group mt-2">
                            <label for="" class="form-label">ISBN</label>
                            <input type="text" name="isbn" value="{{$data->isbn}}" class="form-control">
                        </div>

                        {{-- deskripsi --}}
                        <div class="form-group mt-2">
                            <label for="" class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control">
                                {{$data->deskripsi}}
                            </textarea>
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
