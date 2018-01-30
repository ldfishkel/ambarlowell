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
                    <h3 class="col-lg-12" style="float:none;margin:auto">Add Cost</h3>
                </div>

                <div class="panel-body">

                    <div class="form-body">
                        <div class="row">

                            <div style="padding-left:20px;padding-right:20px;" class="form-group">
                                {{ Form::text('q', '', ['id' =>  'p', 'placeholder' =>  'Enter info'])}}
                                {{ Form::submit('Search', array('class' => 'button expand')) }}
                                <a style="float:right" id="clean_supplier" class="btn btn-info">Clean</a>
                                {{ Form::hidden('supplier_id', '' , array('id' => 'supplier_id', 'class' => 'form-control')) }}

                            </div>
                            
                            <div style="padding-left:20px;padding-right:20px;" class="form-group">
                                {{ Form::label('supplier_info', 'Supplier', array('id' => '', 'class' => 'col-md-20 control-label')) }}
                                <div class="col-md-20">
                                {{ Form::text('supplier_info', '' , array('id' => 'supplier_info', 'class' => 'form-control')) }}
                                </div>

                            </div>

                        </div>
                        <div class="row">

                            <div style="padding-left:20px;padding-right:20px;" class="form-group">

                                {{ Form::label('concept', 'Concept', array('id' => '', 'class' => 'col-md-20 control-label')) }}
                                <div class="col-md-20">
                                {{ Form::text('concept', '' , array('id' => 'concept', 'class' => 'form-control')) }}
                                </div>

                                {{ Form::label('amount', 'Amount', array('id' => '', 'class' => 'col-md-20 control-label')) }}
                                <div class="col-md-20">
                                {{ Form::number('amount', '' , array('id' => 'amount', 'class' => 'form-control')) }}
                                </div>


                            </div>
                        </div>
                        <div class="row">
                            <div style="padding-left:20px;padding-right:20px;" class="form-group">
                                <div class="col-md-20">

                                    <div style="display:inline" class="dropdown">
                                        <button class="btn btn-info btn-lg" type="button" data-toggle="dropdown"><span id="type">Payment Type</span>
                                        <span class="caret"></span></button>
                                        <ul class="dropdown-menu">
                                            <li><a class="typeItem">Real</a></li>
                                            <li><a class="typeItem">Virtual</a></li>
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
    </div>
</div>
@endsection


@section('scripts')
    {{ HTML::script('assets/scripts/jquery.min.js') }}
    {{ HTML::script('assets/scripts/jquery-ui.min.js') }}
    {{ HTML::script('assets/scripts/datatables.js') }}
    {{ HTML::script('assets/scripts/validators/costValidator.js') }}
    {{ HTML::script('assets/scripts/cost/cost_add.js') }}
@endsection

