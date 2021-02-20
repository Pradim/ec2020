@extends('layouts.app')
@section('content')
<!-- Slider -->
@if($banner_data)

    <section class="section-slide">
        <div class="wrap-slick1">
            <div class="slick1">
                @foreach($banner_data as $banner)
                    <div class="item-slick1">
                        <a href="{{ $banner->link }}"><img src="{{ asset('uploads/banner/Thumb-'.$banner->image) }}" class="img img-fluid" width="100%" alt=""></a>    
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif


<!-- Banner -->
<div class="sec-banner bg0 p-t-80 p-b-50">
    <div class="container">
        <div class="row">
            @if($category_data)
                @foreach($category_data as $cat_info)
                    <div class="col-md-3 col-xl-3 p-b-30 m-lr-auto">
                        <!-- Block1 -->
                        <div class="block1 wrap-pic-w">
                            <img src="{{ asset('uploads/category/Thumb-'.$cat_info->image) }}" alt="IMG-BANNER">

                            <a href="{{ route('cat-product', $cat_info->slug) }}"
                               class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                                <div class="block1-txt-child1 flex-col-l">
                                        <span class="block1-name ltext-101 trans-04 p-b-8">
                                            {{ $cat_info->title }}
                                        </span>
                                </div>

                                <div class="block1-txt-child2 p-b-4 trans-05">
                                    <div class="block1-link stext-101 cl0 trans-09">
                                        Shop Now
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>

<!-- Offer -->
<div class="sec-banner bg0 p-t-80 p-b-50">
    <div class="container">
        <div class="row">
            @if($offer_info)
                @foreach($offer_info as $offer_data)
                    <div class="col-md-6 col-xl-6 p-b-30 m-lr-auto">
                        <!-- Block1 -->
                        <div class="block1 wrap-pic-w">
                            <img src="{{ asset('uploads/offer/Thumb-'.$offer_data->image) }}" alt="IMG-BANNER">

                            <a href="{{ route('offer-product', $offer_data->slug) }}"
                               class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                                <div class="block1-txt-child1 flex-col-l">
                                        <span class="block1-name ltext-101 trans-04 p-b-8">
                                            {{ $offer_data->title }}
                                        </span>
                                </div>

                                <div class="block1-txt-child2 p-b-4 trans-05">
                                    <div class="block1-link stext-101 cl0 trans-09">
                                        Shop Now
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
<!-- Product -->
<section class="bg0 p-t-23 p-b-140">
    <div class="container">
        <div class="p-b-10">
            <h3 class="ltext-103 cl5">
                Product Overview
            </h3>
        </div>

            @include('home.section.filter')

        <div class="row isotope-grid">
           @include('home._product_list')
        </div>


    </div>
</section>
@endsection