<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $produks = Produk::orderBy('produk', 'ASC')->simplePaginate(5);
            return ResponseFormatter::success(200,'Data Berhasil Didapatkan', $produks);
        } catch (\Throwable $th) {
            return ResponseFormatter::error(400, $th->getMessage());
        }
    

        return view("produk.index", compact('produks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("produk.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'produk' => 'required|min:3',
        'harga' => 'required|numeric',
    ]);

    Produk::create([
        'produk' => $request->produk,
        'harga' => $request->harga,
    ]);

    return redirect()->route('produk.index')->with('success', 'Berhasil menambahkan data!');
}

    /**
     * Display the specified resource.
     */
    public function show(Produk $produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produk $produk, $id)
    {
        $products = Produk::where('id', $id)->first();
        //atau bisa dgn product::find($id) kalau yg dicari itu berdasarkan id nya

        return view('produk.edit', compact('products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'produk' => 'required|min:3',
            'harga' => 'required|numeric',
        ]);

        Produk::where('id', $id)->update([
            'produk' => $request->produk,
            'harga' => $request->harga,
        ]);

        //redirect route akan mengembalikan halaman ke route dgn name terkait
        return redirect()->route('produk.index')->with('success', 'Berhasil mengubah data obat!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Produk::where('id', $id)->delete();

        return redirect()->back()->with('deleted', 'Berhasil menghapus data!');
    }
}
