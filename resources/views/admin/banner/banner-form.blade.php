@extends('layouts.admin')
@section('title', 'Banner Form| Admin Ecom530')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Banner {{ isset($banner_detail) ? 'Update' : 'Add' }}</div>
                </div>
                <div class="ibox-body">
                    @if(isset($banner_detail))
                        {{Form::open(['url'=>route('banner.update', $banner_detail->id), 'files'=>true, 'class'=>'form'])}}
                        @method('put')
                    @else
                    {{Form::open(['url'=>route('banner.store'), 'files'=>true, 'class'=>'form'])}}
                    @endif
                    <div class="form-group row">
                        {{ Form::label('title', 'Title:', ['class'=>'col-sm-3']) }}
                        <div class="col-sm-9">
                            {{ Form::text('title',@$banner_detail->title,['class'=>'form-control form-control-sm', 'id'=>'title', 'placeholder'=>'Enter Banner Title', 'required'=>true]) }}
                            @error('title')
                            <span class="alert-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('link', 'Link:', ['class'=>'col-sm-3']) }}
                        <div class="col-sm-9">
                            {{ Form::url('link',@$banner_detail->link,['class'=>'form-control form-control-sm', 'id'=>'link', 'placeholder'=>'Enter Banner Link', 'required'=>false]) }}
                            @error('link')
                            <span class="alert-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('status', 'Status:', ['class'=>'col-sm-3']) }}
                        <div class="col-sm-9">
                            {{ Form::select('status',['active'=>'Publish', 'inactive'=>'Unpublish'],@$banner_detail->status,['id'=>'status','required'=>true, 'class'=>'form-control form-control-sm']) }}
                            @error('status')
                            <span class="alert-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('image', 'Image:', ['class'=>'col-sm-3']) }}
                        <div class="col-sm-4">
                            {{ Form::file('image', ['id'=>'image','required'=>(isset($banner_detail) ? false : true), 'accept'=>'image/*']) }}
                            @error('image')
                            <span class="alert-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-sm-4">
                            @if(isset($banner_detail))
                                @if(file_exists(public_path().'/uploads/banner/Thumb-'.$banner_detail->image))
                                    <img src="{{ asset('/uploads/banner/Thumb-'.$banner_detail->image) }}" alt="" class="img img-thumbnail img-fluid">
                                @endif
                            @endif
                        </div>
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
