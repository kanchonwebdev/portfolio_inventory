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
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="{{ route('order.index') }}" method="GET"
                                        class="bg-secondary rounded p-3 text-white">
                                        <div class="row g-2">
                                            <div class="col-md-3">
                                                <label for="type" class="form-label">Column Type</label>
                                                <select name="type" class="form-control" id="type">
                                                    <option value="">Select column type</option>
                                                    <option value="status" {{ request('type') == 'status' ? 'selected' : '' }}>
                                                        Status
                                                    </option>
                                                    <option value="payment_status" {{ request('type') == 'payment_status' ? 'selected' : '' }}>
                                                        Payment Status
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="name" class="form-label">Filter Value</label>
                                                <input type="text" name="name" class="form-control" id="name"
                                                    value="{{ request('name') }}">
                                            </div>
                                            <div class="col-md-3">
                                                <label for="start_date" class="form-label">Start Date</label>
                                                <input type="text" name="start_date" class="form-control custom_date"
                                                    id="start_date" value="{{ request('start_date') }}">
                                            </div>
                                            <div class="col-md-3">
                                                <label for="end_date" class="form-label">End Date</label>
                                                <input type="text" name="end_date" class="form-control custom_date"
                                                    id="end_date" value="{{ request('end_date') }}">
                                            </div>
                                            <div class="col-md-6">
                                                <a href="{{ route('order.index') }}"
                                                    class="btn-info text-center form-control">Reset</a>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="submit" name="submit" value="Filter"
                                                    class="btn-success form-control">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">SL</th>
                                                <th scope="col">Total Amount</th>
                                                <th scope="col">Payment Status</th>
                                                <th scope="col">Status</th>
                                                <th scope="col" class="text-center">Handle</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($collection as $index => $item)
                                                <tr>
                                                    <th scope="row">{{ $index + 1 }}</th>
                                                    <td>{{ $item->total_amount }}</td>
                                                    <td>{{ $item->payment_status }}</td>
                                                    <td>{{ $item->status }}</td>
                                                    <td class="text-center">
                                                        <a href="{{ route('order.show', $item->id) }}"
                                                            class="btn btn-info text-white">View</a>
                                                        <a href="{{ route('order.edit', $item->id) }}"
                                                            class="btn btn-success">Update</a>
                                                        <form action="{{ route('order.destroy', $item->id) }}"
                                                            method="POST" style="display:inline-block;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </form>
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
