@extends('layouts.app')

<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
<style type="text/css">
    .ui-widget-content {
    z-index: 10000000000 !important;
    }
</style>
@section('content')
<div class="container">
    
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="col-lg-12" style="float:none;margin:auto">Order View</h3>
                </div>

                <div class="panel-body">

                    <div class="form-body">

                        <div class="form-group">
                            <table style="width:100%" class="table table-bordered" id="product-table">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Model</th>
                                        <th>Amount</th>
                                        <th>Unit Price</th>
                                        @if ($order->status == 'Pending')
                                        <th>Comment</th>
                                        <th>Stock</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody id="itemsBody">
                                @foreach($items as $item)
                                    <tr>  
                                        <td> {{ $item['product_id'] }} </td> 
                                        <td> <span class="btn btn-xs btn-success model"> {{ $item['model'] }} </span> </td> 
                                        <td> {{ $item['amount'] }} </td> 
                                        <td> {{ $item['unit_price'] }} </td> 
                                        @if ($order->status == 'Pending')
                                        <td> {{ $item['comment'] }} </td> 
                                        <td>
                                            @if ($item['amount'] < $item['stock']) 
                                                <span class="label label-success">Enough ({{$item['stock']}})</span>
                                            @else
                                                <span class="label label-danger">Not Enough ({{$item['stock']}})</span>
                                            @endif
                                        </td> 
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="form-group">
                            <span style="float:left; font-size:16px;margin-bottom:20px; margin-right:20px" class="label label-info">Status:  {{ $order->status }}</span>
                            <span style="float:left; font-size:16px;margin-bottom:20px" class="label label-info">Type:  {{ $order->type }}</span>
                            <span style="float:right; font-size:16px" class="label label-info">Total:  ${{ $total }}</span>
                        
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="col-lg-12" style="float:none;margin:auto">Client Info</h3>
                </div>

                <div class="panel-body">

                    <div class="form-body">
                        
                        <div class="form-group">
                            {{ Form::label('name', 'Name', array('id' => '', 'class' => 'col-md-20 control-label')) }}
                            <div class="col-md-20">
                            {{ Form::text('name', $client->name , array('id' => 'name', 'class' => 'form-control')) }}
                            </div>

                            {{ Form::label('instagram', 'Instagram', array('id' => '', 'class' => 'col-md-20 control-label')) }}
                            <div class="col-md-20">
                            {{ Form::text('instagram', $client->instagram , array('id' => 'instagram', 'class' => 'form-control')) }}
                            </div>
                        
                        </div>

                         <div class="form-group">
                            {{ Form::label('facebook', 'Facebook', array('id' => '', 'class' => 'col-md-20 control-label')) }}
                            <div class="col-md-20">
                            {{ Form::text('facebook', $client->facebook , array('id' => 'facebook', 'class' => 'form-control')) }}
                            </div>

                            {{ Form::label('phone', 'Phone', array('id' => '', 'class' => 'col-md-20 control-label')) }}
                            <div class="col-md-20">
                            {{ Form::text('phone', $client->phone , array('id' => 'phone', 'class' => 'form-control')) }}
                            </div>

                        </div>

                        <div class="form-group">
                            {{ Form::label('address', 'Address', array('id' => '', 'class' => 'col-md-20 control-label')) }}
                            <div class="col-md-20">
                            {{ Form::text('address', $client->address , array('id' => 'address', 'class' => 'form-control')) }}
                            </div>
                            
                            {{ Form::label('email', 'Client email', array('id' => '', 'class' => 'col-md-20 control-label')) }}
                            <div class="col-md-20">
                            {{ Form::text('email', $client->email , array('id' => 'email', 'class' => 'form-control')) }}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('scripts')
    {{ HTML::script('assets/scripts/jquery.min.js') }}
    {{ HTML::script('assets/scripts/jquery-ui.min.js') }}
    {{ HTML::script('assets/scripts/datatables.js') }}
    {{ HTML::script('assets/scripts/order/order_view.js') }}
@endsection

