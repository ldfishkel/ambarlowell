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

                                    <div class="form-group">
                                        {{ Form::label('tags', 'Tags', array('id' => '', 'class' => 'col-md-3 control-label')) }}
                                        <div class="col-md-3">
                                            <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Tags</button>
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
                            <tbody id="tagsBody">
                                @foreach($tags as $tag)
                                <tr id="row{{ $tag->id }}">
                                    <td>{{ $tag->id }}</td>
                                    <td>{{ $tag->name }}</td>
                                    <td><a class='btn btn-danger btn-xs remove'>Remove</a></td>
                                </tr>
                                @endforeach
                            </tbody>
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
    {{ HTML::script('assets/scripts/product/product_edit.js') }}
@endsection

