@extends('layouts.app')

<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div style="height:70px" class="panel-heading">
                    <div style="display: inline-block; margin:0px; padding:0px; float:left">
                        <h3>Orders</h3>
                    </div>
                    <div style="display: inline-block; margin:0px; padding:0px; float:right">
                        <a href="{{ url('/orders/add') }}" style="float:left" class=" col btn btn-primary">Add</a>
                    </div>
                </div>

                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#pending">Pending</a></li>
                    <li><a data-toggle="tab" href="#sold">Sold</a></li>
                    <li><a data-toggle="tab" href="#cancelled">Cancelled</a></li>
                </ul>

                <div class="tab-content">
                    <div id="pending" class="tab-pane fade in active">
                        <div class="panel-body">
                           <table style="width:100%" class="table table-bordered" id="order-table-pending">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Stock</th>
                                        <th>Type</th>
                                        <th>Client</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div id="sold" class="tab-pane fade in">
                        <div class="panel-body">
                           <table style="width:100%" class="table table-bordered" id="order-table-sold">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Type</th>
                                        <th>Client</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div id="cancelled" class="tab-pane fade in">
                        <div class="panel-body">
                           <table style="width:100%" class="table table-bordered" id="order-table-cancelled">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Type</th>
                                        <th>Client</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

<!--__________________________________________________________________________________________________________________-->
<!--______________________________________STATUS MODAL________________________________________________________________-->
<!--__________________________________________________________________________________________________________________-->

    <div class="modal fade" id="statusModal" role="dialog">
        <div class="modal-dialog">
        
          <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Change Order Status</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                                
                        {{ Form::hidden('order_id', '' , array('id' => 'order_id', 'class' => 'form-control')) }}
                        
                        <div class="form-group">
                            <div style="display:inline" class="dropdown">
                                <button class="btn btn-info btn-lg" type="button" data-toggle="dropdown"><span id="status">Status</span>
                                <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li><a class="statusItem soldStatusItem">Sold</a></li>
                                    <li><a class="statusItem">Cancelled</a></li>
                                </ul>
                            </div>

                            <div style="display:inline" class="dropdown">
                                <button class="btn btn-info btn-lg" type="button" data-toggle="dropdown"><span id="payment_type">Payment Type</span>
                                <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li><a class="pTypeItem">Real</a></li>
                                    <li><a class="pTypeItem">Virtual</a></li>
                                </ul>
                            </div>

                            <button style="float:right" type="button" class="btn btn-success btn-lg" id="submit">Submit</button>

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
    {{ HTML::script('assets/scripts/validators/orderValidator.js') }}
    {{ HTML::script('assets/scripts/order/order.js') }}
@endsection

