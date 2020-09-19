@extends('layouts.layout')
@section('title', 'Dashboard')
@section('content')
 @include('common.commonFunction')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>{{Auth::User()->name}} Dashboard <small></small> </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-md-6">
			<h4>Customer Info</h4>
			<table class="table table-responsive table-stripped table-bordered" style="background-color: #fff">
				<tr>
					<td>Name</td>
					<td><b>{{Auth::User()->name}}</b></td>
				</tr>
				<tr>
					<td>Email</td>
					<td><b>{{Auth::User()->email}}</b></td>
				</tr>
				<tr>
					<td>Phone No</td>
					<td><b>{{Auth::User()->phone_number}}</b></td>
				</tr>
				
			</table>
		</div>
		<div class="col-md-6">
			<h4>Billing History</h4>
			<table class="table table-responsive table-stripped" style="background-color: #fff">
				<th>Billing amount</th>
              	<th>Month</th>
              	<th>Year</th>
              	<th>Status</th>
              	<tbody>
              		@foreach($bill_history as $history)
              			<tr>
              				<td>{{$history->amount}}</td>
              				<td>
			                    @foreach(months() as $key => $mName)
			                      @if($history->bill_month == $key)
			                        {{$mName}}
			                      @endif
			                    @endforeach
              				</td>
							<td>{{  $history->year  }}</td>
		                  <td>
		                    @if($history->status ==1)
		                    <label class="control-label label-success" style="padding: 0px 15px; border-radius: 3px;">Paid</label>
		                    @else
		                    <label class="control-label label-danger" style="padding: 0px 9px; border-radius: 3px;">Due</label>
		                    @endif
		                  </td>
              			</tr>
              		@endforeach
              	</tbody>
			</table>
		</div>
		
	</div>
</section>

@endsection 