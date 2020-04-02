@extends('front.layouts.master')

@section('content')
	<h2 class="text-center mt-3">User Order Details Page</h2>
	<hr>
  <a href="{{ route('user.profile') }}" class="btn btn-outline-success btn-sm" style="margin-bottom: 15px;">&laquo; Back to Profile</a>
  <hr>
	<div class="row">
    <div class="col-md-12">
      <table class="table table-bordered">
        <thead>
        	<tr>
        		<th colspan="6" class="text-center">
      				<h4>Product Details</h4>
        		</th>
        	</tr>
          <tr>
          	<th>Order ID</th>
            <th>Product Image</th>
	          <th>Product Name</th>
	          <th>Product Price</th>
            <th>Product Quantity</th>
            <th>Total Price</th>
          </tr>
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
      <hr>
    </div>
    <div class="col-md-12">
      <table class="table table-bordered">
        <thead>
        	<tr>
        		<th colspan="6" class="text-center">
      				<h4>Order Details</h4>
        		</th>
        	</tr>
          <tr>
            <th>Order ID</th>
            <th>Order Date</th>
            <th>Order Address</th>
            <th>Order Status</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>{{ $order->id }}</td>
            <td>{{ $order->date->diffForHumans() }}</td>
            <td>{{ $order->address }}</td>
            <td>
              @if($order->status)
                <span class="badge badge-success">Confirmed</span>
              @else
                <span class="badge badge-warning">Pending</span>
              @endif
            </td>
          </tr>
        </tbody>
      </table>
      <hr>
    </div>
  </div>
@endsection