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
                margin:auto;
            }
        </style>
    </head>
    <body>

        <div class="flex-center">
            <img style="position: fixed;top: -50px;opacity: 0.1;" src="/img/Logo.v4.png"></img>
        </div>

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
                                <button id="prev" class="btn" width="30px" height="100%"> < </button>
                                @foreach ($orders as $order)
                                    @foreach ($order["items"] as $item)
                                    <img width="255px" class="hidden" src="/assets/img/{{$item['product']->image}}">
                                    @endforeach
                                @endforeach 
                                <button id="next" class="btn" width="30px" height="100%"> > </button>
                            </div>

                        @endauth
                @endif
            </div>

        </div>
    </body>
</html>

