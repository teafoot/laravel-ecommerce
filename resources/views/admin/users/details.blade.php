@extends("admin.layouts.master")

@section("page")
  View User
@endsection

@section("content")
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="header">
          <h4 class="title">{{ $user->name }}'s Orders Details</h4>
          <p class="category">Orders Details</p>
        </div>
        <div class="content table-responsive table-full-width">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Order ID</th>
                <th>Order Date</th>
                <th>Order Address</th>
                <th>Product Name</th>
                <th>Product Price</th>
                <th>Product Quantity</th>
                <th>Total Price</th>
                <th>Order Status</th>
              </tr>
            </thead>
            <tbody>
	            	@foreach($orders as $order)
              		<tr>
		                <td>{{ $order->id }}</td>
		                <td>{{ $order->date->diffForHumans() }}</td>
		                <td>{{ $order->address }}</td>
		                <td>
		                	<ul class="list-group">
				                @foreach($order->products as $product)
				                	<li class="list-group-item">{{ $product->name }}</li>
				                @endforeach
			                </ul>
			              </td>
			              <td>
			              	<ul class="list-group">
				                @foreach($order->products as $product)
				                	<li class="list-group-item">{{ $product->price }}</li>
				                @endforeach
			                </ul>
			              </td>
		                <td>
		                	<ul class="list-group">
		                		@foreach($order->orderItems as $order_item)
		                			<li class="list-group-item">{{ $order_item->quantity }}</li>
		                		@endforeach
		                	</ul>
		                </td>
		                <td>
		                	<ul class="list-group">
		                		@foreach($order->orderItems as $order_item)
		                			<li class="list-group-item">{{ $order_item->price }}</li>
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
              		</tr>
		            @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection