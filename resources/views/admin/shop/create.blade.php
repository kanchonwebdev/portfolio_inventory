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
                                <h1 class="card-header">View product</h1>
                                <div class="card-body">
                                    <a href="{{route('product.index')}}" class="btn btn-primary">View product</a>
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
                                    <form class="row g-3 needs-validation" action="{{ route('product.store') }}"
                                        method="POST" enctype="multipart/form-data" novalidate>
                                        @csrf

                                        <div class="col-md-6">
                                            <label for="name" class="form-label">Name</label>
                                            <input type="text" class="form-control" name="name" id="name">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="image" class="form-label">Image</label>
                                            <input type="file" class="form-control" name="image" id="image">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="quantity" class="form-label">Quantity</label>
                                            <input type="text" class="form-control" name="quantity" id="quantity">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="maxOrder" class="form-label">Max Order</label>
                                            <input type="text" class="form-control" name="maxOrder" id="maxOrder">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="price" class="form-label">Price</label>
                                            <input type="text" class="form-control" name="price" id="price">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="status" class="form-label">Status</label>
                                            <select class="form-select" name="status" id="status">
                                                <option value="">Select Status</option>
                                                <option value="draft">Draft</option>
                                                <option value="publish">Publish</option>
                                                <option value="outofstock">Out of stock</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="tag" class="form-label">Tag</label>
                                            <select name="tag_id" id="tag" class="form-select">
                                                <option value="">Select Tag</option>
                                                @foreach ($tags as $tag)
                                                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="category" class="form-label">Category</label>
                                            <select name="category_id" id="category" class="form-select">
                                                <option value="">Select Category</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="name" class="form-label">Name</label>
                                            <textarea class="form-control" name="description" id="description"
                                                rows="3"></textarea>
                                        </div>

                                        <div class="col-12">
                                            <button class="btn btn-primary" type="submit">Submit form</button>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>
    <script>
        $(function () {
            $(".custom_date").datepicker({
                dateFormat: 'yy-mm-dd'
            });
            //$(".custom_date").datepicker();
            //$(".custom_date").datepicker({ minDate: -20, maxDate: "+10M +10D" });
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
