<div class="col-md-3 position-sticky" style="height: 100%;top: 0;left: 0;">
    <div class="card">
        <div class="card-body">
            <h1 style="font-size: 35px">
                E-Commerce
                <span style="font-size: 20px;" class="d-block">New Group</span>
            </h1>
        </div>
    </div>
    <div class="card">
        <ul class="list-group list-group-flush">
            <li class="list-group-item">
                <a href="{{ route('dashboard') }}">Dashboard</a>
            </li>
            <li class="list-group-item">
                <a href="{{ route('product.index') }}">Product</a>
            </li>
            <li class="list-group-item">
                <a href="{{ route('category.index') }}">Category</a>
            </li>
            <li class="list-group-item">
                <a href="{{ route('tag.index') }}">Tag</a>
            </li>
            <li class="list-group-item">
                <a href="{{ route('order.index') }}">Order</a>
            </li>
        </ul>
    </div>
</div>
