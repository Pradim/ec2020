@extends('layouts.admin')
@section('title', 'Admin Product | Admin Ecom530')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Product Lists</div>
                </div>
                <div class="ibox-body">
                    <table class="table table-striped table-hover">
                        <thead class="thead-dark">
                        <tr>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Category</th>
                            <th>Price (NPR)</th>
                            <th>Discount (%)</th>
                            <th>Is Featured</th>
                            <th>Stock</th>
                            <th>Seller</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($data)
                            @foreach($data as $key =>$value)
                                <tr>
                                    <td>{{$value->title}}</td>
                                    <td>
                                            <img src="{{asset('uploads/product/Thumb-'.@$value->images[0]->image_name)}}"
                                                 style="max-width: 50px;" alt="{{$value->title}}"
                                                 class="img img-fluid img-thumbnail">
                                    </td>
                                    <td>
                                        {{ $value->cat_info['title'] }}<br/>
                                        <sub>
                                            {{$value->sub_cat_info['title']}}
                                        </sub>
                                    </td>
                                    <td>NPR. {{ number_format($value->price) }}</td>
                                    <td>{{ $value->discount }}</td>
                                    <td>{{ ($value->is_featured == 1) ? 'Yes' : 'No' }}</td>
                                    <td>{{ (int)($value->stock) }}</td>
                                    <td>{{ $value->vendor_info['name'] }}</td>
                                    <td>
                                        <span class="badge badge-{{ $value->status =='active'?'success' : 'danger' }}">
                                            {{ ucfirst($value->status =='active'?'published' : 'un-Published') }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('product.edit', $value->id) }}" class="btn btn-success" style="border-radius: 50%;">
                                            <i class="fa fa-pencil"></i>
                                        </a>

                                        {{ Form::open(['url'=>route('product.destroy', $value->id), 'class'=>'form float-right', 'onsubmit'=>'return confirm("Are you sure you want to delete this product?")']) }}
                                        @method('delete')
                                        {{ Form::button('<i class="fa fa-trash"></i>', ['class'=>'btn btn-danger', 'style'=>'border-radius: 50%', 'type'=>'submit']) }}
                                        {{ Form::close() }}

                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    {{$data->links()}}
                </div>
            </div>
        </div>
    </div>

@endsection
