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
                                <h1 class="card-header">View product</h1>
                                <div class="card-body">
                                    <a href="{{route('product.create')}}" class="btn btn-primary">Add product</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <img src="{{asset($collection->image)}}" alt="">
                                    <h2 class="card-title">Product Name: {{$collection->name}}</h2>
                                    <p class="card-text">Description: {{$collection->description}}</p>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><b>Status:</b> {{$collection->status}}</li>
                                    <li class="list-group-item"><b>Quantity:</b> {{$collection->quantity}}</li>
                                    <li class="list-group-item"><b>Max Order:</b> {{$collection->maxOrder}}</li>
                                    <li class="list-group-item"><b>Price:</b> {{$collection->price}}</li>
                                    <li class="list-group-item"><b>Tag:</b> {{$collection->tag->name}}</li>
                                    <li class="list-group-item"><b>Category:</b> {{$collection->category->name}}</li>
                                </ul>
                                <div class="card-body">
                                    <a href="{{ route('product.edit', $collection->id) }}" class="card-link btn btn-success">Update</a>
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
