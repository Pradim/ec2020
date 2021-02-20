@extends('layouts.admin')
@section('title', 'Admin User | Admin Ecom530')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">{{ ucFirst($type) }} Lists</div>
                </div>
                <div class="ibox-body">
                    <table class="table table-striped table-hover">
                        <thead class="thead-dark">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($user_data)
                            @foreach($user_data as $key =>$value)
                                <tr>
                                    <td>{{$value->name}}</td>
                                    <td>{{$value->email}}</td>
                                    <td>{{$value->user_info['phone']}}</td>
                                    <td>{{$value->user_info['address']}}</td>
                                    <td>
                                        @if($value->user_info['image'] !=null && file_exists(public_path().'/uploads/user/'.$value->user_info['image']))
                                            <img src="{{asset('uploads/user/Thumb-'.$value->user_info['image'])}}"
                                                 style="max-width: 150px;" alt="{{$value->name}}"
                                                 class="img img-fluid img-thumbnail">
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge badge-{{ $value->status =='active'?'success' : 'danger' }}">
                                            {{ ucfirst($value->status =='active'?'published' : 'un-Published') }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('user.edit', $value->id) }}" class="btn btn-success" style="border-radius: 50%;">
                                            <i class="fa fa-pencil"></i>
                                        </a>

                                        {{ Form::open(['url'=>route('user.destroy', $value->id), 'class'=>'form float-right', 'onsubmit'=>'return confirm("Are you sure you want to delete this user?")']) }}
                                        @method('delete')
                                            {{ Form::button('<i class="fa fa-trash"></i>', ['class'=>'btn btn-danger', 'style'=>'border-radius: 50%', 'type'=>'submit']) }}
                                        {{ Form::close() }}

                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    {{$user_data->links()}}
                </div>
            </div>
        </div>
    </div>

@endsection
