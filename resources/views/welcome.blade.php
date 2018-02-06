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
        <script type="text/javascript" src="/assets/scripts/validators/dashboardValidator.js"></script>
        <script type="text/javascript" src="/assets/scripts/dashboard.js"></script>

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

        <div class="flex-center">
            <img style="position: fixed;top: -50px;opacity: 0.1;" src="/img/Logo.v4.png"></img>
        </div>

        <div class="content">
            @if (Route::has('login'))
            <div class="row" style="height: 85px;">

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
                                @if ($isAdmin)
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

                                            <div class="panel-body" style="font-size: 18px;">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <span class="label {{ ($realBalance > 0) ? 'label-success' : 'label-danger' }}"> 
                                                            Real Balance : $ {{ $realBalance }} 
                                                        </span>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <span class="label {{ ($lastMonthProfits < $monthProfits) ? 'label-success' : 'label-danger' }}"> 
                                                            Month Profits : $ {{ $monthProfits }}
                                                        </span>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <span class="label {{ ($lastMonthProfits > 0) ? 'label-success' : 'label-danger' }}"> 
                                                            Last Month Profits : $ {{ $lastMonthProfits }}
                                                        </span>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <span class="label label-info"> 
                                                            Clients Debts : $ {{ $clientsDebts }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <span class="label {{ ($virtualBalance > 0) ? 'label-success' : 'label-danger' }}"> 
                                                            Virtual Balance : $ {{ $virtualBalance }}
                                                        </span>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <span class="label label-info"> 
                                                            Month Costs : $ {{ $monthCosts }}
                                                        </span>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <span class="label label-info"> 
                                                            Last Month Costs : $ {{ $lastMonthCosts }}
                                                        </span>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <span class="label label-info"> 
                                                            Suppliers Debts : $ {{ $suppliersDebts }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="creditors" class="tab-pane fade in">

                                            <div class="panel-body">
                                                <table style="width:100%" class="table table-bordered" id="creditors-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Id</th>
                                                            <th>Creditor</th>
                                                            <th>Amount</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>

                                        <div id="debtors" class="tab-pane fade in">

                                            <div class="panel-body">
                                                <table style="width:100%" class="table table-bordered" id="debtors-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Id</th>
                                                            <th>Debtor</th>
                                                            <th>Amount</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>

                                        <div id="investments" class="tab-pane fade in">

                                            <div class="panel-body" style="font-size: 18px;">
                                
                                                <div class="row">
                                                    @foreach($investments as $investment)
                                                    <div class="col-md-3">
                                                         <span class="label label-info">{{ $investment->investor }} : $ {{  $investment->amount }}</span>
                                                    </div>
                                                    @endforeach
                                                    <div class="col-md-3">
                                                        <button class="btn btn-primary" data-toggle="modal" data-target="#investmentModal">Add</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                            @endif

                            <div class="row">

                                <div class="panel panel-default">
                                    <div style="height:70px" class="panel-heading">
                                        <div style="display: inline-block; margin:0px; padding:0px; float:left">
                                            <h3>Stock</h3>
                                        </div>
                                    </div>

                                    <ul class="nav nav-tabs">
                                        <li class="active"><a data-toggle="tab" href="#stock_status">Status</a></li>
                                        <li><a data-toggle="tab" href="#requested">Requested</a></li>
                                        <li><a data-toggle="tab" href="#settlement">Settlement</a></li>
                                        <li><a data-toggle="tab" href="#bestseller">Best Seller</a></li>
                                    </ul>

                                    <div class="tab-content">
                                        <div id="stock_status" class="tab-pane fade in active">

                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        {{ $stock["different"] }} Different
                                                    </div>
                                                    <div class="col-md-3">
                                                        {{ $stock["settlement"] }} Settlement
                                                    </div>
                                                    <div class="col-md-3">
                                                        {{ $stock["requested"] }} Requested
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        {{ $stock["units"] }} Units
                                                    </div>
                                                    <div class="col-md-3">
                                                        {{ $stock["withoutStock"] }} Without Stock
                                                    </div>
                                                    <div class="col-md-3">
                                                        {{ $stock["entranceThisMonth"] }} Entrance this month
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="requested" class="tab-pane fade in">

                                            <div class="panel-body">
                                                <table style="width:100%" class="table table-bordered" id="requested-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Id</th>
                                                            <th>Model</th>
                                                            <th>Amount</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>

                                        <div id="settlement" class="tab-pane fade in">

                                            <div class="panel-body">
                                                <table style="width:100%" class="table table-bordered" id="settlement-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Model</th>
                                                            <th>Amount</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>

                                        <div id="bestseller" class="tab-pane fade in">

                                            <div class="panel-body">
                                                <table style="width:100%" class="table table-bordered" id="bestseller-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Model</th>
                                                            <th>Sold</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        @endauth

                @endif
            </div>

        <!--__________________________________________________________________________________________________________________-->
        <!--______________________________________STATUS MODAL________________________________________________________________-->
        <!--__________________________________________________________________________________________________________________-->

            <div class="modal fade" id="investmentModal" role="dialog">
                <div class="modal-dialog">
                
                  <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Add Investment</h4>
                        </div>
                        <div class="modal-body">
                            
                        
                            <div class="row">
                                <div class="col-md-2">
                                    
                                    <div style="display:inline" class="dropdown">
                                        <button class="btn btn-info" type="button" data-toggle="dropdown"><span id="investor">Investor</span>
                                        <span class="caret"></span></button>
                                        <ul class="dropdown-menu">
                                            <li><a class="investorItem">Leo</a></li>
                                            <li><a class="investorItem">Zama</a></li>
                                            <li><a class="investorItem">Pela</a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    {{ Form::number('amount', '' , array('id' => 'amount', "placeholder" => "amount", 'class' => 'form-control')) }}
                                </div>

                                <div style="float:right;" class="col-md-2">
                                    <button id="submitInvestor" class="btn btn-success">Submit</button>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

