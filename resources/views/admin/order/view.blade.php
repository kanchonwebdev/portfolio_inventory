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
                                <div class="card-body">
                                    <h2 class="card-title">Customer Name: {{$collection->checkout->name}}</h2>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><b>Email:</b> {{$collection->checkout->email}}</li>
                                    <li class="list-group-item"><b>Phone:</b> {{$collection->checkout->phone}}</li>
                                    <li class="list-group-item"><b>Address:</b> {{$collection->checkout->address}}</li>
                                    <li class="list-group-item"><b>City:</b> {{$collection->checkout->city}}</li>
                                    <li class="list-group-item"><b>State:</b> {{$collection->checkout->state}}</li>
                                    <li class="list-group-item"><b>Zip Code:</b> {{$collection->checkout->zip_code}}</li>
                                    <li class="list-group-item"><b>Country:</b> {{$collection->checkout->country}}</li>
                                    <li class="list-group-item"><b>Status:</b> {{$collection->status}}</li>
                                    <li class="list-group-item"><b>Payment Status:</b> {{$collection->payment_status}}</li>
                                    <li class="list-group-item"><b>Payment Method:</b> {{$collection->payment_method}}</li>
                                    <li class="list-group-item"><b>Order ID:</b> {{$collection->id}}</li>
                                    <li class="list-group-item"><b>Order Date:</b> {{$collection->created_at}}</li>
                                    <li class="list-group-item"><b>Order Total:</b> ${{ number_format($collection->total_amount, 2) }}</li>
                                </ul>
                                <div class="card-body">
                                    <a href="{{ route('order.edit', $collection->id) }}" class="card-link btn btn-success">Update</a>
                                </div>
                            </div>

                            <div class="card mt-4">
                                <div class="card-body">
                                    <h2 class="card-title">Order Items</h2>
                                    <div class="row">
                                        @foreach (json_decode($collection->checkout->products) as $item)
                                            <div class="col-md-4 mb-3">
                                                <div class="card">
                                                    <img src="{{ asset( $item->image) }}" class="card-img-top" alt="{{ $item->name }}">
                                                    <div class="card-body">
                                                        <h5 class="card-title">{{ $item->name }}</h5>
                                                        <p class="card-text">Quantity: {{ $item->quantity }}</p>
                                                        <p class="card-text">Price: ${{ number_format($item->price, 2) }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
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
