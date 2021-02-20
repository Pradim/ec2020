<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Cart;

class OrderController extends Controller
{
    protected $order = null;
    protected $cart = null;

    public function __construct(Order $order, Cart $cart){
        $this->order = $order;
        $this->cart = $cart;
    }

    public function adminOrderList(){

        $this->order = $this->order->with('user')->paginate(12);
        return view('admin.order.index')->with('order_data', $this->order);
    }


    public function userOrderList(){

        $this->order = $this->order->with('user')->paginate(12);
        return view('user.order.index')->with('order_data', $this->order);
    }

    public function sellerOrderList(){

        $this->cart = $this->cart->with('user')->where('seller_id', request()->user()->id)->paginate(12);
        return view('seller.order.index')->with('cart_data', $this->cart);
    } 

    public function adminOrderCartList($order_code){
        $this->cart = $this->cart->with(['product','seller','user'])->where('order_code', $order_code)->paginate(12);
        return view('admin.order.cart')->with('cart_data', $this->cart);
    }

    public function userOrderCartList($order_code){
        $this->cart = $this->cart->with(['product','seller','user'])->where('order_code', $order_code)->paginate(12);
        return view('user.order.cart-list')->with('cart_data', $this->cart);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $this->order = $this->order->find($id);
        if(!$this->order){
            request()->session()->flash('error', 'Order Not Found');
            return redirect()->route('order.index');
        }
        $this->order->status = $request->status;
        $this->order->save();
        $request->session()->flash('success', 'Order updated Successfully');
        return redirect()->route('admin-order-list');
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
