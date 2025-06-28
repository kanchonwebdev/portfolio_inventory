<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E commerce - Homepage</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>

<body>
    <!-- nav section -->
    <div class="nav-section">
        <div class="grid">
            <div class="col">
                <a href="" class="logo">New Shop</a>
            </div>
            <div class="col">
                <div class="inline">
                    <a href="{{ route('shop.all')}}">Shop</a>
                    <a href="{{ route('shop.checkout')}}">Checkout</a>
                </div>
            </div>
            <div class="col">
                <div class="inline">
                    <a href="">Login into Foodpanda</a>
                    <a href="{{ route('shop.cart')}}">
                        cart <sup id="cartCount">{{ session('cart') ? count(session('cart')) : 0 }}</sup>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- hero section -->
    <div class="hero-section">
        <div class="grid">
            <div class="col">
                <div class="img">
                    <img src="{{asset('img/1.jpg')}}" alt="">
                </div>
                <div class="text-block">
                    <p class="m-title">A unique experience</p>
                    <h1 class="title">Cart</h1>
                </div>
            </div>
        </div>
    </div>

    <!-- checkout section -->
    <div class="checkout-section">
        <div class="grid">
            <div class="col">
                <div class="card">
                    <div class="inline">
                        <p class="text">items in order</p>
                    </div>
                    @php
$cart = session('cart') ?? [];
$total = 0;
if (count($cart) > 0) {
    foreach ($cart as $item) {
        $total += $item['price'] * $item['quantity'];
    }
}

$shipping = $total * 0.15;
$totalWithShipping = $total + $shipping;
                    @endphp

                    @if (count($cart) > 0)
                        @foreach ($cart as $key => $item)
                            <div class="block" id="cartItem-{{ $key }}">
                                <div class="grid-2 border">
                                    <div class="card-inline">
                                        <div class="img">
                                            <img src="{{asset($item['image'])}}" alt="">
                                        </div>
                                        <div class="text-block">
                                            <h3 class="title">{{ $item['name'] }}</h3>
                                        </div>
                                    </div>
                                    <div class="card-inline ml-100">
                                        <p class="price" id="price-{{ $key }}">&dollar; {{ $item['price'] * $item['quantity'] }} USD</p>
                                        <input type="number" name="" data-id="{{$key}}" class="quantity" value="{{$item['quantity']}}">
                                        <button type="submit" data-id="{{$key}}" class="remove">Remove</button>
                                    </div>
                                </div>
                                <br>
                            </div>
                        @endforeach
                    @else
                        <div class="block">
                            <p class="text">Your cart is empty</p>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="inline">
                        <p class="text">Order Summary</p>
                    </div>
                    <div class="block">
                        <div class="grid-2">
                            <div class="card-inline">
                                <p class="text">Sub Total</p>
                            </div>
                            <div class="card-inline">
                                <p class="text" id="subTotal">
                                    &dollar; {{ $total }} USD
                                </p>
                            </div>
                        </div>
                        <br>
                        <div class="grid-2">
                            <div class="card-inline">
                                <p class="text">Total</p>
                            </div>
                            <div class="card-inline">
                                <p class="text" id="total">
                                    &dollar; {{ $totalWithShipping }} USD
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="block">
                        <button type="submit">Place Order</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- footer section -->
    <div class="footer-section">
        <div class="grid">
            <div class="col">
                <div class="card">
                    <h3 class="title">Navigation</h3>

                    <div class="inline">
                        <a href="" data-text="About">About</a>
                        <a href="" data-text="Menu">Menu</a>
                        <a href="" data-text="Contact">Contact</a>
                        <a href="" data-text="Shop">Shop</a>
                        <a href="" data-text="Checkout">Checkout</a>
                        <a href="" data-text="Cart">Cart</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <h3 class="title">Services</h3>

                    <div class="inline">
                        <a href="">Privacy & Policy</a>
                        <a href="">Terms of use</a>
                        <a href="">Syle guide</a>
                        <a href="">Licence</a>
                        <a href="">Search</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <h3 class="title">Contact</h3>

                    <div class="inline">
                        <a href="">000 000 000 00</a>
                        <a href="">info@gmail.com</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <h3 class="title">Social</h3>

                    <div class="inline">
                        <a href="">facebook</a>
                        <a href="">instagram</a>
                        <a href="">twitter</a>
                        <a href="">linkedin</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <h3 class="title">Get the latest from New Shop</h3>

                    <p class="text">Don't miss our news about glamorous products and sparkling events</p>

                    <form method="post" class="form">
                        <input type="email" placeholder="Enter your email" name="" id="">
                        <input type="submit" value="submit">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function () {
            $('.remove').on('click', function (e) {
                e.preventDefault();
                const id = $(this).data('id');
                $.ajax({
                    type: 'GET',
                    url: '{{ route("shop.removeFromCart", ":id") }}'.replace(':id', id),
                    success: function (response) {
                        console.log(response);
                        $('#cartCount').text(response.cartCount);
                        $('#cartItem-' + id).remove();

                        let subTotal = 0;
                        let shipping = 0;
                        let total = 0;

                        Object.values(response.cart).forEach(item => {
                            subTotal += item.price * item.quantity;
                        });

                        shipping = subTotal * 0.15;
                        total = subTotal + shipping;

                        $('#subTotal').text(subTotal.toFixed(2) + ' USD');
                        $('#total').text(total.toFixed(2) + ' USD');
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });

            $('.quantity').on('change', function (e) {
                e.preventDefault();

                const id = $(this).data('id');
                const quantity = $(this).val();

                $.ajax({
                    type: 'POST',
                    url: '{{ route("shop.updateCart") }}',
                    data: {
                        quantity: quantity,
                        id: id
                    },
                    success: function (response) {
                        $('#cartCount').text(response.cartCount);
                        let subTotal = 0;
                        let shipping = 0;
                        let total = 0;

                        Object.values(response.cart).forEach(item => {
                            subTotal += item.price * item.quantity;
                        });

                        shipping = subTotal * 0.15;
                        total = subTotal + shipping;

                        $('#subTotal').html(subTotal.toFixed(2) + ' USD');
                        $('#total').html(total.toFixed(2) + ' USD');
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>
</body>

</html>
