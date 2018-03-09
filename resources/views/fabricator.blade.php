<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        @auth
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @endauth

        <title>Laravel</title>

        <script type="text/javascript" src="/assets/scripts/jquery.min.js"></script>
        <script type="text/javascript" src="/assets/scripts/jquery-ui.min.js"></script>
        <script type="text/javascript" src="/assets/scripts/jquery-mobile.min.js"></script>
        <script type="text/javascript" src="/assets/scripts/bootstrap.min.js"></script>
        <script type="text/javascript" src="/assets/scripts/datatables.js"></script>
        <script type="text/javascript" src="/assets/scripts/fabricator.js"></script>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <!-- Latest compiled JavaScript -->
        <!-- Fonts -->
        <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/jquery-ui.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/jquery-ui.structure.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/jquery-ui.theme.min.css') }}" rel="stylesheet">

        <!-- Styles -->
        <style>

            html, body {
                background-color: #fff;
                font-family: 'Raleway', sans-serif;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .container {
                margin-top: 50px;
                width: 95%;
                left: 28px;
                position: relative;
            }

            .itemContainer {
                display: inline-block;
            }
        </style>
    </head>
    <body>

        <div class="content flex-center">
            @if (Route::has('login'))
            <div class="row" style="height: 85px;">

                <div class="top-right links">
                    @auth
                        <a href="{{ url('/products') }}">Products</a>
                        <a href="{{ url('/costs') }}">Costs</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                    @endauth
                </div>
            </div>
            @endif


            <div class="container">

                @if (Route::has('login'))
                        @auth
                    
                            <div class="items row">
                                @foreach ($orders as $order)
                                    @foreach ($order["items"] as $item)
                                    <div class="itemContainer hidden" style="width:100%">
                                        <div class="row" style="width:100%">
                                            <div class="col" style="width:49%; float:left;">
                                                <button id="orders_view_{{$order['order']->id}}" style="width: -webkit-fill-available;" class="btn btn-info btn-xl view"> Order {{ $order["order"]->id }} </button>
                                            </div>
                                            <div class="col" style="width: 49%; float:right">
                                                <button style="width: -webkit-fill-available;" class="btn btn-primary btn-xl"> {{ $order["order"]->date }} </button>
                                            </div>
                                        </div>

                                        <div style="width:100%; text-align: center" class="row">
                                            <p style="margin:0px;width:100%; background-color: #f93" >{{ ($item['comment'] && $item['comment'] != "") ? $item['comment'] : "No comment"  }}</p>
                                        </div>

                                        <div style="width:100%; text-align: center" class="row">
                                            <p style="margin:0px; width:100%; background-color: #E74" >{{ $item['amount'] }} Units  </p>
                                        </div>
                                        
                                        <div style="width:100%; min-height: 450px;"  class="row">
                                            <img class="product" id="products_view_{{ $item['product']->id }}" style="width:100%"  src="/assets/img/{{ $item['product']->image }}">
                                        </div>
                                        
                                        <div class="row" style="width:100%; margin-top: 5px">
                                            <div class="col" style="width:49%; float:left;">
                                                @if ($item['delayed'])
                                                    <button id="continue_{{ $item['id'] }}" style="width: -webkit-fill-available;" class="btn btn-success btn-xl continue"> Continue </button>
                                                @else
                                                    <button id="delayed_{{ $item['id'] }}" style="width: -webkit-fill-available;" class="btn btn-danger btn-xl delayed" data-toggle="modal" data-target="#delayedModal"> Delayed </button>
                                                @endif
                                            </div>
                                            <div class="col" style="width: 49%; float:right">
                                                <button id="finished_{{ $item['id'] }}" style="width: -webkit-fill-available;" data-toggle="modal" data-target="#finishedModal" class="btn btn-primary btn-xl finished"> Finished </button>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                @endforeach 
                            </div>
                            <div style="margin-top:5px" class="row">
                                <div style="width:100%" class="row">
                                    <div class="col" style="width:49%; float:left;">
                                        <button id="prev" style="width: -webkit-fill-available;" class="btn btn-default btn-xl"> < prev </button>
                                    </div>
                                    <div class="col" style="width:49%; float:right;">
                                        <button id="next" style="width: -webkit-fill-available;" class="btn btn-default btn-xl"> next > </button>
                                    </div>
                                </div>
                            </div>

                        @endauth
                @endif
            </div>

        </div>

    <!--__________________________________________________________________________________________________________________-->
    <!--______________________________________FINISHED MODAL______________________________________________________________-->
    <!--__________________________________________________________________________________________________________________-->

        <div class="modal fade" id="finishedModal" role="dialog">
            <div class="modal-dialog">
            
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add Stock Automatically?</h4>
                    </div>
                    <div class="modal-body">
                        <input id="item_id" type="hidden" value="">
                        <div class="row" style="margin:auto">
                            <button style="width:49%" id="submitWithStock" class="btn btn-success">Yes</button>
                            <button style="width:49%" id="submitWithoutStock" class="btn btn-danger">No</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    <!--__________________________________________________________________________________________________________________-->
    <!--______________________________________DELAYED MODAL_______________________________________________________________-->
    <!--__________________________________________________________________________________________________________________-->

        <div class="modal fade" id="delayedModal" role="dialog">
            <div class="modal-dialog">
            
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Delayed Reason</h4>
                    </div>
                    <div class="modal-body">
                        
                        <div class="row" style="margin: auto; margin-bottom: 10px">
                            <input style="width:100%" id="delayed_reason" type="text" value="">
                        </div>
                        
                        <div class="row" style="margin:auto">
                            <button style="width:100%" id="submitDelayed" class="btn btn-danger">Delayed</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

