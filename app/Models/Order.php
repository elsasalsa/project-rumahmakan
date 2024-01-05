<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_customer',
        'total_price',
        'produks',
    ];

    protected $casts = [
        "produks" => "array",
    ];

    
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id', 'id');
    }



    
}
