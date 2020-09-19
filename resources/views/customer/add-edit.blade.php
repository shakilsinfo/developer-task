
@extends('layouts.layout')
@section('title', 'Add/Edit Customer')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1><i class="fa fa-user-plus"></i> Add/Edit Customers</h1>
  <ol class="breadcrumb">
    <li><a href="{{URL::to('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{URL::to('customer-list')}}">All Customer</a></li>
    <li class="active">Add Customers</li>
  </ol>
</section>
<section class="content">
  <!-- Default box -->
  @include('common.message')
  <div class="box box-success">
 	
    <div class="box-header with-border" align="right">
		@if( !empty($customer_data) )
			{{Form::open(array('route'=>['customer-list.update',$customer_data->id],'method'=>'PUT','files'=>true))}}
			<button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> <b>Update Information</b></button>
		@else
			{{Form::open(array('route'=>['customer-list.store'],'method'=>'POST','files'=>true))}}
			<button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> <b>Save Information</b></button>
		@endif &nbsp;&nbsp; 
			<a href="{{  url('customer-list')  }}" class="btn btn-primary"><i class="fa fa-align-justify"></i> <b> View Customer List</b></a> 
	</div>
   <div class="box-body">

    <div class="col-md-8">
	   <div class="panel panel-primary">
          <div class="panel-heading"><i class="fa fa-info-circle"></i> Customer Info</div>
          <div class="panel-body">
          	<div class="col-md-12">
				<div class="form-group">
			      <label for="name">Customer Name:</label>

			      <input type="text" name="name" class="form-control" value="{{isset($customer_data->name)?$customer_data->name:old('name')  }}" placeholder="Give your name" required id="">
			    </div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
			      <label for="email">Employee Email:</label>
			      <input type="email" name="email" class="form-control" value="{{isset($customer_data->email)?$customer_data->email:old('email')  }}" placeholder="somthing@example.com" id="email" required>
			    </div>
			</div>
			
		
			  <div class="col-md-12">
			  	<div class="form-group">
			      <label for="phoneNo">Phone Number:</label>
			      <input type="text" name="phone_number" class="form-control" id="phoneNo" value="{{isset($customer_data->phone_number)?$customer_data->phone_number:old('phone_number')  }}" placeholder="01**************"  placeholder="01***********">
			    </div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
			      <label for="preAdd">Present Address:</label>
			      <input type="text" name="present_address" id="preAdd" value="{{isset($customer_data->present_address)?$customer_data->present_address:old('present_address')  }}" class="form-control" placeholder="Give your present address">
			    </div>
			</div>
			
			 <div class="col-md-12">
			 	<div class="form-group">
					<label for="resignDate" >Status: </label>
					@if( !empty($customer_data) )
						{{Form::select('status', array('1' => 'Active', '2' => 'Inactive'),$customer_data->status, ['class' => 'form-control'])}}
					@else
					<select name="status" class="form-control">
					<option value="">----Select Status----</option>
						<option value="1">Active</option>
						<option value="2">Inactive</option>
					</select>
					@endif
				</div>
			 </div>
			 @if(empty($customer_data))
			 <div class="col-md-12">
				<div class="form-group">
			      <label for="preAdd">Given Password:</label>
			      <input type="password" name="password" class="form-control" placeholder="*******">
			    </div>
			</div>
			@endif
          </div>
       </div>  
		
	</div>

	</div>
  	{!! Form::close() !!} 
   </div>
</section>
<script type="text/javascript">
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
