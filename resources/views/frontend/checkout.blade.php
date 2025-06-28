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
                    <h1 class="title">Checkout</h1>
                </div>
            </div>
        </div>
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
    <!-- checkout section -->
    <div class="checkout-section">
        <div class="grid">
            @if (session('cart') && count(session('cart')) > 0)
            <div class="col">
                <div class="card">
                    <div class="inline">
                        <p class="text">customer info</p>
                        <p class="text">*required</p>
                    </div>
                    <div class="block">
                        <label for="email">email*</label>
                        <input type="email" name="" id="email">
                    </div>
                    <div class="block">
                        <label for="phone">phone*</label>
                        <input type="text" name="" id="phone">
                    </div>
                </div>
                <div class="card">
                    <div class="inline">
                        <p class="text">shipping address</p>
                        <p class="text">*required</p>
                    </div>
                    <div class="block">
                        <label for="name">Full name *</label>
                        <input type="text" name="" id="name">
                    </div>
                    <div class="block">
                        <label for="address">Street address *</label>
                        <input type="text" name="" id="address">
                    </div>
                    <div class="grid-3">
                        <div class="block">
                            <label for="city">city *</label>
                            <input type="text" name="" id="city">
                        </div>
                        <div class="block">
                            <label for="state">state/province *</label>
                            <input type="text" name="" id="state">
                        </div>
                        <div class="block">
                            <label for="zip">zip/postal Code *</label>
                            <input type="text" name="" id="zip">
                        </div>
                    </div>
                    <div class="block">
                        <label for="country">country *</label>
                        <select name="" id="country">
                            <option value="germany">Germany</option>
                        </select>
                    </div>
                </div>
                <div class="card">
                    <div class="inline">
                        <p class="text">payment info</p>
                        <p class="text">*required</p>
                    </div>
                    <div class="block">
                        <label for="card">card number *</label>
                        <input type="text" name="" id="card">
                    </div>
                    <div class="grid-2">
                        <div class="block">
                            <label for="date">expiration date *</label>
                            <input type="text" name="" id="date">
                        </div>
                        <div class="block">
                            <label for="code">security code *</label>
                            <input type="text" name="" id="code">
                        </div>
                    </div>
                    <div class="block inline-block">
                        <input type="checkbox" name="" id="same">
                        <label class="text" for="same">Billing address same as shipping</label>
                    </div>
                </div>
                <div class="card">
                    <div class="inline">
                        <p class="text">items in order</p>
                    </div>

                    <div class="block">
                        @if (count($cart) > 0)
                            @foreach ($cart as $key => $item)
                                <div class="grid-2 border">
                                    <div class="card-inline">
                                        <div class="img">
                                            <img src="{{asset($item['image'])}}" alt="{{$item['name']}}">
                                        </div>
                                        <div class="text-block">
                                            <h3 class="title">{{$item['name']}}</h3>
                                        </div>
                                    </div>
                                    <div class="card-inline ml-100">
                                        <p class="price">&dollar; {{$item['price'] * $item['quantity']}} USD</p>
                                        <p class="text">quantity: <b>{{$item['quantity']}}</b></p>
                                    </div>
                                </div>
                                <br>
                            @endforeach
                        @else
                            <div class="grid-2 border">
                                <p class="text">Your cart is empty</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="inline">
                        <p class="text">order summary</p>
                    </div>
                    <div class="block">
                        <div class="grid-2">
                            <div class="card-inline">
                                <p class="text">subtotal</p>
                            </div>
                            <div class="card-inline">
                                <p class="text">&dollar; {{$total}} USD</p>
                            </div>
                        </div>
                        <br>
                        <div class="grid-2">
                            <div class="card-inline">
                                <p class="text">total</p>
                            </div>
                            <div class="card-inline">
                                <p class="text">&dollar; {{$totalWithShipping}} USD</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="block">
                        <label for="discount">discount code</label>
                        <input type="text" name="" id="discount">
                        <br>
                        <button type="submit">apply</button>
                    </div>
                </div>

                @if (session('cart') && count(session('cart')) > 0)
                    <div class="card">
                        <div class="block">
                            <button type="submit" id="placeOrder">place order</button>
                        </div>
                    </div>
                @endif
            </div>
            @endif
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
            $('#placeOrder').on('click', function (e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: '{{ route("checkout.store") }}',
                    data: {
                        name: $('#name').val(),
                        email: $('#email').val(),
                        phone: $('#phone').val(),
                        address: $('#address').val(),
                        city: $('#city').val(),
                        state: $('#state').val(),
                        zip: $('#zip').val(),
                        country: $('#country').val(),
                        id: {{ auth()->id() }},
                        total_amount: {{ $totalWithShipping }},
                    },
                    success: function (response) {
                        console.log(response);
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
