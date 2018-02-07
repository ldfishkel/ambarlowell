@extends('layouts.app')

<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div>
                        <h3 class="col-lg-12" style="float:none;margin:auto">View Product</h3>
                    </div>
                </div>

                <div class="panel-body">
                    <div class="form-body">
                        <div class="row">

                            <div class="col-md-12">
                                
                                <div style="margin-top:10px"  class="row">
                                    {{ Form::label('model', 'Model', array('class' => 'col-md-3 control-label')) }}
                                    <div class="col-md-4">
                                        
                                        <p>{{ $product->model }}</p>
                                        <span class="help-block hidden message"></span>
                                    </div>
                                </div>

                                <div style="margin-top:10px"  class="row">
                                    {{ Form::label('description', 'Description', array('class' => 'col-md-3 control-label')) }}
                                    <div class="col-md-9">
                                        <p>{{  $product->description }}</p>
                                        <span class="help-block hidden message"></span>
                                    </div>
                                </div>


                                 <div style="margin-top:10px"  class="row">
                                    {{ Form::label('fabricated', 'Fabricated', array('class' => 'col-md-3 control-label')) }}
                                    <div class="col-md-1">
                                        <span id="fabricated">{{  ($product->fabricated == 1) ? "Yes" : "No" }}</span>
                                        <span class="help-block hidden message"></span>
                                    </div>
                                    
                                </div>

                                <div style="margin-top:10px"  class="row">
                                    {{ Form::label('cost', 'Cost', array('id' => '', 'class' => 'col-md-3 control-label')) }}
                                    <div class="col-md-3">
                                    {{ Form::number('cost', $product->cost , array('disabled' => 'true', 'id' => 'cost', 'class' => 'form-control')) }}
                                    </div>
                                </div>

                                <div style="margin-top:10px"  class="row">
                                    {{ Form::label('wholesale', 'Wholesale', array('id' => '', 'class' => 'col-md-3 control-label')) }}
                                    <div class="col-md-3">
                                    {{ Form::number('wholesale', $product->wholesale , array('disabled' => 'true', 'id' => 'wholesale', 'class' => 'form-control')) }}
                                    </div>
                                </div>

                                <div style="margin-top:10px"  class="row">
                                    {{ Form::label('retail', 'Retail', array('id' => '', 'class' => 'col-md-3 control-label')) }}
                                    <div class="col-md-3">
                                    {{ Form::number('retail', $product->retail , array('disabled' => 'true', 'id' => 'retail', 'class' => 'form-control')) }}
                                    </div>
                                </div>

                                <div class="row">
                                
                                   <table style="width:100%" class="table table-bordered" id="tag-table">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Tag</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tagsBody">
                                            @foreach($tags as $tag)
                                            <tr>
                                                <td>{{ $tag->id }}</td>
                                                <td>{{ $tag->name }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                        </div>
                        
                    </div>
                            
                    <div style="margin-top:10px; margin-bottom: 30px" class="form-actions">
                        <div class="row">
                            <div class="row">
                                <div class="col-lg-1" style="float:none;margin:auto">
                                    <a href="/products/edit/{{ $product->id }}" class="btn btn-success">Edit</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if (is_dir(public_path().'/assets/img/'.$product->model))
                    
                    <div style="width:50%; float:none; margin:auto">
                        <div id="myCarousel" class="carousel slide" data-ride="carousel">

                            <!-- Wrapper for slides -->
                            <div class="carousel-inner">

                                @foreach (File::allFiles(public_path().'/assets/img/'.$product->model) as $file)

                                    <div class="item">
                                        <img src="/assets/img/{{ $product->model.'/'.$file->getRelativePathName() }}" style="width:100%;">
                                    </div>
   
                                @endforeach
                               
                            </div>

                            <!-- Left and right controls -->
                            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>

                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('scripts')
    {{ HTML::script('assets/scripts/jquery.min.js') }}
    {{ HTML::script('assets/scripts/product/product_view.js') }}
@endsection

