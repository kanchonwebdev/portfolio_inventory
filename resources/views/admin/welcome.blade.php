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
                            <form method="get" action="" class="row">
                                <div class="col-md-4">
                                    <label for="start_date" class="form-label">Start Date</label>
                                    <input type="text" class="form-control custom_date" value="{{ request('start_date') }}" name="start_date"
                                        id="start_date">
                                </div>
                                <div class="col-md-4">
                                    <label for="end_date" class="form-label">End Date</label>
                                    <input type="text" class="form-control custom_date" value="{{ request('end_date') }}" name="end_date"
                                        id="end_date">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" style="visibility: hidden;">Show Report</label>
                                    <input type="submit" class="form-control btn btn-primary" value="Show Report">
                                </div>
                                <div class="col-md-12 mt-3">
                                    <a href="{{ route('report.index') }}" class="form-control btn btn-danger">Reset Filter</a>
                                </div>
                            </form>
                        </div>

                        <div class="col-md-12">
                            <div class="card">
                                <h1 class="card-header">Total Sales</h1>
                                <div class="card-body">
                                    <h2 class="card-title">120</h2>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card">
                                <h1 class="card-header">Expenses Amount</h1>
                                <div class="card-body">
                                    <h2 class="card-title">120</h2>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card">
                                <h1 class="card-header">Sales Amount</h1>
                                <div class="card-body">
                                    <h2 class="card-title">120</h2>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card">
                                <h1 class="card-header">Profit Amount</h1>
                                <div class="card-body">
                                    <h2 class="card-title">120</h2>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card">
                                <h1 class="card-header">Loss Amount</h1>
                                <div class="card-body">
                                    <h2 class="card-title">120</h2>
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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

</body>

</html>
