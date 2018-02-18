@extends('layouts.app')

<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div style="height:70px" class="panel-heading">
                    <div style="display: inline-block; margin:0px; padding:0px; float:left">
                        <h3>Products</h3>
                    </div>
                    <div style="display: inline-block; margin:0px; padding:0px; float:right">
                        <a href="{{ url('/products/add') }}" style="float:left" class=" col btn btn-primary">Add</a>
                    </div>
                </div>

                 <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#pf">Fabricated (PF)</a></li>
                    <li><a data-toggle="tab" href="#pi">Imported (PI)</a></li>
                    <li><a data-toggle="tab" href="#ac">Steel (AC)</a></li>
                    <li><a data-toggle="tab" href="#ab">White Steel (AB)</a></li>
                </ul>

                <div class="tab-content">
                    <div id="pf" class="tab-pane fade in active">
                        <div class="panel-body">
                           <table style="width:100%" class="table table-bordered" id="product-table">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Model</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>

                    <div id="pi" class="tab-pane fade in">
                        <div class="panel-body">
                           <table style="width:100%" class="table table-bordered" id="product-table-pi">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Model</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>

                    <div id="ac" class="tab-pane fade in">
                        <div class="panel-body">
                           <table style="width:100%" class="table table-bordered" id="product-table-ac">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Model</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>

                    <div id="ab" class="tab-pane fade in">
                        <div class="panel-body">
                           <table style="width:100%" class="table table-bordered" id="product-table-ab">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Model</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
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
    {{ HTML::script('assets/scripts/datatables.js') }}
    {{ HTML::script('assets/scripts/product/product.js') }}
@endsection

