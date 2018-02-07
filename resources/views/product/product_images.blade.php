@extends('layouts.app')

<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
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

                    <div class="row">
                        {{ Form::hidden('id', $product->id, array('id' => 'id', 'class' => 'form-control')) }}
                        {{ Form::hidden('model', $product->model, array('id' => 'model', 'class' => 'form-control')) }}
                        
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
</div>
@endsection


@section('scripts')
    {{ HTML::script('assets/scripts/jquery.min.js') }}
    {{ HTML::script('assets/scripts/jquery-ui.min.js') }}
    {{ HTML::script('assets/scripts/datatables.js') }}
    {{ HTML::script('assets/scripts/validators/productValidator.js') }}
    {{ HTML::script('assets/scripts/product/product_edit.js') }}
    {{ HTML::script('assets/scripts/product/product_view.js') }}
@endsection

