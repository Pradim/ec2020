@extends('layouts.app')
@section('content')
<!-- Content page -->
<section class="bg0 p-t-104 p-b-116">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>Order Code</th>
                            <!-- <th>Customer Name</th> -->
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total Amount</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($cart_data)
                        @foreach($cart_data as $key =>$value)
                        <tr>
                            <td>{{$value->order_code}}</td>
                            <!-- <td>{{$value->user['name']}}</td> -->
                            <td>{{$value->product['title']}}</td>
                            <td>{{$value->quantity}}</td>
                            <td>{{$value->price}}</td>
                            <td>{{$value->total_amount}}</td>
                            <td>{{$value->status}}</td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
                {{$cart_data->links()}}
            </div>
        </div>
    </div>
</section>  
@endsection
