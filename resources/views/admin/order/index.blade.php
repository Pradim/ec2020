@extends('layouts.admin')
@section('title', 'Admin Order | Admin Ecom530')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Order Lists</div>
                </div>
                <div class="ibox-body">
                    <table class="table table-striped table-hover">
                        <thead class="thead-dark">
                        <tr>
                            <th>Order Code</th>
                            <th>Customer Name</th>
                            <!-- <th>Sub Total</th>
                            <th>VAT</th>
                            <th>Service Charge</th>
                            <th>Delivery Charge</th> -->
                            <th>Total Amount</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <!-- <th>Action</th> -->
                        </tr>
                        </thead>
                        <tbody>
                        @if($order_data)
                            @foreach($order_data as $key =>$value)
                                <tr>
                                    <td><a href="{{ route('admin-order-cart-list',$value->order_code) }}">{{$value->order_code}}</a></td>
                                    <td>{{$value->user->name}}</td>
                                    <!-- <td>{{$value->sub_total}}</td>
                                    <td>{{$value->vat_amount}}</td>
                                    <td>{{$value->service_charge}}</td>
                                    <td>{{$value->delivery_charge}}</td> -->
                                    <td>{{$value->total_amount}}</td>
                                    <td>
                                       <form class="form-validate" method="post" enctype="multipart/form-data" action="{{route('order.update', $value->id)}}">
                                            <?php $order_data_avail = isset($order_data) ? true :  false;?>
                                            {{csrf_field()}}
                                            @method('put')
                                            
                                            <select class="status" name="status" onchange="this.form.submit()" class="form-control" required>
                                                <option value="" selected disabled="">
                                                    Choose Status...
                                                </option>
                                                <option value="new" {{$order_data_avail && ( 'new'== $value->status) ? "selected = 'selected'" : ""}}>
                                                    New
                                                </option>
                                                <option value="cancelled" {{$order_data_avail && ( 'cancelled'== $value->status) ? "selected = 'selected'" : ""}}>
                                                    Cancelled
                                                </option>
                                                <option value="verified" {{$order_data_avail && ( 'verified'== $value->status) ? "selected = 'selected'" : ""}}>
                                                    Verified
                                                </option>
                                                <option value="processing" {{$order_data_avail && ( 'processing'== $value->status) ? "selected = 'selected'" : ""}}>
                                                    Processing
                                                </option>      
                                                <option value="delivered" {{$order_data_avail && ( 'delivered'== $value->status) ? "selected = 'selected'" : ""}}>
                                                    Delivered
                                                </option>
                                            </select>
                                        </form> 
                                    </td>
                                    <td>{{ $value->created_at->format('Y-m-d') }}</td>
<!--                                     <td>
                                        <a href="{{ route('order.edit', $value->id) }}" class="btn btn-success" style="border-radius: 50%;">
                                            <i class="fa fa-pencil"></i>
                                        </a>

                                        {{ Form::open(['url'=>route('order.destroy', $value->id), 'class'=>'form float-right', 'onsubmit'=>'return confirm("Are you sure you want to delete this order?")']) }}
                                        @method('delete')
                                            {{ Form::button('<i class="fa fa-trash"></i>', ['class'=>'btn btn-danger', 'style'=>'border-radius: 50%', 'type'=>'submit']) }}
                                        {{ Form::close() }}
                                    </td> -->
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    {{$order_data->links()}}
                </div>
            </div>
        </div>
    </div>

@endsection


