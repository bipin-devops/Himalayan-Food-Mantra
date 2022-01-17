@extends('layout')
@section('title') Dashboard @endsection



@section('content')
    <div class="row panel panel-body border-top-danger">
        <div class="panel-heading">
            <i class="icon-home2"> DASHBOARD</i>
            <div class="heading-elements">
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3">
                <!-- Members online -->
                <div class="panel bg-teal-400">
                    <div class="panel-body">

                        <h3 class="no-margin">{{ $productCount }}</h3>
                        Total Products
                        <div class="text-muted text-size-small">{{ $activeProductCount }} active product</div>


                    </div>


                </div>
                <!-- /members online -->

            </div>

            <div class="col-lg-3">

                <!-- Current server load -->
                <div class="panel bg-pink-400">
                    <div class="panel-body">
                        <h3 class="no-margin">{{ $categoryCount }}</h3>
                        Total Category
                        <div class="text-muted text-size-small">{{ $activeCategoryCount }} active category</div>
                    </div>
                </div>
                <!-- /current server load -->

            </div>

            <div class="col-lg-3">

                <!-- Today's revenue -->
                <div class="panel bg-blue-400">
                    <div class="panel-body">
                        <h3 class="no-margin">{{ $orderCount }}</h3>
                        Total Orders
                        <div class="text-muted text-size-small"><span
                                    class="pending-order-count pending-order-count">{{ $orderStatusCount['pending'] }}</span>
                            pending
                        </div>

                    </div>

                </div>
                <!-- /today's revenue -->

            </div>

            <div class="col-lg-3">

                <!-- Today's revenue -->
                <div class="panel bg-grey-400">
                    <div class="panel-body">
                        <h3 class="no-margin">{{ $newsCount }}</h3>
                        Total News
                        <div class="text-muted text-size-small">{{ $todayNewsCount }} today's news</div>
                    </div>

                </div>
                <!-- /today's revenue -->

            </div>
            <div class="col-lg-3">

                <!-- Today's revenue -->
                <div class="panel bg-green-400">
                    <div class="panel-body">
                        <h3 class="no-margin">$ {{ $totalEarning }}</h3>
                        Total Earning
                    </div>


                </div>
                <!-- /today's revenue -->

            </div>
            <div class="col-lg-3">

                <!-- Today's revenue -->
                <div class="panel bg-green-400">
                    <div class="panel-body">
                        <h3 class="no-margin">$ {{ $yesterdayEarning }}</h3>
                        Yesterday's Earning
                    </div>


                </div>
                <!-- /today's revenue -->

            </div>
            <div class="col-lg-3">

                <!-- Today's revenue -->
                <div class="panel bg-brown-400">
                    <div class="panel-body">
                        <h3 class="no-margin">$ {{ $todayEarning }}</h3>
                        Today Earning
                    </div>

                </div>
                <!-- /today's revenue -->

            </div>
        </div>
    </div>
    <div class="row panel panel-body border-top-danger">
        <div class="panel-heading">
            <i class="icon-presentation">Data Analytics</i>
            <div class="heading-elements"></div>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-6">
                <p class="lead text-center">Weekly Earning Chart (Picked Up Orders)</p>

                <br>
                <div id="weekly-earning-chart"></div>
                <br>
                <p class="lead text-center">Earning This Week: <span id="earning-this-week"></span></p>
            </div>
            <div class="col-md-12 col-lg-6">
                <p class="lead text-center">Payment Ratio Till Now</p>
                <br>
                <div id="paid-order"></div>
                <br>
                @if($orderPieChartData['pendingOrders'])
                <p class="lead text-center">{{ $orderPieChartData['pendingOrders'] }} Orders Left To Be Picked Up </p>
                @else
                <p class="text-center">No pending orders remaining. Currently the chart shows ordered(paid) and cancelled(unpaid) ratio. </p>
                @endif
            </div>
        </div>
    </div>

    <div class="row panel panel-body border-top-danger">
        <div class="panel-heading">
            <i class="icon-presentation">User Data Analytics</i>
            <div class="heading-elements"></div>
        </div>
        <div class="row">

            <div class="col-md-12 col-lg-6">
                <p class="lead text-center">Weekly Registration Chart</p>

                <br>
                <div id="weekly-registration-chart"></div>
                <br>
                <p class="lead text-center">User Registration This Week: <span id="registration-this-week"></span></p>
            </div>
            <div class="col-md-12 col-lg-6">
                    <p class="lead text-center">Top Ordering Users</p>
                <br>


                        <table class="table">
                            <thead>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Registered On</th>
                                <th>Total Orders</th>
                                <th>Total Spent</th>
                            </thead>
                            <tbody>
                                @foreach ($topUsers as $user)
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->created_at->diffForHumans()}}</td>
                                    <td>{{ $user->totalOrders }}</td>
                                    <td>$ {{ $user->totalOrderPrice }}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>Total :</td>
                                    <td>$ {{ $topUsers->sum('totalOrderPrice') }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <br>


            </div>
        </div>
    </div>




    <div class="row panel panel-body border-top-danger">
        <div class="panel-heading">
            <i class="icon-presentation"> Total Order</i>
            <div class="heading-elements">
            </div>
        </div>
        <div class="row">
            @foreach ($orderStatusCount as $status => $count)
                <div class="col-lg-3">
                    <div class="panel {{ $allColour[$status] }}">
                        <div class="panel-body">
                            <div class="heading-elements">
                                <span class="heading-text badge bg-teal-800 {{$status}}-order-count">{{ $count }}</span>
                            </div>

                            <h3 class="no-margin">{{ $allStatus[$status] }}</h3>

                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>

    <div class="row panel panel-body border-top-danger">
        <div class="panel-heading">
            <i class="icon-popout"> Popular And Latest</i>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h6 class="panel-title">Top Selling Categories<a class="heading-elements-toggle"><i
                                        class="icon-more"></i></a></h6>
                    </div>

                    <div class="panel-body">
                        <div class="content-group-xs" id="bullets"></div>

                        <ul class="media-list">
                            @foreach ($categories as $category)
                                <li class="media">
                                    <div class="media-left">
                                        <a href="#"
                                           class="btn border-pink text-pink btn-flat btn-rounded btn-icon btn-xs legitRipple"><i
                                                    class="icon-fire"></i></a>
                                    </div>

                                    <div class="media-body">
                                        {{$category->name}}
                                        <div class="media-annotation">{{ $category->total }} ordered</div>
                                    </div>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h6 class="panel-title">Top Selling Products<a class="heading-elements-toggle"><i
                                        class="icon-more"></i></a></h6>
                    </div>

                    <div class="panel-body">
                        <div class="content-group-xs" id="bullets"></div>

                        <ul class="media-list">
                            @foreach ($products as $product)
                                <li class="media">
                                    <div class="media-left">
                                        <a href="#"
                                           class="btn border-pink text-pink btn-flat btn-rounded btn-icon btn-xs legitRipple"><i
                                                    class="icon-fire"></i></a>
                                    </div>

                                    <div class="media-body">
                                        {{$product->title}}
                                        <div class="media-annotation">{{ $product->total }} ordered</div>
                                    </div>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="row panel panel-body border-top-danger">
        <div class="panel-heading">
            <i class="icon-list-ordered"> Latest Order</i>
        </div>
        @php
            $indexTable = [
                "Ref No" => 'reference_no',
                "Customer" => 'name',
                "Email" => 'email',
                "Total" => 'total',
                "Status" => 'status',
                "Payment" => 'payment_status'
            ];
        @endphp
         <div class="row">
            <div class="col-md-12">
                @include('Admin.components.table', [
                    'indexTable' => $indexTable,
                    'permission' =>'order.order.',
                    'route' => 'order.',

                'data' => $latestOrder,
                    'input' => \Input::all(),
                    'action' => [ 'show']
                ])
            </div>
        </div>
    </div>


    </div>
@endsection


@section('scripts')
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script>
// Initialize chart
google.load("visualization", "1", {packages:["corechart"]});
google.setOnLoadCallback(drawPie);


// Chart settings
function drawPie() {

    // Data
    var data = google.visualization.arrayToDataTable([
        ['Orders', 'Payment Status'],
        ['Unpaid',     {{ $orderPieChartData['unpaid'] }} ],
        ['Paid',      {{ $orderPieChartData['paid'] }} ]
    ]);

    // Options
    var options_pie = {
        fontName: 'Roboto',
        height: "100%",
        width: "100%",
        chartArea: {
            left: 20,
            width: '90%',
            height: '90%'
        }
    };


    // Instantiate and draw our chart, passing in some options.
    var pie = new google.visualization.PieChart($('#paid-order')[0]);
    pie.draw(data, options_pie);
}

    google.charts.load("current", {packages:['corechart', 'line']});
    google.setOnLoadCallback(drawCharts);

    function drawOrderChart(chartData) {
        var colors = ["#b87333", "silver", "gold", "#e5e4e2", "red", "green", "purple", "blue"];
        var data = [
            ["Date", "Total", { role: "style" } ],
        ];
        var total = 0;
        for (var i = 0; i < Object.keys(chartData).length; i++) {
            var date = Object.keys(chartData)[i];
            total += chartData[date];
            data.push([date, chartData[date], colors[i] ]);
        }
        document.getElementById('earning-this-week').textContent = "$ "+ total;
        var view = new google.visualization.DataView(google.visualization.arrayToDataTable(data));
        view.setColumns([0, 1,
                        { calc: "stringify",
                            sourceColumn: 1,
                            type: "string",
                            role: "annotation" },
                        2]);

        var options = {
            title: "Weekly Earnings",
            width: "100%",
            height: "120%",
            bar: {groupWidth: "95%"},
            legend: { position: "bottom" },
        };
        console.log(data);
        var chart = new google.visualization.ColumnChart(document.getElementById("weekly-earning-chart"));
        chart.draw(view, options);
    }

    function drawRegistrationChart(chartData) {
        var data = [
            ['Date', 'Registration']
        ];
        var total = 0;
        for (var i = 0; i < Object.keys(chartData).length; i++) {
            var date = Object.keys(chartData)[i];
            total += chartData[date];

            data.push([date, chartData[date]]);
        }
        document.getElementById('registration-this-week').textContent = total;

        data = google.visualization.arrayToDataTable(data);

        var options = {
            title: 'User Registration Weekly',
            curveType: 'function',
            legend: { position: 'bottom' }
        };
        var chart = new google.visualization.LineChart(document.getElementById('weekly-registration-chart'));

        chart.draw(data, options);
    }

    function drawCharts(){
            fetch("{{ route('chart.data') }}").then(res => res.json()).then(res => {
                drawOrderChart(res.earning);
                drawRegistrationChart(res.registration);
            }).catch(err => console.log(err));

    }
    drawCharts();
    window.setInterval(function() {
        drawCharts();
    }, 5000);

</script>
@endsection
