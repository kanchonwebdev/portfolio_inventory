<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Hello, world!</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            {{-- Sidebar Start --}}
            @include('extend.sidebar')
            {{-- Sidebar End --}}

            <div class="col-md-9">
                <div class="container-fluid bg-light p-4">
                    {{-- Employee Start --}}
                    @include('extend.header')
                    {{-- Employee END --}}

                    <div class="row g-4">
                        @if (session('success'))
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="bg-danger rounded p-3 text-white">
                                            <div>{{ session('success') }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="col-md-12">
                            <form method="get" action="{{ route('report.index') }}" class="row">
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
                                <div class="card-body">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">SL</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Sold Unit</th>
                                                <th scope="col">Sales Amount</th>
                                                <th scope="col">Expense Amount</th>
                                                <th scope="col">Profit</th>
                                                <th scope="col">Loss</th>
                                                <th scope="col" class="text-center">Handle</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($collection as $index => $item)
                                                @php
    $expense_amount = ($item->shop->purchase_price * $item->sold_unit) + ($item->per_unit_expense * $item->sold_unit);
    $profit = $item->total_amount > $expense_amount ? $item->total_amount - $expense_amount : 0;
    $loss = $item->total_amount < $expense_amount ? $expense_amount - $item->total_amount : 0;
                                                @endphp
                                                <tr>
                                                    <th scope="row">{{ $index + 1 }}</th>
                                                    <td>{{ $item->shop->name }}</td>
                                                    <td>{{ $item->sold_unit }}</td>
                                                    <td>{{ $item->total_amount }}</td>
                                                    <td>{{ $expense_amount }}</td>
                                                    <td>{{ $profit }}</td>
                                                    <td>{{ $loss }}</td>
                                                    <td class="text-center">
                                                        <a class="btn btn-primary" href="{{ route('sale.show', $item->id) }}">view details</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            {{ $collection->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>
    <script>
        $(function () {
            $(".custom_date").datepicker({
                dateFormat: 'yy-mm-dd'
            });
        });
    </script>
</body>

</html>
