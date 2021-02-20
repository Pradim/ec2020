@extends('layouts.admin')
@section('title', 'Offer Form| Admin Ecom530')
@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/datetimepicker/jquery.datetimepicker.css') }}">
@endsection
@section('scripts')
    <script src="{{ asset('plugins/datetimepicker/build/jquery.datetimepicker.full.js') }}"></script>
    <script>
        $('#start_time').datetimepicker({
            format: 'Y-m-d H:i:s'
        });
        $('#end_time').datetimepicker({
            format: 'Y-m-d H:i:s'
        });

        $('#add_more').click(function(e){
            e.preventDefault();
            let html_to_clone = $('#template').html();
            $('#content').append(html_to_clone);
        });

        function deleteThis(elem){
            let offered_id = $(elem).data('offered_product_id');
            let ajax_req = true;
            if (offered_id == '') {
                ajax_req = false;
            }
            if (ajax_req) {
                $.ajax({
                    url: "{{ route('delete-offer-product') }}",
                    type: "post",
                    data: {
                        _token: "{{ csrf_token() }}",
                        off_prod_id: offered_id
                    },
                    success: function(response){
                        if (typeof(response) != "object") {
                            response = JSON.parse(response);
                        }
                        if (response.success) {
                           $(elem).parent().parent().parent().parent().remove();
                        }
                    }
                });
            }else{
                $(elem).parent().parent().parent().parent().remove();
            }
        }
    </script>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Offer {{ isset($offer_detail) ? 'Update' : 'Add' }}</div>
                </div>
                <div class="ibox-body">
                    <div class="d-none" id="template"> 
                        <div class="offered_prods">  
                            <div class="form-group row">
                                {{ Form::label('product_id', 'Product:', ['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{ Form::select('product_id[]',$products, null,['required'=>true, 'class'=>'form-control form-control-sm']) }}
                                </div>
                            </div> 
                            <div class="form-group row">
                                {{ Form::label('discount', 'Discount:', ['class'=>'col-sm-3']) }}
                                <div class="col-sm-9">
                                    {{ Form::number('discount[]', null,['required'=>true, 'class'=>'form-control form-control-sm']) }}
                                </div>
                            </div> 
                            <div class="form-group row">
                                <div class="col-12">
                                    <div class="float-right">
                                        {{ Form::button('<i class="fa fa-trash"></i> Delete', ['class'=>'btn btn-danger btn-sm','type'=>'button','data-offered_product_id'=>'','name'=>'offered_id[]', 'onClick'=>'deleteThis(this)']) }}
                                    </div>
                                </div>
                            </div> 
                            <hr>      
                        </div> 
                    </div>
                    @if(isset($offer_detail))
                        {{Form::open(['url'=>route('offer.update', $offer_detail->id), 'files'=>true, 'class'=>'form'])}}
                        @method('put')
                    @else
                        {{Form::open(['url'=>route('offer.store'), 'files'=>true, 'class'=>'form'])}}
                    @endif
                    <div class="form-group row">
                        {{ Form::label('title', 'Title:', ['class'=>'col-sm-3']) }}
                        <div class="col-sm-9">
                            {{ Form::text('title',@$offer_detail->title,['class'=>'form-control form-control-sm', 'id'=>'title', 'placeholder'=>'Enter Offer Title', 'required'=>true]) }}
                            @error('title')
                            <span class="alert-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('summary', 'Summary:', ['class'=>'col-sm-3']) }}
                        <div class="col-sm-9">
                            {{ Form::textarea('summary',@$offer_detail->summary,['class'=>'form-control form-control-sm', 'id'=>'summary', 'placeholder'=>'Enter Offer Summary', 'required'=>false, 'style'=>'resize: none;','rows'=>'5']) }}
                            @error('summary')
                            <span class="alert-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('start_time', 'Offer From:', ['class'=>'col-sm-3']) }}
                        <div class="col-sm-9">
                            {{ Form::text('start_time',@$offer_detail->start_time,['class'=>'form-control form-control-sm', 'id'=>'start_time', 'placeholder'=>'Enter Offer Start Time', 'required'=>true]) }}
                            @error('start_time')
                            <span class="alert-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('end_time', 'Offer To:', ['class'=>'col-sm-3']) }}
                        <div class="col-sm-9">
                            {{ Form::text('end_time',@$offer_detail->end_time,['class'=>'form-control form-control-sm', 'id'=>'end_time', 'placeholder'=>'Enter Offer End Time', 'required'=>true]) }}
                            @error('end_time')
                            <span class="alert-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('status', 'Status:', ['class'=>'col-sm-3']) }}
                        <div class="col-sm-9">
                            {{ Form::select('status',['active'=>'Publish', 'inactive'=>'Unpublish'],@$offer_detail->status,['id'=>'status','required'=>true, 'class'=>'form-control form-control-sm']) }}
                            @error('status')
                            <span class="alert-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('image', 'Image:', ['class'=>'col-sm-3']) }}
                        <div class="col-sm-4">
                            {{ Form::file('image', ['id'=>'image','required'=>(isset($offer_detail) ? false : true), 'accept'=>'image/*']) }}
                            @error('image')
                            <span class="alert-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-sm-4">
                            @if(isset($offer_detail))
                                @if(file_exists(public_path().'/uploads/offer/Thumb-'.$offer_detail->image))
                                    <img src="{{ asset('/uploads/offer/Thumb-'.$offer_detail->image) }}" alt="" class="img img-thumbnail img-fluid">
                                @endif
                            @endif
                        </div>
                    </div>

                    <hr>
                    <p>Offered Products</p>
                    <hr>

                    <div id="content">
                        @if(isset($offer_detail))
                            @foreach($offer_detail->offeredProducts as $offered_prods)
                                <div class="offered_prods">  
                                    <div class="form-group row">
                                        {{ Form::label('product_id', 'Product:', ['class'=>'col-sm-3']) }}
                                        <div class="col-sm-9">
                                            {{ Form::select('product_id[]',$products, $offered_prods->product_id,['required'=>true, 'class'=>'form-control form-control-sm']) }}
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                        {{ Form::label('discount', 'Discount:', ['class'=>'col-sm-3']) }}
                                        <div class="col-sm-9">
                                            {{ Form::number('discount[]', $offered_prods->discount,['required'=>true, 'class'=>'form-control form-control-sm']) }}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <div class="float-right">
                                                {{ Form::button('<i class="fa fa-trash"></i> Delete', ['class'=>'btn btn-danger btn-sm','type'=>'button','data-offered_product_id'=>$offered_prods->id,'name'=>'offered_id[]', 'onClick'=>'deleteThis(this)']) }}
                                            </div>
                                        </div>
                                    </div> 
                                </div>   
                                <hr>  
                            @endforeach
                        @endif
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <a href="javascript:;" id="add_more" class="btn btn-success float-right">
                                <i class="fa fa-plus"></i> Add Product to Offer
                            </a>
                        </div>
                    <hr>
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
