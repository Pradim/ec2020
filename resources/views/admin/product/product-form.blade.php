@extends('layouts.admin')
@section('title', 'Product Form| Admin Ecom530')
@section('styles')
    <link rel="stylesheet" href="{{asset('plugins/SummerNote/summernote-bs4.css')}}">
@endsection
@section('scripts')
    <script src="{{asset('plugins/SummerNote/summernote-bs4.js')}}"></script>
    <script>
        $('#description').summernote({
            height: 150
        });

        $('#cat_id').change(function(){
            let cat_id = $('#cat_id').val();
            let sub_cat_id = "{{ isset($product_detail) ? $product_detail->sub_cat_id : null }}";
            $.ajax({
                url: "{{ route('get-child-cats') }}",
                type: "post",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "cat_id": cat_id
                },
                success:function(response){
                    if(typeof (response) != 'object'){
                        response = $.parseJSON(response);
                    }
                    let html_option = "<option value='' selected>--Select Any One--</option>";
                    if (response.status){
                        $.each(response.data, function(key,value){
                            html_option += "<option value='"+value.id+"' ";
                            if(sub_cat_id != null && sub_cat_id == value.id){
                                html_option += ' selected ';
                            }
                            html_option += ">"+value.title+"</option>";
                        });
                        $('#sub_cat_div').removeClass('d-none');
                    }else{
                        $('#sub_cat_div').addClass('d-none');
                    }
                    $('#sub_cat_id').html(html_option);
                }
            });
        });
        $('#cat_id').change();

    </script>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Product {{ isset($product_detail) ? 'Update' : 'Add' }}</div>
                </div>
                <div class="ibox-body">
                    @if(isset($product_detail))
                        {{Form::open(['url'=>route('product.update', $product_detail->id), 'files'=>true, 'class'=>'form'])}}
                        @method('put')
                    @else
                        {{Form::open(['url'=>route('product.store'), 'files'=>true, 'class'=>'form'])}}
                    @endif
                    <div class="form-group row">
                        {{ Form::label('title', 'Title:', ['class'=>'col-sm-3']) }}
                        <div class="col-sm-9">
                            {{ Form::text('title',@$product_detail->title,['class'=>'form-control form-control-sm', 'id'=>'title', 'placeholder'=>'Enter Product Title', 'required'=>true]) }}
                            @error('title')
                            <span class="alert-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('summary', 'Summary:', ['class'=>'col-sm-3']) }}
                        <div class="col-sm-9">
                            {{ Form::textarea('summary',@$product_detail->summary,['class'=>'form-control form-control-sm', 'id'=>'summary', 'placeholder'=>'Enter Product summary', 'required'=>true, 'rows'=>5, 'style'=>'resize:none']) }}
                            @error('summary')
                            <span class="alert-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('description', 'Description:', ['class'=>'col-sm-3']) }}
                        <div class="col-sm-9">
                            {{ Form::textarea('description',@$product_detail->description,['class'=>'form-control form-control-sm', 'id'=>'description', 'placeholder'=>'Enter Product description', 'required'=>false, 'rows'=>5, 'style'=>'resize:none']) }}
                            @error('description')
                            <span class="alert-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('cat_id', 'Category:', ['class'=>'col-sm-3']) }}
                        <div class="col-sm-9">
                            {{ Form::select('cat_id',$parent_cats,@$product_detail->cat_id,['id'=>'cat_id','required'=>true, 'class'=>'form-control form-control-sm', 'placeholder'=>'--select any one--']) }}
                            @error('cat_id')
                            <span class="alert-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row d-none" id="sub_cat_div">
                        {{ Form::label('sub_cat_id', 'Child Category:', ['class'=>'col-sm-3']) }}
                        <div class="col-sm-9">
                            {{ Form::select('sub_cat_id',[],@$product_detail->sub_cat_id,['id'=>'sub_cat_id','required'=>false, 'class'=>'form-control form-control-sm', 'placeholder'=>'--select any one--']) }}
                            @error('sub_cat_id')
                            <span class="alert-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('price', 'Price (NPR.):', ['class'=>'col-sm-3']) }}
                        <div class="col-sm-9">
                            {{ Form::number('price',@$product_detail->price,['min'=> 100, 'class'=>'form-control form-control-sm', 'id'=>'price', 'placeholder'=>'Enter Product price', 'required'=>true]) }}
                            @error('price')
                            <span class="alert-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('discount', 'Discount (%):', ['class'=>'col-sm-3']) }}
                        <div class="col-sm-9">
                            {{ Form::number('discount',@$product_detail->discount,['min'=>0, 'max'=>70, 'class'=>'form-control form-control-sm', 'id'=>'discount', 'placeholder'=>'Enter Product discount', 'required'=>false]) }}
                            @error('discount')
                            <span class="alert-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('stock', 'Stock:', ['class'=>'col-sm-3']) }}
                        <div class="col-sm-9">
                            {{ Form::number('stock',@$product_detail->stock,['min'=> 0, 'class'=>'form-control form-control-sm', 'id'=>'stock', 'placeholder'=>'Enter Product stock', 'required'=>false]) }}
                            @error('stock')
                            <span class="alert-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('brand', 'Brand Name:', ['class'=>'col-sm-3']) }}
                        <div class="col-sm-9">
                            {{ Form::text('brand',@$product_detail->brand,['min'=>'100', 'class'=>'form-control form-control-sm', 'id'=>'brand', 'placeholder'=>'Enter Product brand', 'required'=>false]) }}
                            @error('brand')
                            <span class="alert-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('vendor_id', 'Seller:', ['class'=>'col-sm-3']) }}
                        <div class="col-sm-9">
                            {{ Form::select('vendor_id',$seller_info,@$product_detail->vendor_id,['id'=>'vendor_id','required'=>false, 'class'=>'form-control form-control-sm', 'placeholder'=>'--select any one--']) }}
                            @error('vendor_id')
                            <span class="alert-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('is_featured', 'Is Featured:', ['class'=>'col-sm-3']) }}
                        <div class="col-sm-9">
                            {{ Form::checkbox('is_featured',1,@$product_detail->is_featured,['id'=>'is_featured']) }}
                            @error('is_featured')
                            <span class="alert-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('status', 'Status:', ['class'=>'col-sm-3']) }}
                        <div class="col-sm-9">
                            {{ Form::select('status',['active'=>'Publish', 'inactive'=>'Unpublish'],@$product_detail->status,['id'=>'status','required'=>true, 'class'=>'form-control form-control-sm']) }}
                            @error('status')
                            <span class="alert-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('image', 'Image:', ['class'=>'col-sm-3']) }}
                        <div class="col-sm-4">
                            {{ Form::file('image[]', ['id'=>'image','required'=>(isset($product_detail) ? false : true), 'accept'=>'image/*', 'multiple'=>true]) }}
                            @error('image')
                            <span class="alert-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        @if(isset($product_detail))
                            @if($product_detail->images->count() > 0)
                                @foreach($product_detail->images as $product_image)
                                    @if(file_exists(public_path().'/uploads/product/Thumb-'.$product_image->image_name))
                                        <img src="{{ asset('/uploads/product/Thumb-'.$product_image->image_name) }}" alt="" class="img img-thumbnail img-fluid">
                                        {{ Form::checkbox('del_image[]', $product_image->image_name, false) }} Delete
                                    @endif
                                @endforeach
                            @endif
                        @endif
                    </div>

                    <div class="form-group row">
                        {{ Form::label('', '', ['class'=>'col-sm-3']) }}
                        <div class="col-sm-9">
                            {{ Form::button("<i class='fa fa-thrash'></i> Reset",['class'=>'btn btn-danger', 'type'=>'reset']) }}
                            {{ Form::button("<i class='fa fa-paper-plane'></i> Submit",['class'=>'btn btn-success', 'type'=>'submit']) }}
                        </div>
                    </div>

                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>

@endsection
