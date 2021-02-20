@extends('layouts.app')
@section('content')
	<!-- breadcrumb -->
	<div class="container">
		<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
			<a href="{{ route('homePage') }}" class="stext-109 cl8 hov-cl1 trans-04">
				Home
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>

			<span class="stext-109 cl4">
				Shoping Cart
			</span>
		</div>
	</div>

	<div class="container">
			<div class="row">
				<div class="col-sm-12 col-lg-9 col-xl-8 m-lr-auto m-b-50">
					<div class="m-l-25 m-r--auto m-lr-0-xl">
						<div class="wrap-table-shopping-cart">
							@php
								$sub_amount = 0;
							@endphp
        					@if(session('cart'))
								<table class="table-shopping-cart">
									<tr class="table_head">
										<th class="column-1">Product</th>
										<th class="column-2"></th>
										<th class="column-3">Price</th>
										<th class="column-4">Quantity</th>
										<th class="column-5">Total</th>
										<th class="column-6"></th>
									</tr>
									@foreach(session('cart') as $cart_items)
										@php
											$sub_amount += $cart_items['total_amount'];
										@endphp
										<tr class="table_row">
											<td class="column-1">
												<div class="how-itemcart1">
													<img src="{{ $cart_items['image'] }}" alt="IMG">
												</div>
											</td>
											<td class="column-2"><a href="{{ $cart_items['link'] }}">{{ $cart_items['title'] }}</a></td>
											<td class="column-3">NPR. {{ number_format($cart_items['actual_price']) }}</td>
											<td class="column-4">{{ $cart_items['quantity'] }}</td>
											<td class="column-5">NPR. {{ number_format($cart_items['total_amount']) }}</td>
											<td class="column-6">
												<button class="btn btn-default add-to-cart" data-product_id="{{ $cart_items['id']}}" data-quantity="{{ $cart_items['quantity']+1}} " style="border-radius: 50%">
													<i class="fa fa-plus"></i>
												</button>
												<button class="btn btn-default add-to-cart" data-product_id="{{ $cart_items['id']}}" data-quantity="{{ $cart_items['quantity']-1 }}" style="border-radius: 50%">
													<i class="fa fa-minus"></i>
												</button>
											</td>
										</tr>
									@endforeach
								</table>
							@else
								<p>Your Cart is empty. Please add some <a href="{{ route('all-products') }}">Products</a> in your cart.</p>
							@endif
						</div>
					</div>
				</div>
        		@if(session('cart'))
					<div class="col-sm-10 col-lg-3 col-xl-4 m-lr-auto m-b-50">
						<div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-5 m-r-0 m-lr-0-xl p-lr-15-sm">
							<h4 class="mtext-109 cl2 p-b-30">
								Cart Totals
							</h4>

							<div class="flex-w flex-t bor12 p-b-13">
								<div class="size-208">
									<span class="stext-110 cl2">
										Subtotal:
									</span>
								</div>

								<div class="size-209">
									<span class="mtext-110 cl2">
										NPR. {{ number_format($sub_amount) }}
									</span>
								</div>
							</div>

							<div class="flex-w flex-t bor12 p-b-13">
								<div class="size-208">
									<span class="stext-110 cl2">
										Delivery Charge:
									</span>
								</div>

								<div class="size-209">
									<span class="mtext-110 cl2">
										NPR. {{ number_format(150) }}
									</span>
								</div>
							</div>

							<div class="flex-w flex-t p-t-27 p-b-33">
								<div class="size-208">
									<span class="mtext-101 cl2">
										Total:
									</span>
								</div>

								<div class="size-209 p-t-1">
									<span class="mtext-110 cl2">
										NPR. {{ number_format($sub_amount+150) }}
									</span>
								</div>
							</div>

							<a href="{{ route('checkout') }}" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
								Proceed to Checkout
							</a>
						</div>
					</div>
				@endif
			</div>
	</div>
@endsection