@extends("admin.layouts.master")

@section("page")
  View Order
@endsection

@section("content")
  @include('admin.layouts.message')
  <a href="{{ route('orders.index') }}" class="btn btn-success btn-sm" style="margin-bottom: 15px;">&laquo; Back to Orders</a>
  <div class="row">
    <div class="col-md-6">
      <div class="card">
        <div class="header">
          <h4 class="title">User Details</h4>
          <p class="category">User Details</p>
        </div>
        <div class="content table-responsive table-full-width">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>User ID</th>
                <td>{{ $order->user->id }}</td>
              </tr>
              <tr>
                <th>User Name</th>
                <td>{{ $order->user->name }}</td>
              </tr>
              <tr>
                <th>User Email</th>
                <td>{{ $order->user->email }}</td>
              </tr>
              <tr>
                <th>User Registered At</th>
                <td>{{ $order->user->created_at->diffForHumans() }}</td>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <div class="card">
        <div class="header">
          <h4 class="title">Product Details</h4>
          <p class="category">Product Details</p>
        </div>
        <div class="content table-responsive table-full-width">
          <table class="table table-striped">
            <thead>
              <th>Order ID</th>
              <th>Product Image</th>
              <th>Product Name</th>
              <th>Product Price</th>
              <th>Product Quantity</th>
              <th>Total Price</th>
            </thead>
            <tbody>
              <tr>
                <td>{{ $order->id }}</td>
                <td>
                  <ul class="list-group">
                    @foreach($order->products as $product)
                      <li class="list-group-item text-center">
                        <img src="{{ url('/backend/uploads/' . $product->image) }}" alt="{{ $product->image }}" class="img-thumbnail" style="width: 80px;">
                      </li>
                    @endforeach
                  </ul>
                </td>
                <td>
                  <ul class="list-group">
                    @foreach($order->products as $product)
                      <li class="list-group-item text-center">
                        {{ $product->name }}
                      </li>
                    @endforeach
                  </ul>
                </td>
                <td>
                  <ul class="list-group">
                    @foreach($order->products as $product)
                      <li class="list-group-item text-center">
                        ${{ $product->price }}
                      </li>
                    @endforeach
                  </ul>
                </td>
                <td>
                  <ul class="list-group">
                    @foreach($order->orderItems as $item)
                      <li class="list-group-item text-center">
                        {{ $item->quantity }}
                      </li>
                    @endforeach
                  </ul>
                </td>
                <td>
                  <ul class="list-group">
                    @foreach($order->orderItems as $item)
                      <li class="list-group-item text-center">
                        ${{ $item->price }}
                      </li>
                    @endforeach
                  </ul>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <div class="card">
        <div class="header">
          <h4 class="title">Order Details</h4>
          <p class="category">Order details</p>
        </div>
        <div class="content table-responsive table-full-width">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Order ID</th>
                <th>Order Date</th>
                <th>Order Address</th>
                <th>Order Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->date->diffForHumans() }}</td>
                <td>{{ $order->address }}</td>
                <td>
                  @if($order->status)
                    <span class="label label-success">Confirmed</span>
                  @else
                    <span class="label label-warning">Pending</span>
                  @endif
                </td>
                <td>
                  @if($order->status)
                    {{ Form::open(['route' => ['orders.pending', $order->id], 'method' => 'post']) }}
                      {{ Form::button('Pending', ['type' => 'submit', 'class' => 'btn btn-sm btn-warning']) }}
                    {{ Form::close() }}
                  @else
                    {{ Form::open(['route' => ['orders.confirm', $order->id], 'method' => 'post']) }}
                      {{ Form::button('Confirm', ['type' => 'submit', 'class' => 'btn btn-sm btn-success']) }}
                    {{ Form::close() }}
                  @endif
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection
