<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $product = null;
    protected $cart = null;
    public function __construct(Product $product, Cart $cart)
    {
        $this->product = $product;
        $this->cart = $cart;
    }


    public function addToCart(Request $request){
    	$this->product = $this->product->with('images')->find($request->prod_id);
    	if (!$this->product) {
    		return response()->json(['data'=>$request->all(), 'status'=>false, 'msg'=>'Sorry! Product does not exist']);
    	}
    	$quantity = $request->quantity;
    	$current_item = array(
    		'id' => $this->product->id,
    		'title' => $this->product->title,
    		'link' => route('product-detail', $this->product->slug),
    		'image' => asset('uploads/product/Thumb-'.$this->product->images[0]['image_name']),
    		'price' => $this->product->price,
    		'seller_id' => $this->product->vendor_id
    	);
    	$price = $this->product->price;
    	if ($this->product->discount > 0) {
    		$price = $price - (($price * $this->product->discount)/100);
    	}
    	$current_item['actual_price'] = $price;
    	$cart = (session('cart') != null) ? session('cart') : array();

    	if ($cart) {
    		//not empty
    		$index = null;
    		foreach ($cart as $key => $value) {
    			if ($value['id'] == $this->product->id) {
    				$index = $key;
    				break;
    			}	
    		}
    		if ($index !== null) {
    			//product exists
    			$cart[$index]['quantity'] = $quantity;
	    		$cart[$index]['total_amount'] = $price * $quantity;
	    		if($cart[$index]['quantity'] <= 0){
	    			unset($cart[$index]);
	    		}
    		} else{
    			//product does not  exists
	    		$current_item['quantity'] = $quantity;
	    		$current_item['total_amount'] = $price * $quantity;
	    		$cart[] = $current_item;
    		}
    	} else {
    		// emmpty cart
    		$current_item['quantity'] = $quantity;
    		$current_item['total_amount'] = $price * $quantity;
    		$cart[] = $current_item;
    	}
    	session()->put('cart', $cart);
    	
    	return response()->json(['data'=>session('cart'), 'status'=>true, 'msg'=>'Cart Updated Successfuly']);
    }

    public function viewCart(Request $request){
    	return view('home.cart');
    }

    public function payWithEsewa(){

    }

    public function checkout(Request $request){
    	$cart = session('cart') ? session('cart') : null;
    	if (!$cart) {
    		return redirect()->back();
    	}
    	$order_code = \Str::random(15);
    	$sub_total = 0;
    	foreach ($cart as $cart_items) {
    		$cart_data = array(
    			'order_code' => $order_code,
    			'user_id' => $request->user()->id,
    			'seller_id' => $cart_items['seller_id'],
    			'product_id' => $cart_items['id'], 
    			'price' => $cart_items['actual_price'], 
    			'quantity' =>$cart_items['quantity'], 
    			'total_amount' => $cart_items['total_amount'],
    			'status' => 'new'
    		);
    		$sub_total += $cart_items['total_amount'];
    		$cart_obj = new Cart();
    		$cart_obj->fill($cart_data);
    		$cart_obj->save();
    	}
    	$order_data = array(
    		'order_code' => $order_code, 
    		'user_id' => $request->user()->id, 
    		'sub_total' => $sub_total, 
    		'delivery_charge' => 150, 
    		'vat_amount' => 0, 
    		'service_charge' => 0, 
    		'status' => 'new',
    		'total_amount' => ($sub_total+150+0+0)
    	);
    	$order = new Order();
    	$order->fill($order_data);
    	$status = $order->save();
    	if ($status) {
            $request->session()->flash('success', 'Thank you for buying with us.');
            //Mail Send here
            session()->forget('cart');
            return redirect()->route('user');
    	}else{
            $request->session()->flash('error', 'Sorry! Your order could not be placed at this time.');
            return redirect()->route('view-cart');
    	}

    }

    public function update(Request $request, $id){
        $this->cart = $this->cart->find($id);
        if(!$this->cart){
            if ($request->user()->role == 'admin') {
                request()->session()->flash('error', 'cart Not Found');
                return redirect()->route('admin-order-cart-list', $this->cart->order_code);
            }else{
                request()->session()->flash('error', 'cart Not Found');
                return redirect()->route('seller-order-cart-list'); 
            }
        }
        if ($request->user()->role == 'seller' && $request->status != 'delivered') {
            request()->session()->flash('error', 'You are not authorized');
            return redirect()->route('seller-order-cart-list');
        }

        $old_status = $this->cart->status;
        $this->cart->status = $request->status;
        $status =$this->cart->save();
        if ($status) {
            if ($request->status == 'cancelled' && $old_status != 'cancelled') {
                $order = Order::where('order_code', $this->cart->order_code)->first();
                $order->total_amount = $order->total_amount - $this->cart->total_amount;
                $order->save();
            }elseif ($old_status == 'cancelled' && $request != 'cancelled') {
                $order = Order::where('order_code', $this->cart->order_code)->first();
                $order->total_amount = $order->total_amount + $this->cart->total_amount;
                $order->save();
            }
        }
        if ($request->user()->role == 'admin') {
            $request->session()->flash('success', 'Cart updated Successfully');
            return redirect()->route('admin-order-cart-list', $this->cart->order_code);
        }else{
            $request->session()->flash('success', 'Cart updated Successfully');
            return redirect()->route('seller-order-cart-list');

        }
    }
}
