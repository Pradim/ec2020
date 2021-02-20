@extends('layouts.admin')
@section('title', 'Offer List | Admin Ecom530')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Offer Lists</div>
                </div>
                <div class="ibox-body">
                    <table class="table table-striped table-hover">
                        <thead class="thead-dark">
                        <tr>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Start</th>
                            <th>End</th>
                            <th>Offered products</th>
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
                                            <img src="{{asset('uploads/offer/Thumb-'.$value->image)}}"
                                                 style="max-width: 100px;" alt="{{$value->title}}"
                                                 class="img img-fluid img-thumbnail">
                                    </td>
                                    <td>{{ $value->start_time }}</td>
                                    <td>{{ $value->end_time }}</td>
                                    <td>
                                    	@if($value->offeredProducts)
											<ol>
												@foreach($value->offeredProducts as $offered_prods)
													<li>{{ $offered_prods->product_info['title'] }} ({{ $offered_prods->discount }} %)</li>
												@endforeach
											</ol>
                                    	@endif
                                    </td>
                                    <td>
                                        <span class="badge badge-{{ $value->status =='active'?'success' : 'danger' }}">
                                            {{ ucfirst($value->status =='active'?'published' : 'un-Published') }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('offer.edit', $value->id) }}" class="btn btn-success" style="border-radius: 50%;">
                                            <i class="fa fa-pencil"></i>
                                        </a>

                                        {{ Form::open(['url'=>route('offer.destroy', $value->id), 'class'=>'form float-right', 'onsubmit'=>'return confirm("Are you sure you want to delete this offer?")']) }}
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
