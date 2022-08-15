<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Product;
use App\Models\Size;
use App\Models\Address;
use App\Mail\PlaceOrder;
use App\Models\Shipping;
use App\Models\Billing;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Mail;
use Cart;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {//$cartitems = Cart::getContent();dd($cartitems);
        //return config('orderstatus.PAID');
        if(!Cart::isEmpty()){
            $cartitems = Cart::getContent();
            $sizes = Size::pluck('code','id')->toArray();
            //dd($sizes);
            $total = number_format(Cart::getSubTotal(),2);
            $countries = Country::select('id','name','iso2')->get();
            return view('pantoneclo.checkout',compact('countries','cartitems','sizes','total'));
        } else {
            return redirect()->back();
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function state(Request $request)
    {
        if($request->ajax()){
            $states = State::select('id','name')->where('country_id',$request->country_id)->get()->toJson();
            return response()->json(['states' => $states,'success' => true]);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function city(Request $request)
    {
        if($request->ajax()){
            $states = City::select('id','name')->where('state_id',$request->state_id)->get()->toJson();
            return response()->json(['cities' => $states,'success' => true]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Billing $billing, Shipping $shipping, Order $order)
    {   //return $request->all();
        $validator = Validator::make($request->all(), [
            'billing_first_name' => ['required', 'string'],
            'billing_last_name' => ['required','string'],
            'billing_email' => ['required','email'],
            'billing_phone' => ['nullable','string'],
            'billing_street' => ['required','string'],
            'billing_street2' => ['nullable','string'],
            'billing_country_id' => ['required',],
            'billing_state_id' => ['required',],
            'billing_city_id' => ['nullable',],
            'billing_zip' => ['required'],
        ]);

        if($validator->fails()){
            return $validator->validate()->withInput();
        } else {
            if(!Cart::isEmpty()){
                if($request->is_same == 1){
                    $billing->name = $request->billing_first_name ." ". $request->billing_last_name;
                    $billing->email = $request->billing_email;
                    $billing->street = $request->billing_street;
                    $billing->street2 = $request->billing_street2;
                    $billing->country_id = $request->billing_country_id;
                    $billing->state_id = $request->billing_state_id;
                    $billing->city_id = $request->billing_city_id;
                    $billing->zip = $request->billing_zip;

                    $shipping->name = $request->billing_first_name ." ". $request->billing_last_name;
                    $shipping->email = $request->billing_email;
                    $shipping->street = $request->billing_street;
                    $shipping->street2 = $request->billing_street2;
                    $shipping->country_id = $request->billing_country_id;
                    $shipping->state_id = $request->billing_state_id;
                    $shipping->city_id = $request->billing_city_id;
                    $shipping->zip = $request->billing_zip;
                
                }
                if($request->is_same == 0){
                    $billing->name = $request->billing_first_name ." ". $request->billing_last_name;
                    $billing->email = $request->billing_email;
                    $billing->street = $request->billing_street;
                    $billing->street2 = $request->billing_street2;
                    $billing->country_id = $request->billing_country_id;
                    $billing->state_id = $request->billing_state_id;
                    $billing->city_id = $request->billing_city_id;
                    $billing->zip = $request->billing_zip;

                    $shipping->name = $request->shipping_first_name ." ". $request->shipping_last_name;
                    $shipping->email = $request->shipping_email;
                    $shipping->street = $request->shipping_street;
                    $shipping->street2 = $request->shipping_street2;
                    $shipping->country_id = $request->shipping_country_id;
                    $shipping->state_id = $request->shipping_state_id;
                    $shipping->city_id = $request->shipping_city_id;
                    $shipping->zip = $request->shipping_zip;
                
                }

                if($billing->save() && $shipping->save()) {
                    $cartitems = Cart::getContent();
                    $sizes = Size::pluck('code','id')->toArray();

                    $order->user_id = auth()->user()->id;
                    $order->billing_id = $billing->id;
                    $order->shipping_id = $shipping->id;
                    $order->subtotal = Cart::getSubTotal();
                    $order->total = Cart::getTotal();
                    $order->quantity = Cart::getTotalQuantity();
                    $order->date = date("Y-m-d");
                    $order->shipping_date = date("Y-m-d",strtotime("+7 day", strtotime($order->date)));
                    $order->shipping_charge = 0;
                    $order->status = 1;

                    if($order->save()){
                        $order->order_number = date('Y').str_pad($billing->id.$shipping->id.$order->id,5,0,STR_PAD_LEFT).date('md');
                        $order->where('id',$order->id)->update(['order_number'=>$order->order_number]);

                        foreach($cartitems as $item){
                            $orderitem['order_id'] = $order->id;
                            $orderitem['product_id'] = $item->attributes->product_id;
                            $orderitem['product_price'] = $item->price;
                            $orderitem['quantity'] = $item->quantity;
                            $orderitem['unit'] = $item->unit;
                            $orderitem['weight'] = $item->weight;
                            $orderitem['color'] = $item->color;
                            $size = Size::find($item->size_id);
                            $orderitem['size'] = $size;
                            $orderitem['total_price'] = $item->getPriceSum();
                            $orderitem['discount_amount'] = $item->attributes->discount_amount;
                            OrderItem::create($orderitem);

                        }

                        Mail::to($shipping->email)->send(new PlaceOrder($order));

                        Cart::clear();
                        return redirect()->route('checkout.payment',encrypt($order->id));
                    }
                    
                }
            } else {
                return redirect()->route('cart');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function payment($id)
    {//return $id;
        $order = decrypt($id);
        $order = Order::findOrFail($order);
        $order_id = encrypt($order->id);
        return view('pantoneclo.payment', compact('order','order_id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function purchage(Request $request)
    {
        $order_id = decrypt($request->order_id);
        $checkOrderStatus = Order::where('id',$order_id)->pluck('status'); 
        if(isset($checkOrderStatus->status) && $checkOrderStatus->status == 2){
            return redirect()->back();
        }
        if(isset($request->order_id)){
            Order::where('id',$order_id)->update(['status' => config('orderstatus.PAID'),'payment_method' => $request->payment_method]);
            return view('pantoneclo.purchaged',['message'=>'Your order has been purchaged successfully!']);
        } else {
            return redirect()->back();
        }
        
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
