<?php  
  use App\library\realStateLib;
  $user_add_edit = realStateLib::userWiseAccessSelection('add_edit', 'UserController');
  $user_delete = realStateLib::userWiseAccessSelection('delete', 'UserController');
?>

@extends('layouts.layout')
@section('title', 'User List')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1><i class="fa fa-list"></i> User List</h1>
  <ol class="breadcrumb">
    <li><a href="{{URL::to('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"><a href="{{URL::to('users')}}">Users</a></li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <!-- Default box -->
  @include('common.message')
  <div class="box box-success">
    <div class="box-header with-border" align="right">
      @if($user_add_edit==true)
      <a href="{{  url('add-user')  }}" class="btn btn-success"><i class="fa fa-plus"></i> <b>Add New</b></a> 
      @endif
      <a href="{{ URL::to('users')}}" class="btn btn-warning"><i class="fa fa-refresh"></i> <b>Refresh</b></a> </div>

    <div class="box-body">
      <div class="form-group">
        <div class="row col-md-4 pull-right">
          {!! Form::open(array('url' => 'search-user','class'=>'form-horizontal','method' =>'POST','files'=>true)) !!}
          @if(isset($autocomplete))
          <input name="user_search" value="{{$autocomplete}}" id="searchUser" class="form-control filter_wow" placeholder="Search by User name....." type="text" selected>
          @else
          <input name="user_search" value="" id="searchUser" class="form-control filter_wow" placeholder="Search by User name....." type="text" selected>
          @endif
         {!! Form::close() !!}
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="table-responsive">
        <table class="table table-bordered table-striped table-responsive">
              <th>S/L</th>
              <th>Image</th>
              <th>User Name</th>
              <th>Email</th>
              <th>Phone Number</th>
              <th>National ID</th>
              <th>Status</th>
              <th colspan="2">Action</th>
              <?php 
                                            
              $number = 1;
              $numElementsPerPage = 25; // How many elements per page
              $pageNumber = isset($_GET['page']) ? (int)$_GET['page'] : 1;
              $currentNumber = ($pageNumber - 1) * $numElementsPerPage + $number;
              
           ?>
          @if(isset($searchUser))
          <tbody>
            @foreach($searchUser as $search)
              <tr>
                <td>{{  $currentNumber++  }}</td>
                <td>
                  @if($search->image !=null)
                    <img src='{{asset("storage/app/public/uploads/users/$search->image")}}' style="width: 35px" class="img-circle">
                  @else
                    <img src='{{asset("storage/app/public/uploads/profile.png")}}' style="width: 35px" class="img-circle">
                  @endif
                </td>
                <td>{{ $search->name }}</td>
                <td>{{$search->email}}</td>
                <td>{{$search->phone_number}}</td>
                <td>{{$search->nid}}</td>
                <td><i class="{{($search->status==1)? 'fa fa-check-circle success' : 'fa fa-times-circle-o danger'}}"></i></td>
                <td>
                  <div class="form-inline">
                    @if($user_add_edit==true)
                      <div class = "input-group">
                         <a href='{{URL::to("/edit-user/$search->id")}}' class="btn btn-primary btn-xs">Edit</a>
                      </div>
                    @endif
                    @if($user_delete==true)
                      <div class = "input-group"> 
                       {{Form::open(array('route'=>['users.destroy',$search->id],'method'=>'DELETE'))}}
                        <button type="submit" class="btn btn-danger btn-xs" onclick="return deleteConfirm()" title="Delete">Delete</button>
                      {!! Form::close() !!}
                      </div>
                    @endif
                  </div>
                 
                </td>
              </tr>
              @endforeach
          </tbody>
          @else
          <tbody id="mainList">
            
            @foreach($allUser as $data)
              <tr>
                <td>{{  $currentNumber++  }}</td>
                <td>
                 @if($data->image !=null)
                    <img src='{{asset("storage/app/public/uploads/users/$data->image")}}' style="width: 35px" class="img-circle">
                  @else
                    <img src='{{asset("storage/app/public/uploads/profile.png")}}' style="width: 35px" class="img-circle">
                  @endif
                </td>
                <td>{{ $data->name }}</td>
                <td>{{$data->email}}</td>
                <td>{{$data->phone_number}}</td>
                <td>{{$data->nid}}</td>
                <td><i class="{{($data->status==1)? 'fa fa-check-circle success' : 'fa fa-times-circle danger'}}"></i></td>
                <td>
                  <div class="form-inline">
                    @if($user_add_edit==true)
                      <div class = "input-group">
                         <a href='{{URL::to("/edit-user/$data->id")}}' class="btn btn-primary btn-xs">Edit</a>
                      </div>
                    @endif
                    @if($user_delete==true)
                      <div class = "input-group"> 
                       {{Form::open(array('route'=>['users.destroy',$data->id],'method'=>'DELETE'))}}
                        <button type="submit" class="btn btn-danger btn-xs" onclick="return deleteConfirm()" title="Delete">Delete</button>
                      {!! Form::close() !!}
                      </div>
                    @endif
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
          @endif
        </table>
        @if(isset($searchUser))
        <div align="center">{{ $searchUser->render() }}</div>
        @else
        <div align="center">{{ $allUser->render() }}</div>
        @endif
      </div>
    </div>

    <!-- /.box-body -->
    <div class="box-footer"> </div>
    <!-- /.box-footer-->
  </div>
  <!-- /.box -->



</section>
<script type="text/javascript">
  function deleteConfirm()
  {
    var con = confirm("Do you want to delete ?");
    if(con){  
      return true;
    }else{
      return false;
    }
  }
</script>
<!-- /.content -->
@endsection 