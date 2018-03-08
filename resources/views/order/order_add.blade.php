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
                    <h3 class="col-lg-12" style="float:none;margin:auto">Add Order</h3>
                </div>

                <div class="panel-body">

                    <div class="form-body">
                        <div class="row">

                            <div style="padding-left:20px;padding-right:20px;" class="form-group">

                                <button type="button" style="display: block" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">Client</button>
                                <button type="button" style="display:block; margin-top: 5px" class="btn btn-dark btn-lg" data-toggle="modal" data-target="#myModal2">Items</button>

                                <div style="display:block; margin-top: 5px" class="dropdown">
                                    <button class="btn btn-info btn-lg" type="button" data-toggle="dropdown"><span id="channel">Channel</span>
                                    <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a class="channelItem">Instagram</a></li>
                                        <li><a class="channelItem">Facebook</a></li>
                                        <li><a class="channelItem">MercadoLibre</a></li>
                                        <li><a class="channelItem">Contact</a></li>
                                    </ul>
                                </div>

                                <div style="display:block; margin-top: 5px" class="dropdown">
                                    <button class="btn btn-danger btn-lg" type="button" data-toggle="dropdown"><span id="fabricator">Fabricator</span>
                                    <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a class="fabricatorItem">Pela</a></li>
                                        <li><a class="fabricatorItem">Felix</a></li>
                                    </ul>
                                </div>

                                <div style="display:block; margin-top: 5px" class="dropdown">
                                    <button class="btn btn-warning btn-lg" type="button" data-toggle="dropdown"><span id="type">Type</span>
                                    <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a class="typeItem">Retail</a></li>
                                        <li><a class="typeItem">Wholesale</a></li>
                                        <li><a class="typeItem">Settlement</a></li>
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

<!--__________________________________________________________________________________________________________________-->
<!--______________________________________MODAL CLIENTS_______________________________________________________________-->
<!--__________________________________________________________________________________________________________________-->

    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
        
          <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Client</h4>
                </div>
                <div class="modal-body">
                    
                    <div class="form-group">
                        {{ Form::text('q', '', ['id' =>  'q', 'placeholder' =>  'Enter name'])}}
                        {{ Form::submit('Search', array('class' => 'button expand')) }}
                        <a style="float:right" id="clean_client" class="btn btn-info">Clean</a>

                    </div>

                    <div class="form-group">
                                
                        {{ Form::hidden('client_id', '' , array('id' => 'client_id', 'class' => 'form-control')) }}
                        
                        <div class="form-group">
                            {{ Form::label('name', 'Name', array('id' => '', 'class' => 'col-md-20 control-label')) }}
                            <div class="col-md-20">
                            {{ Form::text('name', '' , array('id' => 'name', 'class' => 'form-control')) }}
                            </div>

                            {{ Form::label('instagram', 'Instagram', array('id' => '', 'class' => 'col-md-20 control-label')) }}
                            <div class="col-md-20">
                            {{ Form::text('instagram', '' , array('id' => 'instagram', 'class' => 'form-control')) }}
                            </div>
                        
                        </div>

                         <div class="form-group">
                            {{ Form::label('facebook', 'Facebook', array('id' => '', 'class' => 'col-md-20 control-label')) }}
                            <div class="col-md-20">
                            {{ Form::text('facebook', '' , array('id' => 'facebook', 'class' => 'form-control')) }}
                            </div>

                            {{ Form::label('phone', 'Phone', array('id' => '', 'class' => 'col-md-20 control-label')) }}
                            <div class="col-md-20">
                            {{ Form::text('phone', '' , array('id' => 'phone', 'class' => 'form-control')) }}
                            </div>

                        </div>

                        <div class="form-group">
                            {{ Form::label('address', 'Address', array('id' => '', 'class' => 'col-md-20 control-label')) }}
                            <div class="col-md-20">
                            {{ Form::text('address', '' , array('id' => 'address', 'class' => 'form-control')) }}
                            </div>
                            
                            {{ Form::label('email', 'Client email', array('id' => '', 'class' => 'col-md-20 control-label')) }}
                            <div class="col-md-20">
                            {{ Form::text('email', '' , array('id' => 'email', 'class' => 'form-control')) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!--__________________________________________________________________________________________________________________-->
<!--______________________________________MODAL ITEMS_________________________________________________________________-->
<!--__________________________________________________________________________________________________________________-->

    <div class="modal fade" id="myModal2" role="dialog">
        <div class="modal-dialog">
        
          <!-- Modal content-->
            <div class="modal-content" style="width: fit-content;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Items</h4>
            </div>
            <div class="modal-body">
                
                <div class="form-group">
                    {{ Form::text('p', '', ['id' =>  'p', 'placeholder' =>  'search product'])}}
                    {{ Form::submit('Search', array('class' => 'button expand')) }}

                    <div id="imgHolder" style="float:right"></div>

                </div>



                <div class="form-group">
                            
                    {{ Form::hidden('product_id', '' , array('id' => 'product_id', 'class' => 'form-control')) }}

                    <div class="form-group">
                        {{ Form::label('description', 'Description', array('id' => '', 'class' => 'col-md-20 control-label')) }}
                        <div class="col-md-20">
                        {{ Form::text('description', '' , array('id' => 'description', 'disabled' => 'true', 'class' => 'form-control')) }}
                        </div>
                    </div>

                    <div style="margin-top:10px" class="row">
                        {{ Form::label('model', 'Model', array('id' => '', 'class' => 'col-md-3 control-label')) }}
                        <div class="margin-top-10 col-md-3">
                        {{ Form::text('model', '' , array('id' => 'model', 'disabled' => 'true', 'class' => 'form-control')) }}
                        </div>

                        {{ Form::label('stock', 'Stock', array('id' => '', 'class' => 'col-md-3 control-label')) }}
                        <div class="margin-top-10 col-md-3">
                        {{ Form::text('stock', '' , array('id' => 'stock', 'disabled' => 'true', 'class' => 'form-control')) }}
                        </div>

                    </div>
                    <div style="margin-top:10px" class="row">
                        {{ Form::label('wholesale', 'Wholesale', array('id' => '', 'class' => 'col-md-3 control-label')) }}
                        <div class="margin-top-10 col-md-3">
                        {{ Form::text('wholesale', '' , array('id' => 'wholesale', 'disabled' => 'true', 'class' => 'form-control')) }}
                        </div>
                        
                        {{ Form::label('retail', 'Retail', array('id' => '', 'class' => 'col-md-3 control-label')) }}
                        <div class="margin-top-10 col-md-3">
                        {{ Form::text('retail', '' , array('id' => 'retail', 'disabled' => 'true', 'class' => 'form-control')) }}
                        </div>

                    </div>
                    <div style="margin-top:10px" class="row">
                        {{ Form::label('amount', 'Amount', array('id' => '', 'class' => 'col-md-3 control-label')) }}
                        <div class="margin-top-10 col-md-3">
                        {{ Form::number('amount', '', array('id' => 'amount', 'disabled' => 'true', 'min' => '1', 'class' => 'form-control')) }}
                        </div>
                               
                        {{ Form::label('unit_price', 'Unit Price', array('id' => '', 'class' => 'col-md-3 control-label')) }}
                        <div class="margin-top-10 col-md-3">
                        {{ Form::number('unit_price', '', array('id' => 'unit_price', 'disabled' => 'true', 'class' => 'form-control')) }}
                        </div>

                    </div>

                    <div style="margin-top:10px"  class="form-group">
                        {{ Form::label('comment', 'Comment', array('id' => '', 'class' => 'col-md-3 control-label')) }}
                        <div class="col-md-20">
                        {{ Form::text('comment', '' , array('id' => 'comment', 'class' => 'form-control')) }}
                        </div>

                    </div>
                    
                    <div style="margin-top:10px" class="col-md-20">
                        <a id="add_item" class="disabled btn btn-success">Add item</a>
                        <a id="clean_item" class="disabled btn btn-info">Clean</a>
                    </div>
                    
                    </div>

                    <div class="form-group">
                        <table style="width:100%" class="table table-bordered" id="product-table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Model</th>
                                    <th>Amount</th>
                                    <th>Unit Price</th>
                                    <th>Comment</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="itemsBody"></tbody>
                        </table>
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
    {{ HTML::script('assets/scripts/order/order_add.js') }}
    {{ HTML::script('assets/scripts/client/client.js') }}
@endsection

