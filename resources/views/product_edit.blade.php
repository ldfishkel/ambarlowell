@extends('layouts.app')

<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div>
                        <h3 class="col-lg-12" style="float:none;margin:auto">Edit Product</h3>
                    </div>
                </div>

                <div class="panel-body">
                    {{ Form::open(array('id' => 'form_edit_product', 'class' => 'form-horizontal')) }}

                    <div class="form-body">
                        <div class="row">

                            <div class="col-md-6">
                                
                                <div class="form-group">
                                    {{ Form::label('model', 'Model', array('class' => 'col-md-3 control-label')) }}
                                    <div class="col-md-4">
                                        {{ Form::hidden('id', $product->id, array('id' => 'id', 'class' => 'form-control')) }}
                                        {{ Form::text('model', $product->model, array('class' => 'form-control')) }}
                                        <span class="help-block hidden message"></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    {{ Form::label('description', 'Description', array('class' => 'col-md-3 control-label')) }}
                                    <div class="col-md-9">
                                        {{ Form::text('description', $product->description, array('class' => 'form-control')) }}
                                        <span class="help-block hidden message"></span>
                                    </div>
                                </div>


                                 <div class="form-group">
                                    {{ Form::label('fabricated', 'Fabricated', array('class' => 'col-md-3 control-label')) }}
                                    <div class="col-md-1">
                                        {{ Form::checkbox('fabricated', $product->fabricated, false, ['class' => 'form-control']) }}
                                        <span class="help-block hidden message"></span>
                                    </div>
                                    
                                </div>

                                <div class="form-group">
                                   
                                    <div class="form-group">
                                        {{ Form::label('cost', 'Cost', array('id' => '', 'class' => 'col-md-3 control-label')) }}
                                        <div class="col-md-3">
                                        {{ Form::number('cost', $product->cost , array('id' => 'cost', 'class' => 'form-control')) }}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        {{ Form::label('wholesale', 'Wholesale', array('id' => '', 'class' => 'col-md-3 control-label')) }}
                                        <div class="col-md-3">
                                        {{ Form::number('wholesale', $product->wholesale , array('id' => 'wholesale', 'class' => 'form-control')) }}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        {{ Form::label('retail', 'Retail', array('id' => '', 'class' => 'col-md-3 control-label')) }}
                                        <div class="col-md-3">
                                        {{ Form::number('retail', $product->retail , array('id' => 'retail', 'class' => 'form-control')) }}
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
                    
                    <hr />

                    <div class="panel-heading">
                        <div>
                            <h3 class="col-lg-12" style="float:none;margin:auto">Upload Images</h3>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div style="float:none;margin:auto" class="row">
                            <form id="data" method="post" enctype="multipart/form-data">
                                <input style="float:left" type="file" id="photos" class="btn btn-success" name="photos[]" multiple />
                                <input type="submit" style="float:right;" id="upload" class="btn btn-success">Upload</a>
                            </form>
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
    {{ HTML::script('assets/scripts/validators/productValidator.js') }}
    {{ HTML::script('assets/scripts/product/product_edit.js') }}
@endsection

