<?php

namespace Database\Seeders;

use App\Models\Option;
use App\Models\Product;
use App\Models\Variant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VariantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products=Product::get();
        foreach($products as  $prod ){
            $options_size=Option::select('value')->where(['product_id'=>$prod->id,'name'=>'size'])->first();
            $options_color=Option::select('value')->where(['product_id'=>$prod->id,'name'=>'color'])->first();
            $c=0;
                foreach($options_color->value as $color ){
                    foreach($options_size->value as $size){
                        $c++;
                        DB::table('variants')->insert([
                            'title'=>'variant '.$c.' - '.$prod->title,
                            'option1'=>$color,
                            'option2'=>$size,
                            'price'=>rand(10,100),
                            'stock'=>5,
                            'is_in_stock'=>true,
                            'product_id'=>$prod->id,
                            'created_at' => date("Y-m-d H:i:s"),
                            'updated_at' => date("Y-m-d H:i:s")
                        ]);
                    }
                }
            }
            foreach($products as  $prod ){
            $var=Variant::where('product_id',$prod->id)->orderBy('price','asc')->first();
             Product::where('id',$prod->id)->update(['default_variant'=>$var->id]);
            }
    }
}
