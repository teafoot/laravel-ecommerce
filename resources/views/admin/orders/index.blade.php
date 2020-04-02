@extends("admin.layouts.master")

@section("page")
  View Orders
@endsection

@section("content")
  <div class="row">
    <div class="col-md-12">
      @include('admin.layouts.message')
      <div class="card">
        <div class="header">
          <h4 class="title">Orders</h4>
          <p class="category">List of all orders</p>
        </div>
        <div class="content table-responsive table-full-width">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>User</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($orders as $order)
                <tr>
                  <td>{{ $order->id }}</td>
                  <td>{{ $order->user->name }}</td>
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
                      @foreach($order->orderItems as $item)
                        <li class="list-group-item text-center">
                          {{ $item->quantity }}
                        </li>
                      @endforeach
                    </ul>
                  </td>
                  <td>
                    @if($order->status)
                      <span class="label label-success">Confirmed</span>
                    @else
                      <span class="label label-warning">Pending</span>
                    @endif
                  </td>
                  <td>
                    {{ link_to_route('orders.show', ' Details', $order->id, ['class' => 'btn btn-sm btn-primary ti-view-list-alt']) }}
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
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection
