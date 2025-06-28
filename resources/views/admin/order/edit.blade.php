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
                                <h1 class="card-header">Update order</h1>
                                <div class="card-body">
                                    <a href="{{ route('order.index') }}" class="btn btn-primary">View
                                        order</a>
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
                                        action="{{ route('order.update', $collection->id) }}" method="POST"
                                        novalidate>
                                        @csrf
                                        @method('PUT')

                                        <div class="col-md-6">
                                            <label for="status" class="form-label">Status</label>
                                            <input type="text" class="form-control" value="{{ $collection->status }}" name="status" id="status">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="payment_status" class="form-label">Payment Status</label>
                                            <input type="text" class="form-control" value="{{ $collection->payment_status }}" name="payment_status" id="payment_status">
                                        </div>

                                        <div class="col-12">
                                            <button class="btn btn-primary" type="submit">Submit form</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
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
                                                    <img src="{{ asset($item->image) }}" class="card-img-top" alt="{{ $item->name }}">
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
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>
    <script>
        $(function() {
            $(".custom_date").datepicker({
                dateFormat: 'yy-mm-dd'
            });
        });
    </script>

    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
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
