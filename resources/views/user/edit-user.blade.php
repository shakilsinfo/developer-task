<?php 
	use App\library\realStateLib;
	$user_add_edit = realStateLib::userWiseAccessSelection('add_edit', 'UserController'); 
?>
@if($user_add_edit==false)
  <script type="text/javascript">window.location.href = '{{url("dashboard")}}';</script>
@endif

@extends('layouts.layout')
@section('title', 'Edit User || RMS Panel')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1><i class="fa fa-user-plus"></i> Edit User</h1>
  <ol class="breadcrumb">
    <li><a href="{{URL::to('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{URL::to('users')}}">Users</a></li>
    <li class="active">Edit User</li>
  </ol>
</section>
<section class="content">
  <!-- Default box -->
  @include('common.message')
  <div class="box box-success">
 	{!! Form::open(array('route' => ['users.update',$data->id],'class'=>'form-horizontal','method' =>'PUT','files'=>true)) !!}
    <div class="box-header with-border" align="right">
     <button type="submit" class="btn btn-success" id="submit"><i class="fa fa-floppy-o"></i> <b>Update Information</b></button>&nbsp;&nbsp;<a href="{{URL::to('users')}}" class="btn btn-primary"><i class="fa fa-mail-reply"></i> <b>Back</b></a> </div>
    <div class="box-body">
    <input type="hidden" name="id" value="{{$data->id}}">
    <div class="col-md-8">
	   <div class="panel panel-default">
	   		<div class="panel-heading"><h4 style="font-size: 22px;"><i class="fa fa-user" ></i> <b>Profile Info:</b></h4></div>
	   		<div class="panel-body">
	   			<div class="form-group">
				    <div class="col-md-6">
				      <label for="userRole">User Name:</label>
				      <input type="text" name="name" class="form-control" placeholder="Give your name" required value="{{$data->name}}">
				    </div>
				    <div class="col-md-6">
				      <label for="userRole">User Email:</label>
				      <input type="email" name="email" class="form-control" placeholder="somthing@example.com" value="{{$data->email}}" required>
				    </div>
				</div>
				<div class="form-group">
				    <div class="col-md-6">
				      <label for="userRole">Phone Number:</label>
				      <input type="text" name="phone_number" class="form-control" value="{{$data->phone_number}}" placeholder="01***********">
				    </div>
				    <div class="col-md-6">
				      <label for="userRole">National ID:</label>
				      <input type="text" name="nid" class="form-control" placeholder="National ID Number" value="{{$data->nid}}">
				    </div>
				</div>
				<div class="form-group">
				    <div class="col-md-6">
				      <label for="userRole">Profession:</label>
				      <input type="text" name="profession" class="form-control" placeholder="Give Your Profession" value="{{$data->profession}}">
				    </div>
				    <div class="col-md-6">
				    	<label for="user_type">User Type:</label>
					    <select name="user_type" class="form-control">
					      	<option value="0">--- Select a Type ---</option>
					      	@foreach($usertypes as $type)
					      	<option value="{{$type->id}}" {{($data->user_type==$type->id)?'selected':''}}>{{$type->user_type}}</option>
					      	@endforeach
					    </select>
					</div>
				</div>

				<div class="form-group">
				    <div class="col-md-12">
				      <label for="userRole">Present Address:</label>
				      <textarea name="present_address" class="form-control">{{$data->present_address}}</textarea>
				    </div>
				</div>
				<div class="form-group">
				    <div class="col-md-12">
				      <label for="userRole">Parmanent Address:</label>
				      <textarea name="parmanent_address" class="form-control">{{$data->parmanent_address}}</textarea>
				    </div>
				</div>
				<div class="form-group">
				    <div class="col-md-12">
				    	<label for="status">Status : </label>
				        {{Form::select('status', array('1' => 'Active', '0' => 'Inactive'),$data->status, ['class' => 'form-control'])}}
				    </div>
				</div>
	   		</div>
	   </div>  
	</div>
	<div class="col-md-4">
		<div class="panel panel-default">
			<div class="panel-heading"><h4 style="font-size: 22px;"><i class="fa fa-camera" ></i> <b>Profile Picture:</b></h4></div>
			<div class="panel-body" align="center">
				<div class="form-group">
					<div class="select_image" style="width: 250px; height: 300px; border:1px solid #ccc;">
						@if($data->image !=null)
							<img src='{{asset("storage/app/public/uploads/users/$data->image")}}' id="profile-image" style="width: 100%;height: 100%">
						@else
							<img src='{{asset("storage/app/public/uploads/profile.png")}}' id="profile-image" style="width: 100%;height: 100%">
						@endif
						
					</div>
					<label class="btn btn-success" style="width: 250px;margin-top: 5px;">
					   Browse <input type="file" name="image" class="form-control" id="profile-image-select" style="display: none;">
					</label>
				</div>
			</div>
		</div>
	</div>
  	{!! Form::close() !!} 
	</div>
   </div>
</section>

<script type="text/javascript">
	$('#pass2').on('keyup', function () {
  if ($('#pass1').val() == $('#pass2').val()) {
    $('#confirmMsg').html('Password Matched!!').css('color', 'green');
  } else 
    $('#confirmMsg').html('Password Do not Matched!!').css('color', 'red');
});
	$('#submit').on('click',function(){
		if ($('#pass1').val() == $('#pass2').val()){
			return true;
		}else{
			 $('#confirmMsg').html('Password Do not Matched!!').css('color', 'red');
			return false;
		}
	})
	  $(document).ready(function(){
            function readURL(input) {
                if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#profile-image').attr('src', e.target.result);
                }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#profile-image-select").change(function(){
                readURL(this);
            });
        });
</script>
@endsection
