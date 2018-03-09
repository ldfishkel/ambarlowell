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
                                                <a href="/orders/view/{{$order['order']->id}}" style="width: -webkit-fill-available;" class="btn btn-info btn-xl"> Order {{ $order["order"]->id }} </a>
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
                                        
                                        <div style="width:100%" class="row">
                                            <img style="width:100%"  src="/assets/img/{{ $item['product']->image }}">
                                        </div>
                                        
                                        <div class="row" style="width:100%">
                                            <div class="col" style="width:49%; float:left;">
                                                <button id="delay" style="width: -webkit-fill-available;" class="btn btn-danger btn-xl"> Delay </button>
                                            </div>
                                            <div class="col" style="width: 49%; float:right">
                                                <button id="finished" style="width: -webkit-fill-available;" class="btn btn-primary btn-xl"> Finished </button>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                @endforeach 
                            </div>
                            <div class="row">
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
    </body>
</html>

