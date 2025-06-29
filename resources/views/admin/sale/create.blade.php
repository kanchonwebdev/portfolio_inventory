<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Hello, world!</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            @include('extend.sidebar')

            <div class="col-md-9">
                <div class="container-fluid bg-light p-4">
                    @include('extend.header')

                    <div class="row g-4">
                        <div class="col-md-12">
                            <div class="card">
                                <h1 class="card-header">View sale</h1>
                                <div class="card-body">
                                    <a href="{{ route('sale.index') }}" class="btn btn-primary">View sale</a>
                                </div>
                            </div>
                        </div>

                        @if (session('success'))
                            <div class="col-md-12">
                                <div class="bg-success rounded p-3 text-white">
                                    {{ session('success') }}
                                </div>
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="col-md-12">
                                <div class="row">
                                    @foreach ($errors->all() as $error)
                                        <div class="col-md-4">
                                            <div class="bg-danger rounded p-3 text-white">
                                                {{ $error }}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <form class="row g-3 needs-validation" action="{{ route('sale.store') }}"
                                        method="POST" novalidate>
                                        @csrf

                                        <div class="col-md-6">
                                            <label for="customer_id" class="form-label">Customer</label>
                                            <select name="user_id" id="customer_id" class="form-select" required>
                                                <option value="">Select Customer</option>
                                                @foreach ($customers as $customer)
                                                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="product_id" class="form-label">Product</label>
                                            <select name="shop_id" id="product_id" class="form-select" required>
                                                <option value="">Select Product</option>
                                                @foreach ($products as $product)
                                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-12">
                                            <label for="per_unit_expense" class="form-label">Per unit expense</label>
                                            <input type="number" class="form-control" readonly min="0"
                                                name="per_unit_expense" id="per_unit_expense">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="purchase_price" class="form-label">Purchase price</label>
                                            <input type="number" class="form-control" readonly min="0"
                                                name="purchase_price" id="purchase_price">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="quantity" class="form-label">Available quantity</label>
                                            <input type="number" class="form-control" readonly min="0" name="quantity"
                                                id="quantity">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="per_unit_price" class="form-label">Per unit price</label>
                                            <input type="number" class="form-control" min="0" readonly
                                                name="per_unit_price" id="per_unit_price">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="sold_unit" class="form-label">Sold unit</label>
                                            <input type="number" class="form-control" min="1" name="sold_unit"
                                                id="sold_unit">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="total_amount" class="form-label">Total amount</label>
                                            <input type="number" class="form-control" min="0" readonly
                                                name="total_amount" id="total_amount">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="due_amount" class="form-label">Due amount</label>
                                            <input type="number" class="form-control" min="0" readonly name="due_amount"
                                                id="due_amount">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="vat" class="form-label">VAT</label>
                                            <input type="number" class="form-control" min="0" name="vat" id="vat">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="discount" class="form-label">Discount</label>
                                            <input type="number" class="form-control" min="0" name="discount"
                                                id="discount">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="discount_type" class="form-label">Discount Type</label>
                                            <select name="discount_type" id="discount_type" class="form-select">
                                                <option value="percentage">Percentage</option>
                                                <option value="fixed">Fixed</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="paid_amount" class="form-label">Paid Amount</label>
                                            <input type="text" class="form-control" name="paid_amount" min="0"
                                                id="paid_amount">
                                        </div>

                                        <div class="col-12">
                                            <button class="btn btn-primary" id="create_sale" type="submit">Create
                                                Sale</button>
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

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function () {
            function recalculateTotals() {
                var per_unit_price = parseFloat($('#per_unit_price').val()) || 0;
                var sold_unit = parseFloat($('#sold_unit').val()) || 0;
                var vat = parseFloat($('#vat').val()) || 0;
                var discount = parseFloat($('#discount').val()) || 0;
                var paid_amount = parseFloat($('#paid_amount').val()) || 0;
                var discount_type = $('#discount_type').val();

                var total_amount = per_unit_price * sold_unit;
                var updated_discount = (discount_type === 'percentage') ? (total_amount * (discount / 100)) : discount;
                var discounted_total = total_amount - updated_discount;
                var updated_total = discounted_total + (discounted_total * (vat / 100));

                if(paid_amount >= updated_total) {
                    $('#due_amount').val(0);
                } else {
                    $('#due_amount').val((updated_total - paid_amount).toFixed(2));
                }

                $('#total_amount').val(updated_total.toFixed(2));
                $('#paid_amount').val(paid_amount);
                $('#discount').val(discount);
                $('#vat').val(vat);
            }

            $('#product_id').on('change', function (e) {
                var product_id = e.target.value;
                if (product_id === '') return;

                $('#create_sale').attr('disabled', true).text('Please wait...');

                $.ajax({
                    type: 'POST',
                    url: '{{ route('sale.store') }}',
                    data: { product_id: product_id },
                    dataType: 'json',
                    success: function (data) {

                        console.log(data.shop);
                        $('#per_unit_price').val(data.shop.sell_price);
                        $('#sold_unit').val(1);
                        $('#total_amount').val(data.shop.sell_price);
                        $('#due_amount').val(data.shop.sell_price);
                        $('#paid_amount').val(0);
                        $('#discount').val(0);
                        $('#vat').val(0);
                        $('#purchase_price').val(data.shop.purchase_price);
                        $('#quantity').val(data.shop.quantity);
                        $('#per_unit_expense').val(data.shop.expense ? data.shop.expense.total_cost : 0);

                        $('#create_sale').attr('disabled', false).text('Create Sale');
                    }
                });
            });

            $('#sold_unit, #vat, #discount, #discount_type').on('input change', recalculateTotals);

            $('#paid_amount').on('input', function (e) {
                var total_amount = parseFloat($('#total_amount').val()) || 0;
                var paid_amount = parseFloat(e.target.value) || 0;

                $('#paid_amount').val(paid_amount);
                if (paid_amount >= total_amount) {
                    $('#due_amount').val(0);
                }
                else {
                    $('#due_amount').val((total_amount - paid_amount).toFixed(2));
                }
            });

            $('form').on('keypress', function (e) {
                if (e.keyCode === 13) {
                    e.preventDefault();
                }
            });
        });
    </script>

    <script>
        (function () {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms).forEach(function (form) {
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
