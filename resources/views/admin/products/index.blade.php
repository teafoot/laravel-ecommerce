@extends("admin.layouts.master")

@section("page")
    View Products
@endsection

@section("content")
	<div class="row">
	    <div class="col-md-12">
	    		@include("admin.layouts.message")
	        <div class="card">
	            <div class="header">
	                <h4 class="title">All Products</h4>
	                <p class="category">List of all stock</p>
	            </div>
	            <div class="content table-responsive table-full-width">
	            		@if (count($products) > 0)
		                <table class="table table-striped">
		                    <thead>
			                    <tr>
			                        <th>ID</th>
			                        <th>Name</th>
			                        <th>Price</th>
			                        <th>Description</th>
			                        <th>Image</th>
			                        <th>Actions</th>
			                    </tr>
		                    </thead>
		                    <tbody>
		                    	@foreach($products as $product)
				                    <tr>
				                        <td>{{ $product->id }}</td>
				                        <td>{{ $product->name }}</td>
				                        <td>${{ $product->price }}</td>
				                        <td>{{ $product->description }}</td>
				                        <td>
				                        	@if (isset($product) && $product->image != '')
				                        		<img src="{{ url('/backend/uploads/' . $product->image) }}" alt="{{ $product->image }}" class="img-thumbnail" style="width: 80px;">
				                        	@else
				                        		No image
				                        	@endif
				                        </td>
				                        <td>
				                            {{ link_to_route('products.show', '', $product->id, ['class' => 'btn btn-sm btn-primary ti-view-list-alt', 'title' => 'Details']) }}
				                            {{ link_to_route('products.edit', '', $product->id, ['class' => 'btn btn-sm btn-info ti-pencil-alt', 'title' => 'Edit']) }}
				                        		{{ Form::open(['route' => ['products.destroy', $product->id], 'method' => 'DELETE']) }}
				                        			{{ Form::button('<span class="ti-trash"></span>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'title' => 'Delete', 'onclick' => 'return confirm("Are you sure you want to delete it?")']) }}
																		{{ Form::close() }}
				                        </td>
				                    </tr>
		                    	@endforeach
		                    </tbody>
		                </table>
		              @else
		              	<p>No products available</p>
		              @endif
	            </div>
	        </div>
	    </div>
	</div>
@endsection