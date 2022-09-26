<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $products =  Product::all();
      $colors=['white','black','red','blue','green','pink','orange'];
      $sizes=['large','small','xlarge'];

        foreach ($products as $product => $val) {
            shuffle($colors);
            $array=[
                'name'=>'color',
                'value'=>json_encode(array_slice($colors,0,3)),
                'product_id'=>$val->id,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ];
            $array2=[
                'name'=>'size',
                'value'=>json_encode($sizes),
                'product_id'=>$val->id,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ];
            DB::table('options')->insert([$array,$array2]);
        }

    }
}
