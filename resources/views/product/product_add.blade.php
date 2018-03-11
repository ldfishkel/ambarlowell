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
                    <h3 class="col-lg-12" style="float:none;margin:auto">Add Product</h3>
                </div>

                <div class="panel-body">
                    {{ Form::open(array('id' => 'form_add_product', 'class' => 'form-horizontal')) }}

                    <div class="form-body">
                        <div class="row">

                            <div class="col-md-6">
                                
                                <div class="row">
                                    <div style="float:left">

                                        {{ Form::label('type', 'Type', array('class' => 'col-md-3 control-label')) }}

                                        <div class="col-md-4">
                                        
                                            <div style="display:inline" class="dropdown">
                                                <button class="btn btn-info btn-lg" type="button" data-toggle="dropdown"><span id="type">Type</span>
                                                <span class="caret"></span></button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="typeItem">PF</a></li>
                                                    <li><a class="typeItem">PI</a></li>
                                                    <li><a class="typeItem">AC</a></li>
                                                    <li><a class="typeItem">AB</a></li>
                                                </ul>
                                            </div>

                                        </div>
                                    </div>

                                    <div style="float:right">
                                        {{ Form::label('fabricated', 'Fabricated', array('class' => 'col-md-3 control-label')) }}
                                        <div class="col-md-1">
                                            {{ Form::checkbox('fabricated', '0', false, array('class' => 'form-control')) }}
                                            <span class="help-block hidden message"></span>
                                        </div>
                                    </div>
                                
                                </div>

                                <div class="form-group" style="margin-top: 10px">
                                    {{ Form::label('description', 'Description', array('class' => 'col-md-3 control-label')) }}
                                    <div class="col-md-9">
                                        {{ Form::text('description', '', array('class' => 'form-control')) }}
                                        <span class="help-block hidden message"></span>
                                    </div>
                                </div>


                                    

                                <div class="form-group">
                                    {{ Form::label('cost', 'Cost', array('id' => '', 'class' => 'col-md-3 control-label')) }}
                                    <div class="col-md-3">
                                    {{ Form::number('cost', '' , array('id' => 'cost', 'class' => 'form-control')) }}
                                    </div>
                                </div>

                                <div class="form-group">
                                    {{ Form::label('wholesale', 'Wholesale', array('id' => '', 'class' => 'col-md-3 control-label')) }}
                                    <div class="col-md-3">
                                    {{ Form::number('wholesale', '' , array('id' => 'wholesale', 'class' => 'form-control')) }}
                                    </div>
                                </div>

                                <div class="form-group">
                                    {{ Form::label('retail', 'Retail', array('id' => '', 'class' => 'col-md-3 control-label')) }}
                                    <div class="col-md-3">
                                    {{ Form::number('retail', '' , array('id' => 'retail', 'class' => 'form-control')) }}
                                    </div>
                                </div>

                               <!-- <div class="form-group">
                                    {{ Form::label('tags', 'Tags', array('id' => '', 'class' => 'col-md-3 control-label')) }}
                                    <div class="col-md-3">
                                        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Tags</button>
                                    </div>
                                </div>-->

                            </div>

                        </div>
                    </div>
                            
                    <div class="form-actions">
                        <div class="row" style="margin:auto; width: fit-content;">
                            <a id="submit" class="btn btn-xl btn-success">Save<span style="margin-left: 5px" class="glyphicon glyphicon-floppy-disk"></span></a>
                        </div>
                    </div>

                    {{ Form::close() }}
                   
                </div>
            </div>
        </div>
    </div>
</div>

<!--__________________________________________________________________________________________________________________-->
<!--______________________________________MODAL Tags   _______________________________________________________________-->
<!--__________________________________________________________________________________________________________________-->

    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
        
          <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Tags</h4>
                </div>
                <div class="modal-body">
                    
                    <div class="form-group">
                        {{ Form::text('q', '', ['id' =>  'q', 'placeholder' =>  'Enter tag'])}}
                        {{ Form::submit('Search', array('class' => 'button expand')) }}
                        <a style="float:right" id="create_tag" class="btn btn-info">Create Tag</a>

                    </div>

                    <div class="form-group">
                                
                       <table style="width:100%" class="table table-bordered" id="tag-table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Tag</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="tagsBody"></tbody>
                        </table>
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
    {{ HTML::script('assets/scripts/validators/productValidator.js') }}
    {{ HTML::script('assets/scripts/product/product_add.js') }}
@endsection

