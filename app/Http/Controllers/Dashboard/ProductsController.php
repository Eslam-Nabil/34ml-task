<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Option;
use App\Models\Product;
use App\Models\Variant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Dashboard\ProductsController;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=Product::with('options')->get();
        $options=Option::all();

        return view('view-products',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $products=Product::get();

        $data=$request->all();
        if(!empty($data)){
        $filter=$data['filter'];

        if(array_key_exists('average_rating',$filter)){

            foreach($products as $prod){
                $row=Product::where(['id'=>$prod->id,'average_rating'=>$filter['average_rating']])
                ->with(['default_variant' => function($query) use ($filter){
                    $query->where('id',$prod->default_variant)->orderBy('price','ASC')->first();
                }])->with('options')->get();
                $products_array[]=$row;
            };

        }elseif(array_key_exists('max_price',$filter)){

            foreach($products as $prod){
                $row=Product::where('id',$prod->id)->with(['variant' => function($query) use ($filter,$prod){
                     $query->where('price','<=',$filter['max_price'])->get();
                }])->with('options')->get();
                $products_array[]=$row;
             }

        }else{
            foreach($products as $prod){
                $row=Product::where('id',$prod->id)->with(['variant' => function($query) use ($filter){
                     $query->where([
                        'option1'=>explode(',',$filter['options'])[0],
                        'option2'=>explode(',',$filter['options'])[1]
                        ])->get();
                }])->with('options')->get();
                $products_array[]=$row;
             }

        }
        }else{
            ## All products With no filter
        foreach($products as $prod){
           $row=Product::where('id',$prod->id)->with(['default_variant' => function($query) use ($prod){
                $query->where('product_id',$prod->id)->orderBy('price','ASC')->first();
           }])->with('options')->get();
           $products_array[]=$row;
        }
    }
        return response()->json(['success' => true, 'data' => $products_array], 200);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function test()
    {
        $products=Product::get();
        foreach($products as  $prod ){
            return  Variant::where('product_id',$prod->id)->orderBy('price','asc')->first();
                $a[]=$var;
        }
        return response()->json(['success' => true,'data' =>$a], 200);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
