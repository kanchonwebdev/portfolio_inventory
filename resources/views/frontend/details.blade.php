<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E commerce - Homepage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
                    <h1 class="title">food is a poetry in <br> a bottle</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="shop-details-section pop-up d-none">
        <div class="close-btn">
            close
        </div>
        <div class="grid">
            <div class="col">
                <div class="card">
                    <div class="img">
                        <img src="{{asset($product->image)}}" alt="{{$product->name}}">
                    </div>
                </div>
            </div>
        </div>
        <div class="grid grid-2">
            <div class="col">
                <div class="card">
                    <div class="text-block">
                        <h1 class="title">{{ $product->name }}</h1>

                        <p class="text">
                            {{ $product->description }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="text-block">
                        <h1 class="title">Other Details</h1>
                        <div class="block">
                            <b>Max Order: </b> 01
                        </div>

                        <div class="block">
                            <b>Available Quantity: </b> 01
                        </div>

                        <div class="block">
                            <b>Tags: </b> <a href="">Shirt</a> <a href="">Polo</a> <a href="">Shirt</a>
                        </div>

                        <div class="block">
                            <b>Categories: </b> <a href="">Shirt</a> <a href="">Polo</a> <a href="">Shirt</a>
                        </div>
                        <div class="block">
                            <b>Status: </b> In Stock
                        </div>
                        <div class="block">
                            <b>Is Gift: </b> Yes
                        </div>
                        <div class="block">
                            <b>Is Combo: </b> No
                        </div>
                        <div class="block">
                            <b>Discount: </b> 10%
                        </div>
                    </div>

                    <div class="btn-block">
                        <a href="" class="btn">add to card</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- shop details section -->
    <div class="shop-details-section">
        <div class="grid">
            <div class="col">
                <div class="card">
                    <div class="img">
                        <img src="{{asset($product->image)}}" alt="{{$product->name}}">
                    </div>
                </div>
            </div>
        </div>
        <div class="grid grid-2">
            <div class="col">
                <div class="card">
                    <div class="text-block">
                        <h1 class="title">{{$product->name}}</h1>

                        <p class="text">
                            {{$product->description}}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="text-block">
                        <h1 class="title">Other Details</h1>
                        <div class="block">
                            <b>Max Order: </b> {{$product->maxOrder}}
                        </div>

                        <div class="block">
                            <b>Available Quantity: </b> {{$product->quantity}}
                        </div>

                        <div class="block">
                            <b>Tags: </b> <a href="">{{$product->tag_id}}</a>
                        </div>

                        <div class="block">
                            <b>Categories: </b> <a href="">{{$product->category_id}}</a>
                        </div>
                        <div class="block">
                            <b>Status: </b> {{$product->status}}
                        </div>
                    </div>

                    <div class="btn-block">
                        <a href="" class="btn">add to card</a>
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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const quickView = document.querySelectorAll('.quick-view');
        const popUp = document.querySelector('.shop-details-section');
        const closeBtn = document.querySelector('.close-btn');

        quickView.forEach((item) => {
            item.addEventListener('click', (e) => {
                e.preventDefault();
                popUp.classList.remove('d-none');
            });
        });

        closeBtn.addEventListener('click', () => {
            popUp.classList.add('d-none');
        });
    </script>
</body>

</html>
