@extends('layouts.admin')
@section('title', 'Admin Page | Admin Ecom530')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Page Lists</div>
                </div>
                <div class="ibox-body">
                    <table class="table table-striped table-hover">
                        <thead class="thead-dark">
                        <tr>
                            <th>Title</th>
                            <th>Summary</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Updated By</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($page_data)
                            @foreach($page_data as $key =>$value)
                                <tr>
                                    <td>{{$value->title}}</td>
                                    <td>{{$value->summary}}</td>
                                    <td>
                                        @if($value->image !=null && file_exists(public_path().'/uploads/page/'.$value->image))
                                            <img src="{{asset('uploads/page/Thumb-'.$value->image)}}"
                                                 style="max-width: 150px;" alt="{{$value->title}}"
                                                 class="img img-fluid img-thumbnail">
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge badge-{{ $value->status =='active'?'success' : 'danger' }}">
                                            {{ ucfirst($value->status =='active'?'published' : 'un-Published') }}
                                        </span>
                                    </td>
                                    <td>{{ $value->updated_user['name'] }}</td>
                                    <td>
                                        <a href="{{ route('page.edit', $value->id) }}" class="btn btn-success" style="border-radius: 50%;">
                                            <i class="fa fa-pencil"></i>
                                        </a>

                                        {{ Form::open(['url'=>route('page.destroy', $value->id), 'class'=>'form float-right', 'onsubmit'=>'return confirm("Are you sure you want to delete this page?")']) }}
                                        @method('delete')
                                            {{ Form::button('<i class="fa fa-trash"></i>', ['class'=>'btn btn-danger', 'style'=>'border-radius: 50%', 'type'=>'submit']) }}
                                        {{ Form::close() }}

                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    {{$page_data->links()}}
                </div>
            </div>
        </div>
    </div>

@endsection
