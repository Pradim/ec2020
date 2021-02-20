@extends('layouts.app')
@section('content')
<!-- Product -->
<section class="bg0 p-t-23 p-b-140">
    <div class="container">
        <div class="p-b-10">
            <h3 class="ltext-103 cl5">
                All Products
            </h3>
        </div>

            @include('home.section.filter')
        

        <div class="row isotope-grid">
           @include('home._product_list')
        </div>

        {{ $products->links() }}
    </div>
</section>
@endsection