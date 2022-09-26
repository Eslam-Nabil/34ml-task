<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Option extends Model
{
    use HasFactory;
    protected $table ='options';
    protected $casts = [
        'value' => 'array'
    ];
    protected $fillable = [

        'name','value','product_id'
    ];
    protected $hidden = [

        'updated_at','created_at'
    ];
    public function product()
    {
        return $this->hasOne(Product::class);
    }

}
