<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
        $user = User::findOrFail(auth()->user()->id);
        $addresses = Address::where('user_id',auth()->user()->id)->latest()->get();
        $totalOrders = Order::where('user_id',auth()->user()->id)->latest()->count();
        $orders = Order::where('user_id',auth()->user()->id)->latest()->take(1)->get();
        $paymentOrders = Order::where('user_id',auth()->user()->id)
                        ->where('status',config('orders.insertStatus.paid'))->count();
        $awaitingDeliveryOrders = Order::where('user_id',auth()->user()->id)
                        ->where('status',config('orderstatus.insertStatus.awaitingDelivery'))->count();
        $shippedOrders = Order::where('user_id',auth()->user()->id)
                        ->where('status',config('orderstatus.Shipped'))->count();
        return view('pantoneclo.account',compact('user','totalOrders','orders','addresses','paymentOrders','awaitingDeliveryOrders','shippedOrders'));
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
    public function addressList()
    {
        $addresses = Address::where('user_id',auth()->user()->id)->latest()->simplePaginate(5);
        return view('pantoneclo.account.address',compact('addresses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addressCreate()
    {
        $countries = Country::select('id','name','iso2')->get();
        return view('pantoneclo.account.addressCreate', compact('countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addressStore(Request $request, Address $address)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => ['required', 'string'],
            'last_name' => ['required','string'],
            'email' => ['required','email'],
            'phone' => ['nullable','string'],
            'street' => ['required','string'],
            'street2' => ['nullable','string'],
            'country_id' => ['required',],
            'state_id' => ['required',],
            'city_id' => ['nullable',],
            'zip' => ['required'],
        ]);

        if($validator->fails()){
            return $validator->validate()->withInput();
        } else {
            $address->first_name = $request->first_name;
            $address->last_name = $request->last_name;
            $address->user_id = auth()->user()->id;
            $address->email = $request->email;
            $address->mobile = $request->mobile;
            $address->street = $request->street;
            $address->street2 = $request->street2;
            $address->country_id = $request->country_id;
            $address->state_id = $request->state_id;
            $address->city_id = $request->city_id;
            $address->zip = $request->zip;
            $address->type = $request->type;
            $address->is_default = isset($request->is_default) ? $request->is_default : 0;

            if($address->save()){
                return redirect()->route('account.address')->with('success', 'Address has been created successfully!');
            }
        }
    }

    public function addressEdit($id){
        $address = Address::findOrFail($id);
        $countries = Country::select('id','name','iso2')->get();
        $state = State::select('id','name')->where('id',$address->state_id)->first();
        $city = City::select('id','name')->where('id',$address->city_id)->first();
        return view('pantoneclo.account.addressEdit', compact('address','countries','state','city'));
    }

    public function addressUpdate(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'first_name' => ['required', 'string'],
            'last_name' => ['required','string'],
            'email' => ['required','email'],
            'mobile' => ['required','string'],
            'street' => ['required','string'],
            'street2' => ['nullable','string'],
            'country_id' => ['required',],
            'state_id' => ['required',],
            'city_id' => ['nullable',],
            'zip' => ['required'],
        ]);

        if($validator->fails()){
            return $validator->validate()->withInput();
        } else {
            $address['first_name'] = $request->first_name;
            $address['last_name'] = $request->last_name;
            $address['user_id'] = auth()->user()->id;
            $address['email'] = $request->email;
            $address['mobile'] = $request->mobile;
            $address['street'] = $request->street;
            $address['street2'] = $request->street2;
            $address['country_id'] = $request->country_id;
            $address['state_id'] = $request->state_id;
            $address['city_id'] = $request->city_id;
            $address['zip'] = $request->zip;
            $address['type'] = $request->type;
            $address['is_default'] = isset($request->is_default) ? $request->is_default : 0;
            $addressUpdate = Address::where('id',$id)->update($address);
            if($addressUpdate){
                return redirect()->route('account.address')->with('success', 'Address has been updated successfully!');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addressDestroy(Request $request, $id)
    {
        Address::findOrFail($id)->forceDelete();
        return redirect()->back()->with('success','Address has been deleted successfully!');
    }
}
