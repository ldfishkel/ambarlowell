<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <script type="text/javascript" src="/assets/scripts/jquery.min.js"></script>
        <script type="text/javascript" src="/assets/scripts/jquery-ui.min.js"></script>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
/*
            .content {
                text-align: center;
            }
*/
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
        </style>
    </head>
    <body>

        <div class="content">
            @if (Route::has('login'))
            <div class="row" style="height: 65px;">

                <div class="top-right links">
                    @auth
                        <a href="{{ url('/orders') }}">Orders</a>
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
                            <div class="row">

                                <div class="panel panel-default">
                                    <div style="height:70px" class="panel-heading">
                                        <div style="display: inline-block; margin:0px; padding:0px; float:left">
                                            <h3>Balance</h3>
                                        </div>
                                    </div>

                                    <ul class="nav nav-tabs">
                                        <li class="active"><a data-toggle="tab" href="#status">Status</a></li>
                                        <li><a data-toggle="tab" href="#creditors">Creditors</a></li>
                                        <li><a data-toggle="tab" href="#debtors">Debtors</a></li>
                                        <li><a data-toggle="tab" href="#investments">Investments</a></li>
                                    </ul>

                                    <div class="tab-content">

                                        <div id="status" class="tab-pane fade in active">

                                            <div class="panel-body">
                                                bodt
                                            </div>
                                        </div>

                                        <div id="creditors" class="tab-pane fade in">

                                            <div class="panel-body">
                                                bodt
                                            </div>
                                        </div>

                                        <div id="debtors" class="tab-pane fade in">

                                            <div class="panel-body">
                                                bodt
                                            </div>
                                        </div>

                                        <div id="investments" class="tab-pane fade in">

                                            <div class="panel-body">
                                                bodt
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="panel panel-default">
                                    <div style="height:70px" class="panel-heading">
                                        <div style="display: inline-block; margin:0px; padding:0px; float:left">
                                            <h3>Stock</h3>
                                        </div>
                                    </div>

                                    <ul class="nav nav-tabs">
                                        <li class="active"><a data-toggle="tab" href="#requested">Requested</a></li>
                                        <li><a data-toggle="tab" href="#settlement">Settlement</a></li>
                                        <li><a data-toggle="tab" href="#bestseller">Best Seller</a></li>
                                    </ul>

                                    <div class="tab-content">

                                        <div id="requested" class="tab-pane fade in active">

                                            <div class="panel-body">
                                                bodt
                                            </div>
                                        </div>

                                        <div id="settlement" class="tab-pane fade in">

                                            <div class="panel-body">
                                                bodt
                                            </div>
                                        </div>

                                        <div id="bestseller" class="tab-pane fade in">

                                            <div class="panel-body">
                                                bodt
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        @else
                            <img src="/img/Logo.v4.png"></img>
                        @endauth

                @endif
            </div>
        </div>
    </body>
</html>

