@extends('layouts.admin')
@section('title', 'Admin Category | Admin Ecom530')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Category Lists</div>
                </div>
                <div class="ibox-body">
                    <table class="table table-striped table-hover">
                        <thead class="thead-dark">
                        <tr>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Is Parent</th>
                            <th>Parent Category</th>
                            <th>Status</th>
                            <th>Created By</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($category_data)
                            @foreach($category_data as $key =>$value)
                                <tr>
                                    <td>{{ ucfirst($value->title) }}</td>
                                    <td>
                                        @if($value->image !=null && file_exists(public_path().'/uploads/category/'.$value->image))
                                            <img src="{{asset('uploads/category/Thumb-'.$value->image)}}"
                                                 style="max-width: 150px;" alt="{{$value->title}}"
                                                 class="img img-fluid img-thumbnail">
                                        @endif
                                    </td>
                                    <td>
                                        {{ $value->is_parent == 1 ? 'Yes' : 'No' }}
                                    </td>
                                    <td>
                                        {{ ucfirst($value->parent_info['title']) }}
                                    </td>
                                    <td>
                                        <span class="badge badge-{{ $value->status =='active'?'success' : 'danger' }}">
                                            {{ ucfirst($value->status =='active'?'published' : 'un-Published') }}
                                        </span>
                                    </td>
                                    <td>{{ $value->created_by['name'] }}</td>
                                    <td>
                                        <a href="{{ route('category.edit', $value->id) }}" class="btn btn-success" style="border-radius: 50%;">
                                            <i class="fa fa-pencil"></i>
                                        </a>

                                        {{ Form::open(['url'=>route('category.destroy', $value->id), 'class'=>'form float-right', 'onsubmit'=>'return confirm("Are you sure you want to delete this category?")']) }}
                                        @method('delete')
                                        {{ Form::button('<i class="fa fa-trash"></i>', ['class'=>'btn btn-danger', 'style'=>'border-radius: 50%', 'type'=>'submit']) }}
                                        {{ Form::close() }}

                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    {{$category_data->links()}}
                </div>
            </div>
        </div>
    </div>

@endsection
