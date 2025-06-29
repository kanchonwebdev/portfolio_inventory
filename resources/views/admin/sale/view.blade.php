<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
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
                                <h1 class="card-header">View sale</h1>
                                <div class="card-body">
                                    <a href="{{route('sale.create')}}" class="btn btn-primary">Add sale</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h2 class="card-title">Customer Details</h2>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><b>Name:</b> {{$collection->user->name}}</li>
                                    <li class="list-group-item"><b>Email:</b> {{$collection->user->email}}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h2 class="card-title">Product Details</h2>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><b>Name:</b> {{$collection->shop->name}}</li>
                                    <li class="list-group-item"><b>Sell Price:</b> {{$collection->shop->sell_price}}</li>
                                    <li class="list-group-item"><b>Purchase Price:</b> {{$collection->shop->purchase_price}}</li>
                                    <li class="list-group-item"><b>Quantity:</b> {{$collection->shop->quantity}}</li>
                                </ul>
                                <div class="card-body">
                                    <a href="{{ route('product.edit', $collection->shop->id) }}" class="card-link btn btn-success">Update</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h2 class="card-title">Sales Inquiry</h2>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><b>Per unit price:</b> {{$collection->per_unit_price}}</li>
                                    <li class="list-group-item"><b>Sold unit:</b> {{$collection->sold_unit}}</li>
                                    <li class="list-group-item"><b>Total amount:</b> {{$collection->total_amount}}</li>
                                    <li class="list-group-item"><b>VAT:</b> {{$collection->vat}}</li>
                                    <li class="list-group-item"><b>Discount:</b> {{$collection->discount}}</li>
                                    <li class="list-group-item"><b>Discount Type:</b> {{$collection->discount_type}}</li>
                                    <li class="list-group-item"><b>Status:</b> {{$collection->status}}</li>
                                    <li class="list-group-item"><b>Paid Amount:</b> {{$collection->paid_amount}}</li>
                                    <li class="list-group-item"><b>Due Amount:</b> {{$collection->due_amount}}</li>
                                    <li class="list-group-item"><b>Sale By:</b> {{$collection->sale_by}}</li>
                                    <li class="list-group-item"><b>Sale Date:</b> {{$collection->created_at}}</li>
                                </ul>
                                <div class="card-body">
                                    <a href="{{ route('sale.edit', $collection->id) }}" class="card-link btn btn-success">Update</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>
