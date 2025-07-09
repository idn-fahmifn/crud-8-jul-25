<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Buku::all();
        $kategori = Kategori::all();
        return view('buku.index', compact('data', 'kategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'judul' => ['required', 'string', 'min:5', 'max:50'],
                'kategori' => ['required', 'numeric'],
                'penerbit' => ['required', 'string', 'min:5', 'max:50'],
                'cover' => ['required', 'file', 'max:10240', 'mimes:png,jpg,jpeg,svg,heic'],
                'penulis' => ['required', 'string', 'min:5', 'max:50'],
                'isbn' => ['required', 'string', 'min:3', 'max:10'],
                'deskripsi' => ['required'],
            ],
            // pesan error
            [
                // judul
                'judul.required' => 'Judul wajib diisi',
                'judul.string' => 'Judul isi dengan huruf dan angka',
                'judul.min' => 'Judul minimal 5 karakter',
                'judul.max' => 'Judul maksimal 50 karakter',

                // kategori
                'kategori.required' => 'Kategori wajib diisi',
                'kategori.numeric' => 'Pilih judul pada option',

                // penerbit
                'penerbit.required' => 'Penerbit wajib diisi',
                'penerbit.string' => 'Penerbit isi dengan huruf dan angka',
                'penerbit.min' => 'Penerbit minimal 5 karakter',
                'penerbit.max' => 'Penerbit maksimal 50 karakter',

                // cover
                'cover.required' => 'Cover wajib diisi',
                'cover.file' => 'Cover wajib berupa file',
                'cover.mimes' => 'file yang diizinkan (png,jpg,jpeg,svg,heic)',
                'cover.max' => 'Ukuran file hanya 10 MB',

                // penulis
                'penulis.required' => 'Penulis wajib diisi',
                'penulis.string' => 'Penulis isi dengan huruf dan angka',
                'penulis.min' => 'Penulis minimal 5 karakter',
                'penulis.max' => 'Penulis maksimal 50 karakter',

                // isbn
                'isbn.required' => 'ISBN wajib diisi',
                'isbn.string' => 'ISBN isi dengan huruf dan angka',
                'isbn.min' => 'ISBN minimal 5 karakter',
                'isbn.max' => 'ISBN maksimal 50 karakter',

                'deskripsi.required' => 'Deskripsi wajib diisi'
            ]
        );

        // kondisi cek apabila terdapat file yang diupload di form.
        if ($request->hasFile('cover')) {
            $gambar = $request->file('cover'); //mengambil gambar di key cover
            $path = 'public/images/cover'; //path tempat menyimpan buku
            $format = $gambar->getClientOriginalExtension(); //mengambil format file yang diupload
            $nama = 'cover-buku' . Carbon::now()->format('dmyhis') . '.' . $format; //nama file ketika diupload
            $gambar->storeAs($path, $nama); //menyimpan gambar dengan path dan nama yang sudah ditentukan.
        }

        // return $request;

        Buku::create([
            'id_kategori' => $request->kategori,
            'judul_buku' => $request->judul,
            'penerbit' => $request->penerbit,
            'cover' => $nama,
            'penulis' => $request->penulis,
            'isbn' => $request->isbn,
            'deskripsi' => $request->deskripsi
        ]);

        return back()->with('success', 'Buku berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = Buku::find($id);
        $kategori = Kategori::all();
        return view('buku.detail', compact('data', 'kategori'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $data = Buku::find($id);
        $input = $request->all();

        $request->validate(
            [
                'judul' => ['required', 'string', 'min:5', 'max:50'],
                'kategori' => ['required', 'numeric'],
                'penerbit' => ['required', 'string', 'min:5', 'max:50'],
                'cover' => ['file', 'max:10240', 'mimes:png,jpg,jpeg,svg,heic'],
                'penulis' => ['required', 'string', 'min:5', 'max:50'],
                'isbn' => ['required', 'string', 'min:3', 'max:10'],
                'deskripsi' => ['required'],
            ],
            // pesan error
            [
                // judul
                'judul.required' => 'Judul wajib diisi',
                'judul.string' => 'Judul isi dengan huruf dan angka',
                'judul.min' => 'Judul minimal 5 karakter',
                'judul.max' => 'Judul maksimal 50 karakter',

                // kategori
                'kategori.required' => 'Kategori wajib diisi',
                'kategori.numeric' => 'Pilih judul pada option',

                // penerbit
                'penerbit.required' => 'Penerbit wajib diisi',
                'penerbit.string' => 'Penerbit isi dengan huruf dan angka',
                'penerbit.min' => 'Penerbit minimal 5 karakter',
                'penerbit.max' => 'Penerbit maksimal 50 karakter',

                // cover
                'cover.file' => 'Cover wajib berupa file',
                'cover.mimes' => 'file yang diizinkan (png,jpg,jpeg,svg,heic)',
                'cover.max' => 'Ukuran file hanya 10 MB',

                // penulis
                'penulis.required' => 'Penulis wajib diisi',
                'penulis.string' => 'Penulis isi dengan huruf dan angka',
                'penulis.min' => 'Penulis minimal 5 karakter',
                'penulis.max' => 'Penulis maksimal 50 karakter',

                // isbn
                'isbn.required' => 'ISBN wajib diisi',
                'isbn.string' => 'ISBN isi dengan huruf dan angka',
                'isbn.min' => 'ISBN minimal 5 karakter',
                'isbn.max' => 'ISBN maksimal 50 karakter',

                'deskripsi.required' => 'Deskripsi wajib diisi'
            ]
        );


        $edit = [
            'id_kategori' => $request->input('kategori'),
            'judul_buku' => $request->input('judul'),
            'penerbit' => $request->input('penerbit'),
            'penulis' => $request->input('penulis'),
            'isbn' => $request->input('isbn'),
            'deskripsi' => $request->input('kategori'),
        ];
        // kondisi cek apabila terdapat file yang diupload di form.
        if ($request->hasFile('cover')) {
            $gambar = $request->file('cover'); //mengambil gambar di key cover
            $path = 'public/images/cover'; //path tempat menyimpan buku
            $format = $gambar->getClientOriginalExtension(); //mengambil format file yang diupload
            $nama = 'cover-buku' . Carbon::now()->format('dmyhis') . '.' . $format; //nama file ketika diupload
            $gambar->storeAs($path, $nama); //menyimpan gambar dengan path dan nama yang sudah ditentukan.

            // menghapus data lama dari local storage;
            // Storage::delete('public/images/cover/'.$data->cover);

            if ($data->cover && Storage::disk('public')->exists('public/images/cover'));
            Storage::delete('public/images/cover/' . $data->cover);
            $edit['cover'] = $nama;
        }
        $data->update($edit);
        return back()->with('success', 'Buku berhasil dibuat');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Buku::find($id);
        $data->delete();
        Storage::delete('public/images/cover/' . $data->cover);

        return redirect()->route('buku.index')->with('success', 'Data berhasil dihapus');
    }
}
