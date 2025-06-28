<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
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
    <div class="hero-section not-found-section">
        <div class="grid">
            <div class="col">
                <div class="img">
                    <img src="img/1.jpg" alt="">
                </div>
                <div class="text-block">
                    <p class="m-title">A unique experience</p>
                    <h1 class="title">404</h1>
                    <div class="btn-block">
                        <a href="">go to homepage</a>
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
</body>

</html>
