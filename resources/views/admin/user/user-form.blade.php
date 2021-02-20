@extends('layouts.admin')
@section('title', 'User Form| Admin Ecom530')
@section('scripts')
    <script>
        $('#change_password').change(function(e){
            let is_checked = $(this).prop('checked');
            if (is_checked) {
                $('#password').attr('required', 'required');
                $('#password_confirmation').attr('required', 'required');
                $('.password_change').removeClass('d-none');
            }else{
                $('#password').removeAttr('required', 'required');
                $('#password_confirmation').removeAttr('required', 'required');
                $('.password_change').addClass('d-none');
            }
        });
    </script>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">User {{ isset($user_detail) ? 'Update' : 'Add' }}</div>
                </div>
                <div class="ibox-body">
                    @if(isset($user_detail))
                        {{Form::open(['url'=>route('user.update', $user_detail->id), 'files'=>true, 'class'=>'form'])}}
                        @method('put')
                    @else
                    {{Form::open(['url'=>route('user.store'), 'files'=>true, 'class'=>'form'])}}
                    @endif
                    <div class="form-group row">
                        {{ Form::label('name', 'Full Name:', ['class'=>'col-sm-3']) }}
                        <div class="col-sm-9">
                            {{ Form::text('name',@$user_detail->name,['class'=>'form-control form-control-sm', 'id'=>'name', 'placeholder'=>'Enter User Name...', 'required'=>true]) }}
                            @error('name')
                                <span class="alert-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('email', 'Email:', ['class'=>'col-sm-3']) }}
                        <div class="col-sm-9">
                            {{ Form::email('email',@$user_detail->email,['class'=>'form-control form-control-sm', 'id'=>'email', 'placeholder'=>'Enter User Email...', 'required'=>false, 'disabled'=>(isset($user_detail) ? true : false)]) }}
                            @error('email')
                                <span class="alert-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-group row {{ isset($user_detail) ? '' : 'd-none'  }}">
                        {{ Form::label('change_password', 'Change Password: ',['class'=>'col-sm-3']) }}
                        <div class="col-sm-9">
                            {{ Form::checkbox('change_password',1) }} Yes
                        </div>
                    </div>

                    <div class="password_change  {{ isset($user_detail) ? 'd-none' : ''  }} ">                     
                        <div class="form-group row">
                            {{ Form::label('password', 'Password:', ['class'=>'col-sm-3']) }}
                            <div class="col-sm-9">
                                {{ Form::password('password',['class'=>'form-control form-control-sm', 'id'=>'password', 'placeholder'=>'Enter User password...', 'required'=>(isset($user_detail) ? false : true)]) }}
                                @error('password')
                                    <span class="alert-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            {{ Form::label('password_confirmation', 'Confirm Password:', ['class'=>'col-sm-3']) }}
                            <div class="col-sm-9">
                                {{ Form::password('password_confirmation',['class'=>'form-control form-control-sm', 'id'=>'password_confirmation', 'placeholder'=>'Enter User password confirmation...', 'required'=>(isset($user_detail) ? false : true)]) }}
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('address', 'Address:', ['class'=>'col-sm-3']) }}
                        <div class="col-sm-9">
                            {{ Form::text('address',@$user_detail->user_info['address'],['class'=>'form-control form-control-sm', 'id'=>'address', 'placeholder'=>'Enter User address...', 'required'=>false]) }}
                            @error('address')
                                <span class="alert-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('phone', 'Phone Number:', ['class'=>'col-sm-3']) }}
                        <div class="col-sm-9">
                            {{ Form::tel('phone',@$user_detail->user_info['phone'],['class'=>'form-control form-control-sm', 'id'=>'phone', 'placeholder'=>'Enter User Phone-number...', 'required'=>false]) }}
                            @error('phone')
                                <span class="alert-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('status', 'Status:', ['class'=>'col-sm-3']) }}
                        <div class="col-sm-9">
                            {{ Form::select('status',['active'=>'Publish', 'inactive'=>'Unpublish'],@$user_detail->status,['id'=>'status','required'=>true, 'class'=>'form-control form-control-sm']) }}
                            @error('status')
                            <span class="alert-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('role', 'User Type:', ['class'=>'col-sm-3']) }}
                        <div class="col-sm-9">
                            {{ Form::select('role',['admin'=>'Admin', 'seller'=>'Seller','user'=>'Customer'],@$user_detail->role,['id'=>'role','required'=>true, 'class'=>'form-control form-control-sm']) }}
                            @error('role')
                            <span class="alert-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                        @php
                            $user_info = isset($user_detail) ? $user_detail->user_info['data'] : null;
                            if($user_info){
                                $user_info = json_decode($user_info);
                            }
                       @endphp
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
                            @if(isset($user_detail))
                                @if(file_exists(public_path().'/uploads/user/Thumb-'.$user_detail->image))
                                    <img src="{{ asset('/uploads/user/Thumb-'.$user_detail->image) }}" alt="" class="img img-thumbnail img-fluid">
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
