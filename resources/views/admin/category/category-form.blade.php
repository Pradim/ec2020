@extends('layouts.admin')
@section('title', 'Category Form| Admin Ecom530')
@section('scripts')
    <script>
        $('#is_parent').change(function(){
            let is_checked = $(this).prop('checked');
            if(is_checked){
                $('#parent_id').change();
                $('#div_parent').addClass('d-none');
            }else{
                $('#div_parent').removeClass('d-none');
            }
        });
    </script>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Category {{ isset($category_detail) ? 'Update' : 'Add' }}</div>
                </div>
                <div class="ibox-body">
                    @if(isset($category_detail))
                        {{Form::open(['url'=>route('category.update', $category_detail->id), 'files'=>true, 'class'=>'form'])}}
                        @method('put')
                    @else
                        {{Form::open(['url'=>route('category.store'), 'files'=>true, 'class'=>'form'])}}
                    @endif
                    <div class="form-group row">
                        {{ Form::label('title', 'Title:', ['class'=>'col-sm-3']) }}
                        <div class="col-sm-9">
                            {{ Form::text('title',@$category_detail->title,['class'=>'form-control form-control-sm', 'id'=>'title', 'placeholder'=>'Enter Banner Title', 'required'=>true]) }}
                            @error('title')
                            <span class="alert-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('summary', 'Summary:', ['class'=>'col-sm-3']) }}
                        <div class="col-sm-9">
                            {{ Form::textarea('summary',@$category_detail->summary,['class'=>'form-control form-control-sm', 'id'=>'summary', 'placeholder'=>'Enter Banner Summary', 'required'=>false, 'style'=>'resize: none;','rows'=>'5']) }}
                            @error('summary')
                            <span class="alert-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('is_parent', 'Is Parent:', ['class'=>'col-sm-3']) }}
                        <div class="col-sm-9">
                            {{ Form::checkbox('is_parent',1, (isset($category_detail) ? $category_detail->is_parent : true),['id'=>'is_parent'])}} Yes
                            @error('is_parent')
                            <span class="alert-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row {{ isset($category_detail) && $category_detail->is_parent == 0 ? '' : 'd-none' }}" id="div_parent">
                        {{ Form::label('parent_id', 'Parent Category:', ['class'=>'col-sm-3']) }}
                        <div class="col-sm-9">
                            {{ Form::select('parent_id', $parent_cats ,@$category_detail->parent_id, ['id'=>'parent_id', 'class'=>'form-control form-control-sm', 'required'=>false, 'placeholder'=>'--Please select one--'])}}
                            @error('parent_id')
                            <span class="alert-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('status', 'Status:', ['class'=>'col-sm-3']) }}
                        <div class="col-sm-9">
                            {{ Form::select('status',['active'=>'Publish', 'inactive'=>'Unpublish'],@$category_detail->status,['id'=>'status','required'=>true, 'class'=>'form-control form-control-sm']) }}
                            @error('status')
                            <span class="alert-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('image', 'Image:', ['class'=>'col-sm-3']) }}
                        <div class="col-sm-4">
                            {{ Form::file('image', ['id'=>'image','required'=>(isset($category_detail) ? false : true), 'accept'=>'image/*']) }}
                            @error('image')
                            <span class="alert-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-sm-4">
                            @if(isset($category_detail))
                                @if(file_exists(public_path().'/uploads/category/Thumb-'.$category_detail->image))
                                    <img src="{{ asset('/uploads/category/Thumb-'.$category_detail->image) }}" alt="" class="img img-thumbnail img-fluid">
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
