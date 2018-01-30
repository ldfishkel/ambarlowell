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
                    <h3 class="col-lg-12" style="float:none;margin:auto">Cost View</h3>
                </div>

                <div class="panel-body">

                    <div class="form-body">


                        <div class="form-group">
                            {{ Form::label('concept', 'Concept', array('id' => '', 'class' => 'col-md-20 control-label')) }}
                            <div class="col-md-20">
                            {{ Form::text('concept', $cost->concept , array('id' => 'concept', 'class' => 'form-control')) }}
                            </div>
                        </div>

                        <div class="form-group">
                            <span style="float:left; font-size:16px;margin-bottom:20px" class="label label-info">Payment Type:  {{ $cost->payment_type }}</span>
                            <span style="float:right; font-size:16px" class="label label-info">Amount:  ${{ $cost->amount }}</span>
                        
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="col-lg-12" style="float:none;margin:auto">Supplier Info</h3>
                </div>

                <div class="panel-body">

                    <div class="form-body">
                        
                        <div class="form-group">
                            {{ Form::label('supplier', 'Supplier', array('id' => '', 'class' => 'col-md-20 control-label')) }}
                            <div class="col-md-20">
                            {{ Form::text('supplier', $supplier->info , array('id' => 'name', 'class' => 'form-control')) }}
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
@endsection

