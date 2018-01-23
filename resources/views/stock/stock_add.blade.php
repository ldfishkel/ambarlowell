@extends('layouts.app')

<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="col-lg-12" style="float:none;margin:auto">Add Stock</h3>
                </div>

                <div class="panel-body">
                    {{ Form::open(array('id' => 'form_add_stock', 'class' => 'form-horizontal')) }}

                    {{ Form::hidden('id', $product_id, array('id' => 'product_id', 'class' => 'form-control')) }}

                    <div class="form-body">
                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">
                                   
                                    <div class="form-group">
                                        {{ Form::label('amount', 'Amount', array('id' => '', 'class' => 'col-md-3 control-label')) }}
                                        <div class="col-md-3">
                                        {{ Form::number('amount', '' , array('id' => 'amount', 'class' => 'form-control')) }}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        {{ Form::label('settlement', 'Settlement', array('id' => '', 'class' => 'col-md-3 control-label')) }}
                                        <div class="col-md-3">
                                        {{ Form::number('settlement', '' , array('id' => 'settlement', 'class' => 'form-control')) }}
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                            
                    <div class="form-actions">
                        <div class="row">
                            <div class="row">
                                <div class="col-lg-1" style="float:none;margin:auto">
                                    <a id="submit" class="btn btn-success">Submit</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{ Form::close() }}
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('scripts')
    {{ HTML::script('assets/scripts/jquery.min.js') }}
    {{ HTML::script('assets/scripts/validators/stockValidator.js') }}
    {{ HTML::script('assets/scripts/stock/stock_add.js') }}
@endsection

