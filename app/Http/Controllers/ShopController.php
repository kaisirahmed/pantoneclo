<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Size;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::where('status',1)->cursorPaginate(20);
        $categoryId = Category::pluck('parent_id');
        $categories = Category::whereNotIn('id',$categoryId)->get();
        return view('pantoneclo.shop',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function show($slug)
    {
        $product = Product::where('slug',$slug)->first();
        
        // $variant = $product->variant();
        // dd($variant->name);
        // if(!is_null($product)){
        //     $options = $product->options()->get();
        //     foreach($options as $option){
        //         $values  = $option->optionValues()->get();
        //         //dd($values);
        //     }
        // } else {
        //     $product = Product::where('slug',$slug)->first();
        // }


        return view('pantoneclo.products',compact('product'));        
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function categoryProducts($slug)
    {
        $products = Product::where(function($query) use ($slug){
            $query->whereHas('categories', function($query) use ($slug){
                $query->where('slug',$slug);
            });
        })->cursorPaginate(20);
        return view('pantoneclo.categoryshop',compact('products','slug'));        
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
