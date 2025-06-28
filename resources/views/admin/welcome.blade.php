<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Hello, world!</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <style>
        .btn {
            display: block;
        }
    </style>
    <style>
        #chartdiv {
            width: 100%;
            height: 500px;
        }
    </style>

    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            {{-- sidebar Start --}}
            @include('extend.sidebar')
            {{-- sidebar End --}}

            <div class="col-md-9">
                <div class="container-fluid bg-light p-4">
                    {{-- header Start --}}
                    @include('extend.header')
                    {{-- header End --}}

                    <div class="row g-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Filter by Date</h5>
                                </div>
                                <div class="card-body">
                                    <form id="filterForm">
                                        <div class="row g-3 align-items-center">
                                            <div class="col-auto">
                                                <label class="form-label mb-0">Select Date Range:</label>
                                            </div>

                                            <div class="col-auto">
                                                <div class="btn-group" role="group" aria-label="Date range buttons">
                                                    <input type="radio" class="btn-check" name="dateRange" id="last7"
                                                        value="last_seven_days" autocomplete="off">
                                                    <label class="btn btn-outline-primary" for="last7">Last 7
                                                        days</label>

                                                    <input type="radio" class="btn-check" name="dateRange" id="last30"
                                                        value="last_thirty_days" autocomplete="off">
                                                    <label class="btn btn-outline-primary" for="last30">Last 30
                                                        days</label>

                                                    <input type="radio" class="btn-check" name="dateRange" id="last90"
                                                        value="last_ninety_days" autocomplete="off">
                                                    <label class="btn btn-outline-primary" for="last90">Last 90
                                                        days</label>

                                                    <input type="radio" class="btn-check" name="dateRange"
                                                        id="last_month" value="lastMonth" autocomplete="off">
                                                    <label class="btn btn-outline-primary" for="lastMonth">Last
                                                        Month</label>

                                                    <input type="radio" class="btn-check" name="dateRange" id="lastYear"
                                                        value="last_one_year" autocomplete="off">
                                                    <label class="btn btn-outline-primary" for="lastYear">Last
                                                        Year</label>

                                                    <input type="radio" class="btn-check" name="dateRange" id="custom"
                                                        value="custom_date" autocomplete="off">
                                                    <label class="btn btn-outline-primary" for="custom">Custom
                                                        Date</label>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Custom Date Fields -->
                                        <div id="customDateFields" class="row mt-3" style="display: none;">
                                            <div class="col-md-6">
                                                <label for="startDate" class="form-label">Start Date</label>
                                                <input type="date" id="startDate" name="startDate"
                                                    class="form-control" />
                                            </div>
                                            <div class="col-md-6">
                                                <label for="endDate" class="form-label">End Date</label>
                                                <input type="date" id="endDate" name="endDate" class="form-control" />
                                            </div>
                                        </div>

                                        <div class="row mt-4">
                                            <div class="col-md-6">
                                                <button type="submit" class="btn btn-primary form-control">Apply
                                                    Filter</button>
                                            </div>
                                            <div class="col-md-6">
                                                <button type="reset" class="btn btn-secondary  form-control"
                                                    id="resetBtn">Reset</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                <h5 class="card-header">Appointment</h5>
                                <div class="card-body">
                                    <h5 class="card-title"></h5>
                                    <p class="card-text">
                                    <h1 id="appoinment">0</h1>
                                    </p>
                                    <a href="{{ route('appointment.index') }}" class="btn btn-primary">View All</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                <h5 class="card-header">Employee (Total)</h5>
                                <div class="card-body">
                                    <h5 class="card-title"></h5>
                                    <p class="card-text">
                                    <h1 id="employee">0</h1>
                                    </p>
                                    <a href="{{ route('employee.index') }}" class="btn btn-primary">View All</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                <h5 class="card-header">Customer</h5>
                                <div class="card-body">
                                    <h5 class="card-title"></h5>
                                    <p class="card-text">
                                    <h1 id="customer">0</h1>
                                    </p>
                                    <a href="{{ route('customer.index') }}" class="btn btn-primary">View All</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                <h5 class="card-header">Carton</h5>
                                <div class="card-body">
                                    <h5 class="card-title"></h5>
                                    <p class="card-text">
                                    <h1 id="carton">0</h1>
                                    </p>
                                    <a href="{{ route('carton.index') }}" class="btn btn-primary">View All</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                <h5 class="card-header">Pending Shipment</h5>
                                <div class="card-body">
                                    <h5 class="card-title"></h5>
                                    <p class="card-text">
                                    <h1 id="pending_shipment">0</h1>
                                    </p>
                                    <a href="{{ route('shipment.index') }}" class="btn btn-primary">View All</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                <h5 class="card-header">In transit Shipment</h5>
                                <div class="card-body">
                                    <h5 class="card-title"></h5>
                                    <p class="card-text">
                                    <h1 id="in_transit_shipment">0</h1>
                                    </p>
                                    <a href="{{ route('shipment.index') }}" class="btn btn-primary">View All</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                <h5 class="card-header">Delivered Shipment</h5>
                                <div class="card-body">
                                    <h5 class="card-title"></h5>
                                    <p class="card-text">
                                    <h1 id="delivered_shipment">0</h1>
                                    </p>
                                    <a href="{{ route('shipment.index') }}" class="btn btn-primary">View All</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                <h5 class="card-header">Canceled Shipment</h5>
                                <div class="card-body">
                                    <h5 class="card-title"></h5>
                                    <p class="card-text">
                                    <h1 id="cancelled_shipment">0</h1>
                                    </p>
                                    <a href="{{ route('shipment.index') }}" class="btn btn-primary">View All</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                <h5 class="card-header">Pending Payment</h5>
                                <div class="card-body">
                                    <h5 class="card-title"></h5>
                                    <p class="card-text">
                                    <h1 id="pending_payment">0</h1>
                                    </p>
                                    <a href="{{ route('payment.index') }}" class="btn btn-primary">View All</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                <h5 class="card-header">Paid Payment</h5>
                                <div class="card-body">
                                    <h5 class="card-title"></h5>
                                    <p class="card-text">
                                    <h1 id="paid_payment">0</h1>
                                    </p>
                                    <a href="{{ route('payment.index') }}" class="btn btn-primary">View All</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                <h5 class="card-header">Failed Payment</h5>
                                <div class="card-body">
                                    <h5 class="card-title"></h5>
                                    <p class="card-text">
                                    <h1 id="failed_payment">0</h1>
                                    </p>
                                    <a href="{{ route('payment.index') }}" class="btn btn-primary">View All</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="card">
                                <h5 class="card-header">Payment Statics</h5>
                                <div class="card-body">
                                    <h5 class="card-title">Per Month</h5>
                                    <p class="card-text">
                                    <h1>10,000 BDT</h1>
                                    </p>
                                    <a href="#" class="btn btn-primary">View All</a>
                                    <div id="chartdiv"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        am5.ready(function () {
            var root = am5.Root.new("chartdiv");

            root.setThemes([
                am5themes_Animated.new(root)
            ]);

            var chart = root.container.children.push(am5xy.XYChart.new(root, {
                panX: true,
                panY: true,
                wheelX: "panX",
                wheelY: "zoomX",
                pinchZoomX: true,
                paddingLeft: 0,
                paddingRight: 1
            }));

            var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
            cursor.lineY.set("visible", false);

            var xRenderer = am5xy.AxisRendererX.new(root, {
                minGridDistance: 30,
                minorGridEnabled: true
            });

            xRenderer.labels.template.setAll({
                rotation: -90,
                centerY: am5.p50,
                centerX: am5.p100,
                paddingRight: 15
            });

            xRenderer.grid.template.setAll({
                location: 1
            });

            var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
                maxDeviation: 0.3,
                categoryField: "country",
                renderer: xRenderer,
                tooltip: am5.Tooltip.new(root, {})
            }));

            var yRenderer = am5xy.AxisRendererY.new(root, {
                strokeOpacity: 0.1
            });

            var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                maxDeviation: 0.3,
                renderer: yRenderer
            }));

            var series = chart.series.push(am5xy.ColumnSeries.new(root, {
                name: "Series 1",
                xAxis: xAxis,
                yAxis: yAxis,
                valueYField: "value",
                sequencedInterpolation: true,
                categoryXField: "country",
                tooltip: am5.Tooltip.new(root, {
                    labelText: "{valueY}"
                })
            }));

            series.columns.template.setAll({
                cornerRadiusTL: 5,
                cornerRadiusTR: 5,
                strokeOpacity: 0
            });

            series.columns.template.adapters.add("fill", function (fill, target) {
                return chart.get("colors").getIndex(series.columns.indexOf(target));
            });

            series.columns.template.adapters.add("stroke", function (stroke, target) {
                return chart.get("colors").getIndex(series.columns.indexOf(target));
            });

            var data = [
                { country: "USA", value: 2025 },
                { country: "China", value: 1882 },
                { country: "Japan", value: 1809 },
                { country: "Germany", value: 1322 },
                { country: "UK", value: 1122 },
                { country: "France", value: 1114 },
                { country: "India", value: 984 },
                { country: "Spain", value: 711 },
                { country: "Netherlands", value: 665 },
                { country: "South Korea", value: 443 },
                { country: "Canada", value: 441 }
            ];

            xAxis.data.setAll(data);
            series.data.setAll(data);

            series.appear(1000);
            chart.appear(1000, 100);
        });
    </script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: "{{ route('dashboard.index') }}",
            dataType: "json",
            success: function (data) {
                const response = data.data;

                if (response !== null) {
                    $('#appoinment').text(response.appoinment);
                    $('#employee').text(response.employee);
                    $('#customer').text(response.customer);
                    $('#carton').text(response.carton);
                    $('#pending_shipment').text(response.pending_shipment);
                    $('#in_transit_shipment').text(response.in_transit_shipment);
                    $('#delivered_shipment').text(response.delivered_shipment);
                    $('#cancelled_shipment').text(response.cancelled_shipment);
                    $('#pending_payment').text(response.pending_payment);
                    $('#paid_payment').text(response.paid_payment);
                    $('#failed_payment').text(response.failed_payment);
                }
            },
            error: function (xhr, status, error) {
                console.error("Error fetching dashboard data:", error);
            }
        });
    </script>
    <script>
        $(document).ready(function () {
            $('input[name="dateRange"]').change(function () {
                if ($(this).val() === 'custom') {
                    $('#customDateFields').fadeIn();
                } else {
                    $('#customDateFields').fadeOut();
                    $('#startDate, #endDate').val('');
                }
            });

            $('#resetBtn').click(function () {
                $('#customDateFields').fadeOut();
                $('#filterForm')[0].reset();
            });

            $('#filterForm').submit(function (e) {
                e.preventDefault();

                const selectedRange = $('input[name="dateRange"]:checked').val();
                const startDate = $('#startDate').val();
                const endDate = $('#endDate').val();

                const data = {
                    dateRange: selectedRange,
                    start_date: startDate,
                    end_date: endDate,
                    _token: $('meta[name="csrf-token"]').attr('content')
                };

                $.ajax({
                    type: 'POST',
                    url: "{{ route('dashboard.index') }}",
                    data: data,
                    dataType: 'json',
                    success: function (data) {
                        const response = data.data[0];

                        if (response !== undefined) {
                            $('#appoinment').text(response.appoinment);
                            $('#employee').text(response.employee);
                            $('#customer').text(response.customer);
                            $('#carton').text(response.carton);
                            $('#pending_shipment').text(response.pending_shipment);
                            $('#in_transit_shipment').text(response.in_transit_shipment);
                            $('#delivered_shipment').text(response.delivered_shipment);
                            $('#cancelled_shipment').text(response.cancelled_shipment);
                            $('#pending_payment').text(response.pending_payment);
                            $('#paid_payment').text(response.paid_payment);
                            $('#failed_payment').text(response.failed_payment);
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('Error applying filter:', error);
                        alert('Failed to apply filter.');
                    }
                });
            });
        });
    </script>

</body>

</html>
