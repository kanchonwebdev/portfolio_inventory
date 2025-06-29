<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">

    <title>Hello, world!</title>
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
                    {{-- Header Start --}}
                    @include('extend.header')
                    {{-- Header End --}}

                    <div class="row g-4">
                        <div class="col-md-12">
                            <div class="card">
                                <h1 class="card-header">View expense</h1>
                                <div class="card-body">
                                    <a href="{{route('expense.index')}}" class="btn btn-primary">View expense</a>
                                </div>
                            </div>
                        </div>
                        @if (session('success'))
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="bg-success rounded p-3 text-white">
                                            <div>{{ session('success') }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="col-md-12">
                                <div class="row">
                                    @foreach ($errors->all() as $error)
                                        <div class="col-md-4">
                                            <div class="bg-danger rounded p-3 text-white">
                                                <div>{{ $error }}</div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <form class="row g-3 needs-validation" action="{{ route('expense.store') }}"
                                        method="POST" novalidate>
                                        @csrf

                                        <div class="col-md-6">
                                            <label for="shop" class="form-label">Product</label>
                                            <select class="form-select" name="shop_id" id="shop">
                                                <option value="">Select Product</option>
                                                @foreach ($shop as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="sell_price" class="form-label">Sell Price</label>
                                            <input type="text" class="form-control" readonly name="sell_price" id="sell_price">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="purchase_price" class="form-label">Purchase Price</label>
                                            <input type="text" class="form-control" readonly name="purchase_price" id="purchase_price">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="quantity" class="form-label">Quantity</label>
                                            <input type="text" class="form-control" readonly name="quantity" id="quantity">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="transport_cost" class="form-label">Transport Cost</label>
                                            <input type="text" class="form-control" name="transport_cost" id="transport_cost">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="store_rent_cost" class="form-label">Store Rent Cost</label>
                                            <input type="text" class="form-control" name="store_rent_cost" id="store_rent_cost">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="labour_cost" class="form-label">Labour Cost</label>
                                            <input type="text" class="form-control" name="labour_cost" id="labour_cost">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="others_cost" class="form-label">Others Cost</label>
                                            <input type="text" class="form-control" name="others_cost" id="others_cost">
                                        </div>

                                        <div class="col-12">
                                            <button class="btn btn-primary" type="submit" id="create_expense">Create Expense</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function () {
            $('#shop').on('change', function (e) {
                var product_id = e.target.value;
                if (product_id === '') return;

                $('#create_expense').attr('disabled', true).text('Please wait...');

                $.ajax({
                    type: 'POST',
                    url: '{{ route('expense.store') }}',
                    data: { product_id: product_id },
                    dataType: 'json',
                    success: function (data) {
                        $('#sell_price').val(data.shop.sell_price);
                        $('#purchase_price').val(data.shop.purchase_price);
                        $('#quantity').val(data.shop.quantity);

                        $('#create_expense').attr('disabled', false).text('Create Expense');
                    }
                });
            });
        });
    </script>
    <script>
        $(function () {
            $(".custom_date").datepicker({
                dateFormat: 'yy-mm-dd'
            });
        });
    </script>

    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function () {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
</body>

</html>
