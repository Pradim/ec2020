@extends('layouts.admin')
@section('title', 'Admin Cart | Admin Ecom530')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Cart Lists</div>
                </div>
                <div class="ibox-body">
                    <table class="table table-striped table-hover">
                        <thead class="thead-dark">
                        <tr>
                            <th>Order Code</th>
                            <th>Customer Name</th>
                            <!-- <th>Seller</th> -->
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total Amount</th>
                            <th>Status</th>
                            <!-- <th>Action</th> -->
                        </tr>
                        </thead>
                        <tbody>
                        @if($cart_data)
                            @foreach($cart_data as $key =>$value)
                                <tr>
                                    <td>{{$value->order_code}}</td>
                                    <td>{{$value->user['name']}}</td>
                                    <!-- <td>{{$value->seller['name']}}</td> -->
                                    <td>{{$value->product['title']}}</td>
                                    <td>{{$value->quantity}}</td>
                                    <td>{{$value->price}}</td>
                                    <td>{{$value->total_amount}}</td>
                                    <td>
                                       <form class="form-validate" method="post" enctype="multipart/form-data" action="{{route('cart.update', $value->id)}}">
                                            <?php $cart_data_avail = isset($cart_data) ? true :  false;?>
                                            {{csrf_field()}}
                                            @method('put')
                                            
                                            <select class="status" name="status" onchange="this.form.submit()" class="form-control" required>
                                                <option value="" selected disabled="">
                                                    Choose Status...
                                                </option>
                                                <option value="new" {{$cart_data_avail && ( 'new'== $value->status) ? "selected = 'selected'" : ""}}>
                                                    New
                                                </option>
                                                <option value="cancelled" {{$cart_data_avail && ( 'cancelled'== $value->status) ? "selected = 'selected'" : ""}}>
                                                    Cancelled
                                                </option>
                                                <option value="verified" {{$cart_data_avail && ( 'verified'== $value->status) ? "selected = 'selected'" : ""}}>
                                                    Verified
                                                </option>
                                                <option value="processing" {{$cart_data_avail && ( 'processing'== $value->status) ? "selected = 'selected'" : ""}}>
                                                    Processing
                                                </option>      
                                                <option value="delivered" {{$cart_data_avail && ( 'delivered'== $value->status) ? "selected = 'selected'" : ""}}>
                                                    Delivered
                                                </option>
                                            </select>
                                        </form> 
                                    </td>
<!--                                     <td>
                                        <a href="" class="btn btn-success" style="border-radius: 50%;">
                                            <i class="fa fa-pencil"></i>
                                        </a>

                                        {{ Form::open(['url'=>route('order.destroy', $value->id), 'class'=>'form float-right', 'onsubmit'=>'return confirm("Are you sure you want to delete this cart?")']) }}
                                        @method('delete')
                                            {{ Form::button('<i class="fa fa-trash"></i>', ['class'=>'btn btn-danger', 'style'=>'border-radius: 50%', 'type'=>'submit']) }}
                                        {{ Form::close() }}
                                    </td> -->
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    {{$cart_data->links()}}
                </div>
            </div>
        </div>
    </div>

@endsection
