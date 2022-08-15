<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Product;
use App\Models\Size;
use App\Models\Address;
use App\Models\Shipping;
use App\Models\Billing;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Cart;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sizes = Size::pluck('code','id')->toArray();
        $user = User::findOrFail(auth()->user()->id);
        $addresses = Address::where('user_id',auth()->user()->id)->latest()->get();
        $totalOrders = Order::where('user_id',auth()->user()->id)->latest()->count();
        $orders = Order::where('user_id',auth()->user()->id)->latest()->take(1)->get();
        $paymentOrders = Order::where('user_id',auth()->user()->id)
                        ->where('status',config('orderstatus.PAID'))->count();
        $awaitingDeliveryOrders = Order::where('user_id',auth()->user()->id)
                        ->where('status',config('orderstatus.AWAITING_DELIVERY'))->count();
        $shippedOrders = Order::where('user_id',auth()->user()->id)
                        ->where('status',config('orderstatus.Shipped'))->count();
        return view('pantoneclo.account',compact('user','sizes','totalOrders','orders','addresses','paymentOrders','awaitingDeliveryOrders','shippedOrders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function orders()
    {
        $orders = Order::where('user_id',auth()->user()->id)->latest()->cursorPaginate(2);
        return view('pantoneclo.account.orders', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function userEdit(Request $request)
    {
        if($request->ajax()){
            $user_id = $request->user_id;
            $user = User::findOrFail($user_id);
            return view('pantoneclo.account.useredit',compact('user'));
        }
        
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function userUpdate(Request $request)
    {
        if($request->ajax()){
            // $email = $request->email;
            // $name = $request->name;
            // $phone = $request->phone;
            User::where('id',$request->id)
                    ->update($request->except(['_token']));
            $user = User::findOrFail($request->id);
            return response()->json(['user'=>$user,'message'=>'User has been updated!']);
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
