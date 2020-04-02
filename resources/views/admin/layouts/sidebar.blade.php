<div class="sidebar" data-background-color="white" data-active-color="danger">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="{{ route('admin.home') }}" class="simple-text">
                Peter's Shop Admin
            </a>
        </div>
        <ul class="nav">
            <li>
                <a href="{{ route('admin.home') }}">
                    <i class="ti-panel"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li>
                <a href="{{ route('products.create') }}">
                    <i class="ti-archive"></i>
                    <p>Add Product</p>
                </a>
            </li>
            <li>
                <a href="{{ route('products.index') }}">
                    <i class="ti-view-list-alt"></i>
                    <p>View Products</p>
                </a>
            </li>
            <li>
                <a href="{{ route('orders.index') }}">
                    <i class="ti-calendar"></i>
                    <p>Orders</p>
                </a>
            </li>
            <li>
                <a href="{{ route('users.index') }}">
                    <i class="fa fa-users"></i>
                    <p>Users</p>
                </a>
            </li>
        </ul>
    </div>
</div>