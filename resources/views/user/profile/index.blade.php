@extends('layouts.app')
@section('scripts')
	@if (count($errors) > 0)
		<script type="text/javascript">
			    $('#exampleModalCenter').modal('show');
		</script>
	@endif
@endsection
@section('content')
<!-- Content page -->
<section class="bg0 p-t-104 p-b-116">
	<div class="container">
		<div class="row">
			<div class="col-lg-8">
				@php
					$user_info = isset($user_data) ? $user_data->user_info['data'] : null;
					if($user_info){
					$user_info = json_decode($user_info);
					}
				@endphp
				<h3>User Information</h3>
				<hr>
				<p><strong>Name:</strong> {{$user_data->name}}</p> 	
				<p><strong>Email:</strong> {{$user_data->email}}</p> 	
				<p><strong>Phone Number:</strong> {{$user_data->user_info['phone']}}</p> 	
				<p><strong>Address:</strong> {{$user_data->user_info['address']}}</p> 	
				<p><strong>Additional Information</strong> {{$user_info->about}}</p> 	
				<p><strong>DOB:</strong> {{$user_info->dob}}</p> 	
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
					Update Profile
				</button>
				<!-- Modal -->
				<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="z-index: 1111;">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLongTitle">Update Profile</h5>
							</div>
							<div class="modal-body">
			                    {{Form::open(['url'=>route('update.profile', $user_data->id), 'files'=>true, 'class'=>'form'])}}
			                    @method('put')
			                    <div class="form-group row">
			                        {{ Form::label('name', 'Full Name:', ['class'=>'col-sm-3']) }}
			                        <div class="col-sm-9">
			                            {{ Form::text('name',@$user_data->name,['class'=>'form-control form-control-sm', 'id'=>'name', 'placeholder'=>'Enter User Name...', 'required'=>false]) }}
			                            @error('name')
			                                <span class="alert-danger">{{$message}}</span>
			                            @enderror
			                        </div>
			                    </div>

			                    <div class="form-group row">
			                        {{ Form::label('email', 'Email:', ['class'=>'col-sm-3']) }}
			                        <div class="col-sm-9">
			                            {{ Form::email('email',@$user_data->email,['class'=>'form-control form-control-sm', 'id'=>'email', 'placeholder'=>'Enter User Email...', 'required'=>false, 'disabled'=>(isset($user_data) ? true : false)]) }}
			                            @error('email')
			                                <span class="alert-danger">{{$message}}</span>
			                            @enderror
			                        </div>
			                    </div>
			                    
			                    <div class="form-group row">
			                        {{ Form::label('address', 'Address:', ['class'=>'col-sm-3']) }}
			                        <div class="col-sm-9">
			                            {{ Form::text('address',@$user_data->user_info['address'],['class'=>'form-control form-control-sm', 'id'=>'address', 'placeholder'=>'Enter User address...', 'required'=>false]) }}
			                            @error('address')
			                                <span class="alert-danger">{{$message}}</span>
			                            @enderror
			                        </div>
			                    </div>

			                    <div class="form-group row">
			                        {{ Form::label('phone', 'Phone Number:', ['class'=>'col-sm-3']) }}
			                        <div class="col-sm-9">
			                            {{ Form::tel('phone',@$user_data->user_info['phone'],['class'=>'form-control form-control-sm', 'id'=>'phone', 'placeholder'=>'Enter User Phone-number...', 'required'=>false]) }}
			                            @error('phone')
			                                <span class="alert-danger">{{$message}}</span>
			                            @enderror
			                        </div>
			                    </div>
			                    <div class="form-group row">
			                        {{ Form::label('data', 'Profile:', ['class'=>'col-sm-3']) }}
			                        <div class="col-sm-9">
			                            {{ Form::textarea('data[about]',@$user_info->about,['class'=>'form-control form-control-sm', 'id'=>'data_about', 'placeholder'=>'Enter your additional information', 'required'=>false,'rows'=>5,'style'=>'resize:none']) }}
			                            @error('data')
			                                <span class="alert-danger">{{$message}}</span>
			                            @enderror
			                        </div>
			                    </div>

			                    <div class="form-group row">
			                        {{ Form::label('data_dob', 'Date of Birth :', ['class'=>'col-sm-3']) }}
			                        <div class="col-sm-9">
			                            {{ Form::date('data[dob]',@$user_info->dob,['class'=>'form-control form-control-sm', 'id'=>'data_dob', 'placeholder'=>'Enter your birth date', 'required'=>false]) }}
			                            @error('data_dob')
			                                <span class="alert-danger">{{$message}}</span>
			                            @enderror
			                        </div>
			                    </div>

			                    <div class="form-group row">
			                        {{ Form::label('image', 'Image:', ['class'=>'col-sm-3']) }}
			                        <div class="col-sm-4">
			                            {{ Form::file('image', ['id'=>'image','required'=>false, 'accept'=>'image/*']) }}
			                            @error('image')
			                            <span class="alert-danger">{{$message}}</span>
			                            @enderror
			                        </div>
			                        <div class="col-sm-4">
			                            @if(isset($user_data))
			                                @if(file_exists(public_path().'/uploads/user/Thumb-'.$user_data->image))
			                                    <img src="{{ asset('/uploads/user/Thumb-'.$user_data->image) }}" alt="" class="img img-thumbnail img-fluid">
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
			</div>
			<div class="col-lg-4">
				@if($user_data->user_info['image'])
				<img src="{{ asset('uploads/user/'.$user_data->user_info->image) }}" alt="" width="200px">
				@else
				<img src="{{ asset('img/dummy-user.png') }}" alt="" class="img img-thumbnail" width="100px">
				@endif
			</div>
		</div>
	</div>
</section>	
@endsection