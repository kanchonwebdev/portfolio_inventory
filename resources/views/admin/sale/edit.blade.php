<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
                                <h1 class="card-header">Update sale</h1>
                                <div class="card-body">
                                    <a href="{{ route('sale.index') }}" class="btn btn-primary">View
                                        sale</a>
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
                                    <div class="col-md-4">
                                        @foreach ($errors->all() as $error)
                                            <div class="bg-danger rounded p-3 text-white">
                                                <div>{{ $error }}</div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <form class="row g-3 needs-validation"
                                        action="{{ route('sale.update', $collection->id) }}" method="POST" novalidate>
                                        @csrf
                                        @method('PUT')

                                        <div class="col-md-6">
                                            <label for="customer_name" class="form-label">Customer Name</label>
                                            <div id="customer_name" class="form-control">
                                                {{$collection->user->name}}
                                            </div>
                                            <input type="hidden" name="user_id" value="{{$collection->user->id}}">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="customer_email" class="form-label">Customer Email</label>
                                            <div id="customer_email" class="form-control">
                                                {{$collection->user->email}}
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <label for="product_name" class="form-label">Product Name</label>
                                            <div id="product_name" class="form-control">
                                                {{$collection->shop->name}}
                                            </div>
                                            <input type="hidden" name="shop_id" value="{{$collection->shop->id}}">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="purchase_price" class="form-label">Purchase price</label>
                                            <input type="number" class="form-control" readonly min="0"
                                                value="{{$collection->shop->purchase_price}}" id="purchase_price">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="quantity" class="form-label">Available quantity</label>
                                            <input type="number" class="form-control" readonly min="0"
                                                value="{{$collection->shop->quantity}}" id="quantity">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="per_unit_price" class="form-label">Per unit price</label>
                                            <input type="number" class="form-control" min="0"
                                                value="{{$collection->per_unit_price}}" readonly name="per_unit_price"
                                                id="per_unit_price">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="sold_unit" class="form-label">Sold unit</label>
                                            <input type="number" class="form-control" min="1"
                                                value="{{$collection->sold_unit}}" name="sold_unit" id="sold_unit">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="total_amount" class="form-label">Total amount</label>
                                            <input type="number" class="form-control" min="0" readonly
                                                value="{{$collection->total_amount}}" name="total_amount"
                                                id="total_amount">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="due_amount" class="form-label">Due amount</label>
                                            <input type="number" class="form-control" min="0" readonly
                                                value="{{$collection->due_amount}}" name="due_amount" id="due_amount">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="vat" class="form-label">VAT</label>
                                            <input type="number" class="form-control" min="0"
                                                value="{{$collection->vat}}" name="vat" id="vat">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="discount" class="form-label">Discount</label>
                                            <input type="number" class="form-control" min="0"
                                                value="{{$collection->discount}}" name="discount" id="discount">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="discount_type" class="form-label">Discount Type</label>
                                            <select name="discount_type" id="discount_type" class="form-select">
                                                <option value="percentage" {{ $collection->discount_type == 'percentage' ? 'selected' : '' }}>Percentage</option>
                                                <option value="fixed" {{ $collection->discount_type == 'fixed' ? 'selected' : '' }}>Fixed</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="paid_amount" class="form-label">Paid Amount</label>
                                            <input type="text" class="form-control" name="paid_amount"
                                                value="{{$collection->paid_amount}}" min="0" id="paid_amount">
                                        </div>

                                        @if ($collection->status == 'due')
                                            <div class="col-12">
                                                <button class="btn btn-primary" type="submit">Update Sale</button>
                                            </div>
                                        @endif
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

    <script>
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

                if (paid_amount >= updated_total) {
                    $('#due_amount').val(0);
                } else {
                    $('#due_amount').val((updated_total - paid_amount).toFixed(2));
                }

                $('#total_amount').val(updated_total.toFixed(2));
                $('#paid_amount').val(paid_amount);
                $('#discount').val(discount);
                $('#vat').val(vat);
            }

            $('#sold_unit, #vat, #discount, #discount_type').on('input change', recalculateTotals);

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
