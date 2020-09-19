
@extends('layouts.layout')
@section('title', 'Customer Bill')
@section('content')

<section class="content-header">
  <h1><i class="fa fa-money"></i> Customer bill</h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Customer Bill</li>
  </ol>
</section>

<section class="content">

  @include('common.message')
  @include('common.commonFunction')

  <div class="box box-success">

    <div class="box-header with-border" align="right">
      
      <a href="#addModal" class="btn btn-success" data-toggle="modal">
        <i class="fa fa-plus"></i> <b>Add New</b>
      </a> 
      <a href="{{  url('bill-generate')  }}" class="btn btn-warning">
        <i class="fa fa-refresh"></i> <b>Refresh</b>
      </a> 
    </div>

    <div class="box-body">
      
      <div class="table_scroll">
        <table class="table table-bordered table-striped table-responsive">
              <th>Custom name</th>
              <th>Billing amount</th>
              <th>Month</th>
              <th>Year</th>
              <th>Status</th>
              <th>Action</th>
          <tbody>
            @if(isset($billList) && count($billList)>0)

              @foreach($billList as $data)
                <tr>
                  <td><strong>{{  $data->getUserData->name  }}</strong></td>
                  <td>{{  $data->amount  }} BDT</td>
                  <td>
                    @foreach(months() as $key => $mName)
                      @if($data->bill_month == $key)
                        {{$mName}}
                      @endif
                    @endforeach
                  </td>
                  <td>{{  $data->year  }}</td>
                  <td>
                    @if($data->status ==1)
                    <label class="control-label label-success" style="padding: 0px 15px; border-radius: 3px;">Paid</label>
                    @else
                    <label class="control-label label-danger" style="padding: 0px 9px; border-radius: 3px;">Due</label>
                    @endif
                  </td>
                  <td>
                    <div class="form-inline">
                      
                        <div class = "input-group">
                          <a href="#editModal{{$data->id}}" class="btn btn-primary btn-xs" data-toggle="modal" style="padding: 1px 14px">Edit</a>
                        </div>
                      
                        <div class = "input-group"> 
                          {{Form::open(array('route'=>['bill-generate.destroy',$data->id],'method'=>'DELETE'))}}
                            <button type="submit" confirm="Are you sure you want to delete this Bill ?" class="btn btn-danger btn-xs confirm" title="Delete" style="padding: 1px 8px">Delete</button>
                          {!! Form::close() !!}
                        </div>
                      
                    </div>

                    <!-- Modal Start -->
                      <div class="modal fade" id="editModal{{$data->id}}" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-sm">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Bill</h4>
                            </div>
                              {!! Form::open(array('route' => ['bill-generate.update', $data->id],'class'=>'form-horizontal','method'=>'PUT')) !!}
                            <div class="modal-body">
                              <div class="form-group">
                                <div class="col-md-12">
                                  <label for="category_name">Customer Name: </label>
                                  <select class="form-control" name="customer_id" id="categoryId" required>
                                    <option value="0">----Select Customer----</option>
                                    @foreach($allCustomer as $customer)
                                    <option value="{{$customer->id}}" {{($data->customer_id==$customer->id)?'selected':''}}>{{$customer->name}}</option>
                                    @endforeach
                                  </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                  <label for="amount">Billing Amount: </label>
                                  <input type="text" name="amount" class="form-control"  placeholder="billing amount" value="{{$data->amount}}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                  <label for="amount">Billing Month: </label>
                                  <select class="form-control" name="bill_month" required>
                                    <option value="0">Select Month</option>
                                    @foreach(months() as $key=> $month)
                                    <option value="{{$key}}" {{($key==$data->bill_month)?'selected':''}}>{{$month}}</option>
                                    @endforeach
                                  </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                  <label for="amount">Billing Year: </label>
                                  <select class="form-control" name="year" required>
                                    <option value="0">Select Year</option>
                                    @foreach(years() as $key => $year)
                                    <option value="{{$year}}" {{($data->year==$year)?'selected':''}}>{{$year}}</option>
                                    @endforeach
                                  </select>
                                </div>
                            </div>
                              <div class="form-group">
  	                              <div class="col-md-12">
  	                                <label for="status" class="col-form-label">Status: </label>
  	                                {{Form::select('status', array('1' => 'Paid', '2' => 'Due'),$data->status, ['class' => 'form-control'])}}
  	                                </div>
  	                          </div>
                                 
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                      {{Form::submit('Update',array('class'=>'btn btn-success'))}}
                            </div>
                              {!! Form::close() !!}
                          </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                      </div>
                    <!-- /.modal -->
                   
                  </td>
                </tr>
              @endforeach
              @else
              <tr>
                <td colspan="6" align="center"> <h3>No Bill Found</h3></td>
              </tr>
              @endif
          </tbody>
        </table>
        <div align="center">{{ $billList->render() }}</div>
      </div>

    </div>

    <div class="box-footer"> </div>

  </div>
</section>

<!-- Modal -->
  <div class="modal fade" id="addModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"><i class="fa fa-plus-square"></i> Add Bill</h4>
        </div>
          {!! Form::open(array('route' => ['bill-generate.store'],'class'=>'form-horizontal','method'=>'POST')) !!}
        <div class="modal-body">
          <div class="form-group">
              <div class="col-md-12">
                <label for="category_name">Customer Name: </label>
                <select class="form-control" name="customer_id" id="categoryId" required>
                  <option value="0">----Select Customer----</option>
                  @foreach($allCustomer as $customer)
                  <option value="{{$customer->id}}">{{$customer->name}}</option>
                  @endforeach
                </select>
              </div>
          </div>
          <div class="form-group">
              <div class="col-md-12">
                <label for="amount">Billing Amount: </label>
                <input type="text" name="amount" class="form-control"  placeholder="billing amount" required>
              </div>
          </div>
          <div class="form-group">
              <div class="col-md-12">
                <label for="amount">Billing Month: </label>
                <select class="form-control" name="bill_month" required>
                  <option value="0">Select Month</option>
                  @foreach(months() as $key=> $month)
                  <option value="{{$key}}">{{$month}}</option>
                  @endforeach
                </select>
              </div>
          </div>
          <div class="form-group">
              <div class="col-md-12">
                <label for="amount">Billing Year: </label>
                <select class="form-control" name="year" required>
                  <option value="0">Select Year</option>
                  @foreach(years() as $key => $year)
                  <option value="{{$year}}">{{$year}}</option>
                  @endforeach
                </select>
              </div>
          </div>
          <div class="form-group">
              <div class="col-md-12">
                <label for="status" class="col-form-label">Status: </label>
                <select class="form-control" name="status" >
                      <option value="1">Paid</option>
                      <option value="2">Due</option>
                    </select>
              </div>
          </div>
        
        
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  {{Form::submit('Save',array('class'=>'btn btn-success'))}}
        </div>
          {!! Form::close() !!}
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>
<!-- /.modal -->

<script type="text/javascript">

  $('.statusUpdate').on('click',function(){
    if($(this).prop("checked") == true){
      var dataId = $(this).data('id');
      
      $.ajax({
          headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
          method: "POST",
          url: "{{URL::to('bill-generate-update')}}",
          data: {
            'status': 1,
            'id'    : dataId
          },
          dataType: "json",
          success: function(data){
            
            $.notify(data[0],'success');    
          },
          error: function(data){
           
          }
      });
    }else{
       var dataId = $(this).data('id');
       
      $.ajax({
          headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
          method: "POST",
          url: "{{URL::to('blog-category-update')}}",
          data: {
            'status': 0,
              'id' : dataId
          },
          dataType: "json",
          success: function(data){
            $.notify(data[1],'warning');    
          },
          error: function(data){
           
          }
      });
    }
  })
</script>
@endsection 