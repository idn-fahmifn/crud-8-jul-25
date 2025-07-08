<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\B;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Kategori::all();
        return view('kategori.index', compact('data'));
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
        // mengambil semua nilai yang dibawa oleh Request.
        $input = $request->all();
        // validator jika gagal
        $validator = Validator::make($input, [
            'nama_kategori' => ['required', 'string', 'min:5', 'max:30']
        ], [
            'nama_kategori.required' => 'Field nama kategori wajib diisi.',
            'nama_kategori.string' => 'Field nama kategori karakter.',
            'nama_kategori.min' => 'Field nama kategori minimal 5 karakter.',
            'nama_kategori.max' => 'Field nama kategori maksimal 30 karakter.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        Kategori::create($input);
        return back()->with('success', 'Kategori berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = Kategori::find($id);
        $buku = Buku::where('id_kategori', $id)->get();
        return view('kategori.detail', compact('data', 'buku'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori $kategori)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // mengambil semua nilai yang dibawa oleh Request.
        $input = $request->all();
        $data = Kategori::find($id);

        // validator jika gagal
        $validator = Validator::make($input, [
            'nama_kategori' => ['required', 'string', 'min:5', 'max:30']
        ], [
            'nama_kategori.required' => 'Field nama kategori wajib diisi.',
            'nama_kategori.string' => 'Field nama kategori karakter.',
            'nama_kategori.min' => 'Field nama kategori minimal 5 karakter.',
            'nama_kategori.max' => 'Field nama kategori maksimal 30 karakter.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        // shorthand (kurang rekomended untuk keamanan)
        $data->update($input);

        // cara mas bagir (recomended)
        // $data->update([
        //     'category' => $request->nama_kategori
        // ]);

        return back()->with('success', 'Kategori berhasil dibuat');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Kategori::find($id);
        $data->delete();
        return redirect()->route('kategori.index')
        ->with('success', 'Kategori Berhasil Dihapus');
    }
}
