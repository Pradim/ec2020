@extends('layouts.admin')
@section('title', 'Page Form| Admin Ecom530')
@section('styles')
    <link rel="stylesheet" href="{{asset('plugins/SummerNote/summernote-bs4.css')}}">
@endsection
@section('scripts')
    <script src="{{asset('plugins/SummerNote/summernote-bs4.js')}}"></script>
    <script>
        $('#description').summernote({
            height: 150
        });
    </script>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Page {{ isset($page_data) ? 'Update' : 'Add' }}</div>
                </div>
                <div class="ibox-body">
                    @if(isset($page_data))
                        {{Form::open(['url'=>route('page.update', $page_data->id), 'files'=>true, 'class'=>'form'])}}
                        @method('put')
                    @else
                    {{Form::open(['url'=>route('page.store'), 'files'=>true, 'class'=>'form'])}}
                    @endif
                    <div class="form-group row">
                        {{ Form::label('title', 'Title:', ['class'=>'col-sm-3']) }}
                        <div class="col-sm-9">
                            {{ Form::text('title',@$page_data->title,['class'=>'form-control form-control-sm', 'id'=>'title', 'placeholder'=>'Enter page Title', 'required'=>true]) }}
                            @error('title')
                            <span class="alert-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('summary', 'Summary:', ['class'=>'col-sm-3']) }}
                        <div class="col-sm-9">
                            {{ Form::textarea('summary',@$page_data->summary,['class'=>'form-control form-control-sm', 'id'=>'summary', 'placeholder'=>'Enter Page summary', 'required'=>true, 'rows'=>5, 'style'=>'resize:none']) }}
                            @error('summary')
                            <span class="alert-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('description', 'Description:', ['class'=>'col-sm-3']) }}
                        <div class="col-sm-9">
                            {{ Form::textarea('description',@$page_data->description,['class'=>'form-control form-control-sm', 'id'=>'description', 'placeholder'=>'Enter Page description', 'required'=>false, 'rows'=>5, 'style'=>'resize:none']) }}
                            @error('description')
                            <span class="alert-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group row">
                        {{ Form::label('status', 'Status:', ['class'=>'col-sm-3']) }}
                        <div class="col-sm-9">
                            {{ Form::select('status',['active'=>'Publish', 'inactive'=>'Unpublish'],@$page_data->status,['id'=>'status','required'=>true, 'class'=>'form-control form-control-sm']) }}
                            @error('status')
                            <span class="alert-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('image', 'Image:', ['class'=>'col-sm-3']) }}
                        <div class="col-sm-4">
                            {{ Form::file('image', ['id'=>'image','required'=>(isset($page_data) ? false : true), 'accept'=>'image/*']) }}
                            @error('image')
                            <span class="alert-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-sm-4">
                            @if(isset($page_data))
                                @if(file_exists(public_path().'/uploads/page/Thumb-'.$page_data->image))
                                    <img src="{{ asset('/uploads/page/Thumb-'.$page_data->image) }}" alt="" class="img img-thumbnail img-fluid">
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
