@extends('layouts.app')
@section('content')
<!-- Product -->
<section class="bg0 p-t-23 p-b-140">
    <div class="container">
        <div class="p-b-10">
            <h3 class="ltext-103 cl5">
                Offered Products
            </h3>
        </div>
            @include('home.section.filter')
        <div class="row isotope-grid">

             @if(isset($products) && $products->count() > 0)
                @foreach($products as $items)
                    <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item {{ $items->product_info['cat_id'] }}">
                        <!-- Block2 -->
                        <div class="block2">
                            <div class="block2-pic hov-img0">
                                <img src="{{ asset('uploads/product/Thumb-').$items->product_info->images[0]->image_name }}" alt="IMG-PRODUCT">
                            </div>

                            <div class="block2-txt flex-w flex-t p-t-14">
                                <div class="block2-txt-child1 flex-col-l ">
                                    <a href="{{ route('product-detail', $items->product_info['slug']) }}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                        {{ $items->product_info['title'] }}
                                    </a>

                                    <span class="stext-105 cl3">
                                        @php
                                            $price = $items->product_info['price'];
                                            if($items->product_info['discount'] > 0){
                                                $price = $price - (($price * $items->product_info['discount'])/100);
                                            }
                                        @endphp
                                        NPR. {{ number_format($price) }}
                                        @if($items->product_info['discount'] > 0)
                                            <del style="color: #ff0000">NPR. {{ number_format($items->product_info['price']) }}</del>
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach
            @else
                <p>Product Not Found</p>
            @endif


        </div>


    </div>
</section>
@endsection