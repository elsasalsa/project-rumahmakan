<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::all(); // Mengambil semua data order, sesuaikan dengan kebutuhan
        return view("order.index", compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $produks = Produk::orderBy('produk')->get();
        $produks = Produk::all();

        return view('order.create', compact('produks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_customer' => 'required',
            'produks' => 'required',
        ]);
        //sediakan array untuk menyimpan data-data dgn format json
        $arr = [];
        //distinct array
        $produks = array_count_values($request->produks);
        //foreach request produks yg sudah dihtung duplikasinya
        foreach($produks as $idValueSelect => $countDuplicate) {
            //elequent model search berdasarkan id
            $produk = Produk::find($idValueSelect);
            $formatAssoc = [
                "id" => $idValueSelect,
                "name_produk" => $produk['produk'],
                "price" => $produk['harga'],
                //qty diambil dari item hasi distrinct array_count_values yg dideklarasikan sebagai 
                "qty" => $countDuplicate,
                "sub_price" => $countDuplicate * $produk['harga'],
            ];
            array_push($arr, $formatAssoc);
        }
        //hitung total bayar
        $totalBayar = 0;
        foreach ($arr as $itemAssoc) {
            $totalBayar += (int)$itemAssoc['sub_price'];
            //int -> untuk merubah tipe data menjadi integer
            // += menambahkan bukan mengganti
        }
        $totalBayar +=($totalBayar*0.1);

        //insert data ke db
        $proses = Order::create([
            // "user_id" => Auth::user()->id,
            //isi column produk di diambil yg sudah berformat json/assoc
            "produks" => $arr,
            "total_price" => $totalBayar,
            "name_customer" => $request->name_customer,
        ]);

        return redirect()->route('order.index')->with('success', 'Berhasil menambahkan data!');
    }




    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $order = Order::where('id', $id)->first();
        //atau bisa dgn order::find($id) kalau yg dicari itu berdasarkan id nya

        return view('order.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
