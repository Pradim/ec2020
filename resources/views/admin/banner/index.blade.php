@extends('layouts.admin')
@section('title', 'Admin Banner | Admin Ecom530')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Banner Lists</div>
                </div>
                <div class="ibox-body">
                    <table class="table table-striped table-hover">
                        <thead class="thead-dark">
                        <tr>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Link</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Created By</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($banner_data)
                            @foreach($banner_data as $key =>$value)
                                <tr>
                                    <td>{{$value->title}}</td>
                                    <td>
                                        @if($value->image !=null && file_exists(public_path().'/uploads/banner/'.$value->image))
                                            <img src="{{asset('uploads/banner/Thumb-'.$value->image)}}"
                                                 style="max-width: 150px;" alt="{{$value->title}}"
                                                 class="img img-fluid img-thumbnail">
                                        @endif
                                    </td>
                                    <td><a href="{{$value->link}}" target="_banner">{{$value->link}}</a></td>
                                    <td>
                                        <span class="badge badge-{{ $value->status =='active'?'success' : 'danger' }}">
                                            {{ ucfirst($value->status =='active'?'published' : 'un-Published') }}
                                        </span>
                                    </td>
                                    <td>{{ $value->created_at->format('Y-m-d') }}</td>
                                    <td>{{ $value->created_by['name'] }}</td>
                                    <td>
                                        <a href="{{ route('banner.edit', $value->id) }}" class="btn btn-success" style="border-radius: 50%;">
                                            <i class="fa fa-pencil"></i>
                                        </a>

                                        {{ Form::open(['url'=>route('banner.destroy', $value->id), 'class'=>'form float-right', 'onsubmit'=>'return confirm("Are you sure you want to delete this banner?")']) }}
                                        @method('delete')
                                            {{ Form::button('<i class="fa fa-trash"></i>', ['class'=>'btn btn-danger', 'style'=>'border-radius: 50%', 'type'=>'submit']) }}
                                        {{ Form::close() }}

                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    {{$banner_data->links()}}
                </div>
            </div>
        </div>
    </div>

@endsection
