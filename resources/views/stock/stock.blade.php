@extends('layouts.app')

<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">

                {{ Form::hidden('id', $product_id, array('id' => 'product_id', 'class' => 'form-control')) }}


                <div style="height:70px" class="panel-heading">
                    <div style="display: inline-block; margin:0px; padding:0px; float:left">
                        <h3>Stock</h3>
                    </div>
                    <div style="display: inline-block; margin:0px; padding:0px; float:right">
                        <a href="{{ url('/products/' . $product_id . '/stock/add') }}" style="float:left" class=" col btn btn-primary">Add</a>
                    </div>
                </div>

                <div class="panel-body">
                   <table style="width:100%" class="table table-bordered" id="stock-table">
                        <thead>
                            <tr>
                                <th>Entrance</th>
                                <th>Current</th>
                                <th>Initial</th>
                                <th>Settlement</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('scripts')
    {{ HTML::script('assets/scripts/jquery.min.js') }}
    {{ HTML::script('assets/scripts/datatables.js') }}
    {{ HTML::script('assets/scripts/stock/stock.js') }}
@endsection

