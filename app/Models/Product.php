<?php

namespace App\Models;

use App\Models\Option;
use App\Models\Variant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $table ='Products';
    protected $fillable = [
        'title','average_rating'
    ];
    protected $hidden = [

        'updated_at','created_at'
    ];

    public function options()
    {
        return $this->hasMany(Option::class);
    }
    public function variant()
    {
        return $this->hasMany(Variant::class);
    }
    public function default_variant(){

        return $this->hasOne(Variant::class);
    }

}
