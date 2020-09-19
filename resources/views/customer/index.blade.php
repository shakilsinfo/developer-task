
@extends('layouts.layout')
@section('title', 'Customer List')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1><i class="fa fa-list"></i> Customer List</h1>
  <ol class="breadcrumb">
    <li><a href="{{URL::to('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"><a href="{{URL::to('customer-list')}}">Customers</a></li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <!-- Default box -->
  @include('common.message')
  <div class="box box-success">
    <div class="box-header with-border" align="right">
      <a href="{{  route('customer-list.create')  }}" class="btn btn-success"><i class="fa fa-plus"></i> <b>Add New</b></a> 
      <a href="{{ url('customer-list') }}" class="btn btn-warning"><i class="fa fa-refresh"></i> <b>Refresh</b></a> 
    </div>

    <div class="box-body">
     
      <div class="table-responsive">
        <table class="table table-bordered table-striped table-responsive">
              <th>S/L</th>
              <th>Customer Name</th>
              <th>Email</th>
              <th>Phone Number</th>
              <th>Address</th>
              
              <th>Status</th>
              <th>Action</th>
              <?php                  
                $number = 1;
                $numElementsPerPage = 10; // How many elements per page
                $pageNumber = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                $currentNumber = ($pageNumber - 1) * $numElementsPerPage + $number;
              ?>
         
          <tbody id="mainList">
            
            @foreach($allCustomer as $data)
              <tr>
                <td><label class="label label-success">{{$currentNumber++}}</label></td>
               
                <td>{{ $data->name }}</td>
                <td>{{$data->email}}</td>
                <td>{{$data->phone_number}}</td>
                <td>{{$data->present_address}}</td>
                
                <td>
                  @if($data->status ==1)
                  <label class="control-label label-success" style="padding: 0px 15px; border-radius: 3px;">Active</label>
                  @else
                  <label class="control-label label-danger" style="padding: 0px 9px; border-radius: 3px;">Inactive</label>
                  @endif
                </td>
                <td>
                  <div class="form-inline">
                    <div class="input-group">
                      <a href='{{route("customer-list.edit",$data->id)}}' class="btn btn-primary btn-xs" style="padding: 1px 15px;">Edit</a>
                    </div>
                    <div class="input-group">
                      {{Form::open(array('route'=>['customer-list.destroy',$data->id],'method'=>'DELETE'))}}
                        <button type="submit" class="btn btn-danger btn-xs confirm" title="Delete" confirm="Are You Sure You Want to Delete This Customer?" style="padding: 1px 9px;">Delete</button>
                      {!! Form::close() !!}
                    </div>
                    
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
          
        </table>
        <div align="center">{{ $allCustomer->render() }}</div>
      </div>
    </div>

    <!-- /.box-body -->
    <div class="box-footer"> </div>
    <!-- /.box-footer-->
  </div>
</section>

<!-- /.content -->
@endsection 