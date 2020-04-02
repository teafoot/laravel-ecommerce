@extends('front.layouts.master')

@section('content')
	<h2 class="text-center mt-3">Profile</h2>
	<hr>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th colspan="2">
					<h3 class="text-center">User Details</h3>
				</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th>ID</th>
				<td>{{ $user->id }}</td>
			</tr>
			<tr>
				<th>Name</th>
				<td>{{ $user->name }}</td>
			</tr>
			<tr>
				<th>Email</th>
				<td>{{ $user->email }}</td>
			</tr>
			<tr>
				<th>Registered At</th>
				<td>{{ $user->created_at->diffForHumans() }}</td>
			</tr>
			<tr>
				<th>Status</th>
				<td>
					@if($user->status)
            <span class="badge badge-success">Active</span>
          @else
            <span class="badge badge-danger">Blocked</span>
          @endif
				</td>
			</tr>
      <tr>
        <th>Actions</th>
        <td><a href="" class="btn btn-primary btn-sm"><i class="fa fa-cogs"></i> Edit User</a></td>
      </tr>
		</tbody>
	</table>
  <hr>
  @if($user->orders->count() > 0)
    <table class="table table-bordered">
      <thead>
      	<tr>
      		<th colspan="7">
      			<h3 class="text-center">Orders</h3>
      		</th>
      	</tr>
        <tr>
          <th>ID</th>
          <th>Product</th>
          <th>Quantity</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($user->orders as $order)
          <tr>
            <td>{{ $order->id }}</td>
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
                <span class="badge badge-success">Confirmed</span>
              @else
                <span class="badge badge-warning">Pending</span>
              @endif
            </td>
            <td>
            	<a href="{{ route('user.show_order', $order->id) }}" class="btn btn-outline-dark btn-sm">Details</a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @else
    <h4>You have 0 orders.</h4>
    <a href="{{ route('user.home') }}" class="btn btn-outline-dark">Continue Shopping</a>
  @endif
  <hr>
@endsection