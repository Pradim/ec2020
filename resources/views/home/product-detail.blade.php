@extends('layouts.app')
@section('title', $product_info->title)
@section('meta')
	<meta name="keywords" content="{{ $product_info->summary }}">
	<meta name="description" content="{{ $product_info->summary }}">
	<meta property="og:url" content="{{ route('product-detail', $product_info->slug) }}">
	<meta property="og:title" content="{{ $product_info->title }}">
	<meta property="og:image" content="{{ asset('uploads/product/Thumb-').$product_info->images[0]->image_name }}">
	<meta property="og:description" content="{{ $product_info->summary }}">
@endsection
@section('content')
		<!-- breadcrumb -->
	<div class="container">
		<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
			<a href="{{ route('homePage') }}" class="stext-109 cl8 hov-cl1 trans-04">
				Home
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>

			<a href="route('cat-product', $product_info->cat_info->slug)" class="stext-109 cl8 hov-cl1 trans-04">
				{{ $product_info->cat_info->title }}
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>

			@if($product_info->sub_cat_info)
				<a href="route('child-cat-product', [$product_info->cat_info->slug, $product_info->sub_cat_info->slug])" class="stext-109 cl8 hov-cl1 trans-04">
					{{ $product_info->sub_cat_info->title }}
					<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
				</a>
			@endif
			<span class="stext-109 cl4">
				{{ $product_info->title }}
			</span>
		</div>
	</div>
		

	<!-- Product Detail -->
	<section class="sec-product-detail bg0 p-t-65 p-b-60">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-lg-7 p-b-30">
					<div class="p-l-25 p-r-30 p-lr-0-lg">
						<div class="wrap-slick3 flex-sb flex-w">
							<div class="wrap-slick3-dots"></div>
							<div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

							<div class="slick3 gallery-lb">
								@if($product_info->images)
									@foreach($product_info->images as $images)
									<div class="item-slick3" data-thumb="{{ asset('uploads/product/Thumb-'.$images->image_name) }}">
										<div class="wrap-pic-w pos-relative">
											<img src="{{ asset('uploads/product/Thumb-'.$images->image_name) }}" alt="{{ $product_info->title }}">

											<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="{{ asset('uploads/product/'.$images->image_name) }}">
												<i class="fa fa-expand"></i>
											</a>
										</div>
									</div>
									@endforeach
								@endif
							</div>
						</div>
					</div>
				</div>
					
				<div class="col-md-6 col-lg-5 p-b-30">
					<div class="p-r-50 p-t-5 p-lr-0-lg">
						<h4 class="mtext-105 cl2 js-name-detail p-b-14">
							{{ $product_info->title }}
						</h4>

						<span class="mtext-106 cl2">
							 @php
                                $price = $product_info->price;
                                if($product_info->discount > 0){
                                    $price = $price - (($price * $product_info->discount)/100);
                                }
                            @endphp
                            NPR. {{ number_format($price) }}
                            @if($product_info->discount > 0)
                                <del style="color: #ff0000">NPR. {{ number_format($product_info->price) }}</del>
                            @endif
						</span>

						<p class="stext-102 cl3 p-t-23">
							{{ $product_info->summary }}
						</p>
						
						<!--  -->
						<div class="p-t-33">

							<div class="flex-w flex-r-m p-b-10">
								<div class="size-204 flex-w flex-m respon6-next">
									<div class="wrap-num-product flex-w m-r-20 m-tb-10">
										<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
											<i class="fs-16 zmdi zmdi-minus"></i>
										</div>

										<input class="mtext-104 cl3 txt-center num-product" type="number" name="num-product" value="{{ $quantity }}" id="quantity">

										<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
											<i class="fs-16 zmdi zmdi-plus"></i>
										</div>
									</div>

									<button data-product_id="{{ $product_info->id }}" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
										Add to cart
									</button>
								</div>
							</div>	
						</div>

						<!--  -->
						<div class="flex-w flex-m p-l-100 p-t-40 respon7">

			                <!-- Go to www.addthis.com/dashboard to customize your tools -->
			                <div class="addthis_inline_share_toolbox"></div>
			            
						</div>
					</div>
				</div>
			</div>

			<div class="bor10 m-t-50 p-t-43 p-b-40">
				<!-- Tab01 -->
				<div class="tab01">
					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
						<li class="nav-item p-b-10">
							<a class="nav-link active" data-toggle="tab" href="#description" role="tab">Description</a>
						</li>



						<li class="nav-item p-b-10">
							<a class="nav-link" data-toggle="tab" href="#reviews" role="tab">Reviews ({{ $product_info->reviews->count() }})</a>
						</li>
					</ul>

					<!-- Tab panes -->
					<div class="tab-content p-t-43">
						<!-- - -->
						<div class="tab-pane fade show active" id="description" role="tabpanel">
							<div class="how-pos2 p-lr-15-md">
								<div class="stext-102 cl6">
									{!! html_entity_decode($product_info->description) !!}
								</div>
							</div>
						</div>

						<!-- - -->
						<div class="tab-pane fade" id="reviews" role="tabpanel">
							<div class="row">
								<div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
									<div class="p-b-30 m-lr-15-sm">
										<!-- Review -->
										@if($product_info->reviews)
											@foreach($product_info->reviews as $review)
												<div class="flex-w flex-t p-b-68">
													<div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
														@if($review->user_info)
															@if($review->user_info->image != null && file_exists(public_path().'uploads/user/'.$review->user_info->image))
																<img src="{{ asset('uploads/user/Thumb-'.$review->user_info->image) }}" alt="AVATAR">
															@else
																<img src="{{ asset('img/dummy-user.png') }}" alt="AVATAR">
															@endif
														@else
															<img src="{{ asset('img/dummy-user.png') }}" alt="AVATAR">
														@endif
													</div>

													<div class="size-207">
														<div class="flex-w flex-sb-m p-b-17">
															<span class="mtext-107 cl2 p-r-20">
																{{ $review->user->name }}
															</span>

															<span class="fs-18 cl11">
																@for($i=1; $i<=5; $i++)
																	@if($i <= $review->rate)
																		<i class="zmdi zmdi-star"></i>
																	@else
																		<i class="zmdi zmdi-star-outline"></i>
																	@endif
																@endfor
															</span>
														</div>

														<p class="stext-102 cl6">
															{{ $review->review }}
														</p>
													</div>
												</div>
											@endforeach
										@endif
										<!-- Add review -->
										@auth
										@if(!$reviewed)
										<form class="w-full" method="post" action="{{ route('submit-review', $product_info->slug) }}">
											@csrf
											<h5 class="mtext-108 cl2 p-b-7">
												Add a review
											</h5>

											<p class="stext-102 cl6">
												Your email address will not be published. Required fields are marked *
											</p>

											<div class="flex-w flex-m p-t-50 p-b-23">
												<span class="stext-102 cl3 m-r-16">
													Your Rating
												</span>

												<span class="wrap-rating fs-18 cl11 pointer">
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<input class="dis-none" type="number" name="rating">
												</span>
											</div>

											<div class="row p-b-25">
												<div class="col-12 p-b-5">
													<label class="stext-102 cl3" for="review">Your review</label>
													<textarea class="size-110 bor8 stext-102 cl2 p-lr-20 p-tb-10" id="review" name="review"></textarea>
												</div>
											</div>

											<button class="flex-c-m stext-101 cl0 size-112 bg7 bor11 hov-btn3 p-lr-15 trans-04 m-b-10">
												Submit
											</button>
										</form>
										@endif
										@else
											Please
											<a href="{{ route('login') }}" class="btn-link"> Login</a>
											or
											<a href="{{ route('login') }}" class="btn-link"> Register</a>
											to review this product.
										@endif
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</section>


	<!-- Related Products -->
	<section class="sec-relate-product bg0 p-t-45 p-b-105">
		<div class="container">
			<div class="p-b-45">
				<h3 class="ltext-106 cl5 txt-center">
					Related Products
				</h3>
			</div>

			<!-- Slide2 -->
			<div class="wrap-slick2">
				<div class="slick2">
					@if($product_info->related_products)
						@foreach($product_info->related_products as $related_products)
							@if($related_products->id != $product_info->id)
								<div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
									<div class="block2">
						                <div class="block2-pic hov-img0">
						                    <img src="{{ asset('uploads/product/Thumb-').$related_products->images[0]->image_name }}" alt="IMG-PRODUCT">
						                </div>

						                <div class="block2-txt flex-w flex-t p-t-14">
						                    <div class="block2-txt-child1 flex-col-l ">
						                        <a href="{{ route('product-detail', $related_products->slug) }}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
						                            {{ $related_products->title }}
						                        </a>

						                        <span class="stext-105 cl3">
						                            @php
						                                $price = $related_products->price;
						                                if($related_products->discount > 0){
						                                    $price = $price - (($price * $related_products->discount)/100);
						                                }
						                            @endphp
						                            NPR. {{ number_format($price) }}
						                            @if($related_products->discount > 0)
						                                <del style="color: #ff0000">NPR. {{ number_format($related_products->price) }}</del>
						                            @endif
						                        </span>
						                    </div>
						                </div>
						            </div>
								</div>
							@endif
						@endforeach
					@endif
				</div>
			</div>
		</div>
	</section>
		
@endsection
