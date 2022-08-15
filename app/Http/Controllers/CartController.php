<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Size;
use Cart;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cartitems = Cart::getContent(); 
        $sizes = Size::pluck('code','id')->toArray();
        //dd($sizes);
        $total = number_format(Cart::getSubTotal(),2);
        return view('pantoneclo.cart', compact('cartitems','total','sizes'));
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
    public function addToCart(Request $request)
    {
        if($request->ajax()){
            $slug = $request->slug;
            $size = $request->size;

            $product = Product::where('slug',$slug)
                            ->where('status',1)
                            ->first();

            $size = Size::where('id',$size)->first();
            
            if($request->quantity){
                $quantity = $request->quantity;
            }else{
                $quantity = 1;
            }

            $id = $product->id;
            $name = $product->name;
            $price = $product->sale_price;
            $image = $product->image;
                        
            $cart = Cart::add([
                'id' => $id.$size->id,
                'name' => $name." (".$size->code.")",
                'price' => $price,
                'quantity' => $quantity,
                'attributes' => [
                    'product_id' => $id,
                    'discount_amount' => $product->discount_amount,
                    'discount_percentage' => $product->discount_percentage,
                    'image' => $image,
                    'size_id' => $size->id,
                    //'size' => $size->code,
                    'color' => $product->color->name,
                    'colorCode' => $product->color->code,
                    'currency' => '$'
                ]
            ]);

            $cartTotal = number_format(Cart::getSubTotal(),2);
            $cartTotalQuantity = Cart::getTotalQuantity();
            return response()->json(['cartTotal' => $cartTotal,'cartTotalQuantity' => $cartTotalQuantity]);
        }
    }

   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function clearCart(Request $request)
    {
        if($request->ajax()){
            Cart::clear();
            $cartTotal = number_format(Cart::getSubTotal(),2);
            $cartTotalQuantity = Cart::getTotalQuantity();
            return response()->json(['cartTotal' => $cartTotal,'cartTotalQuantity' => $cartTotalQuantity,'message'=>'Cart has been cleared Successfully!']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function itemUpdate(Request $request)
    {
        if($request->ajax()){
            Cart::update($request->itemId,[
                'quantity' => [
                    'relative' => false,
                    'value' => $request->quantity,
                ]
            ]);

            $summedPrice = Cart::get($request->itemId)->getPriceSum();
            $cartTotal = number_format(Cart::getSubTotal(),2);
            $cartTotalQuantity = Cart::getTotalQuantity();
            return response()->json(['price' => number_format($summedPrice,2),'cartTotal' => $cartTotal,'cartTotalQuantity' => $cartTotalQuantity,'message'=>'Item has been updated Successfully!']);
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if($request->ajax()){
            $items = $request->items;
            $updatedItems = [];
            foreach($items as $item){
                Cart::update($item['itemId'],[
                    'quantity' => [
                        'relative' => false,
                        'value' => $item['quantity'],
                    ]
                ]);
                $summedPrice = Cart::get($item['itemId'])->getPriceSum();
                $updatedItems[] = [
                    'itemId' => $item['itemId'],
                    'quantity' => $item['quantity'],
                    'price' => number_format($summedPrice,2)
                ];
            }
            
            $items = json_encode($updatedItems);
            $cartTotal = number_format(Cart::getSubTotal(),2);
            $cartTotalQuantity = Cart::getTotalQuantity();
            return response()->json(['items' => $items,'cartTotal' => $cartTotal,'cartTotalQuantity' => $cartTotalQuantity,'message'=>'Item has been updated Successfully!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    { 
        if($request->ajax()){
            $cartRemove = Cart::remove($request->itemId);
            $cartTotal = number_format(Cart::getSubTotal(),2);
            $cartTotalQuantity = Cart::getTotalQuantity();
            return response()->json(['cartTotal' => $cartTotal,'cartTotalQuantity' => $cartTotalQuantity,'message'=>'Item has been deleted Successfully!']);
        }
    }
}
