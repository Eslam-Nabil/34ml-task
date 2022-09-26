<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Variant extends Model
{
    use HasFactory;

    protected $table ='variants';
    protected $fillable = [

        'title','option1','option2','price','stock','is_in_stock','product_id'
    ];
    protected $hidden = [

        'updated_at','created_at'
    ];

    public function product()
    {
        return $this->hasOne(Product::class);
    }
}
