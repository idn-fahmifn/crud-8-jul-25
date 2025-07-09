<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;

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
        $request->validate([
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
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
