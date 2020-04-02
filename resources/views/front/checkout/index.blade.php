@extends('front.layouts.master')

@section('style')
	<style type="text/css">
		/* Stripe */

		/**
		 * The CSS shown here will not be introduced in the Quickstart guide, but shows
		 * how you can use CSS to style your Element's container.
		 */
		.StripeElement {
		  box-sizing: border-box;
		  height: 40px;
		  padding: 10px 12px;
		  border: 1px solid #ced4da;
		  border-radius: 4px;
		  background-color: white;
		}

		.StripeElement--focus {
		  box-shadow: 0 1px 3px 0 #cfd7df;
		}

		.StripeElement--invalid {
		  border-color: #fa755a;
		}

		.StripeElement--webkit-autofill {
		  background-color: #fefde5 !important;
		}
	</style>
@endsection

@section('script')
	<script src="https://js.stripe.com/v3/"></script>
	<script type="text/javascript">
		// Create a Stripe client.
		var stripe = Stripe('pk_test_HkLZ65SSBlQ8Uts4GLTxd0Uu00bQvcMfe9');

		// Create an instance of Elements.
		var elements = stripe.elements();

		// Custom styling can be passed to options when creating an Element.
		// (Note that this demo uses a wider set of styles than the guide below.)
		var style = {
		  base: {
		    color: '#32325d',
		    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
		    fontSmoothing: 'antialiased',
		    fontSize: '16px',
		    '::placeholder': {
		      color: '#aab7c4'
		    }
		  },
		  invalid: {
		    color: '#fa755a',
		    iconColor: '#fa755a'
		  }
		};

		// Create an instance of the card Element.
		var card = elements.create('card', {
			style: style,
			hidePostalCode: true // custom: stripe api
		});

		// Add an instance of the card Element into the `card-element` <div>.
		card.mount('#card-element');

		// Handle real-time validation errors from the card Element.
		card.addEventListener('change', function(event) {
		  var displayError = document.getElementById('card-errors');
		  if (event.error) {
		    displayError.textContent = event.error.message;
		  } else {
		    displayError.textContent = '';
		  }
		});

		// Handle form submission.
		var form = document.getElementById('payment-form');
		form.addEventListener('submit', function(event) {
		  event.preventDefault();

		  // custom: stripe-laravel
		  var options = {
		  	name: document.getElementById("name_card").value,
		  	address_line_1: document.getElementById("address").value,
		  	address_city: document.getElementById("city").value,
		  	address_state: document.getElementById("province").value,
		  	address_zip: document.getElementById("postal").value
		  };

		  stripe.createToken(card, options).then(function(result) {
		    if (result.error) {
		      // Inform the user if there was an error.
		      var errorElement = document.getElementById('card-errors');
		      errorElement.textContent = result.error.message;
		    } else {
		      // Send the token to your server.
		      stripeTokenHandler(result.token);
		    }
		  });
		});

		// Submit the form with the token ID.
		function stripeTokenHandler(token) {
		  // Insert the token ID into the form so it gets submitted to the server
		  var form = document.getElementById('payment-form');
		  var hiddenInput = document.createElement('input');
		  hiddenInput.setAttribute('type', 'hidden');
		  hiddenInput.setAttribute('name', 'stripeToken');
		  hiddenInput.setAttribute('value', token.id);
		  form.appendChild(hiddenInput);

		  // Submit the form
		  form.submit();
		}
	</script>
@endsection

@section('content')
	<h2 class="mt-5 text-center"><i class="fa fa-credit-card"></i> Checkout</h2>
	<hr>
	@include("front.layouts.message")
	@include("front.layouts.errors")
	@if(Cart::instance('default')->count() > 0)
		<div class="row">
		  <div class="col-md-7">
		    <h4 class="text-center"><i class="fa fa-address-card-o"></i> Billing Details</h4>
		    <hr>
		    {{ Form::open(['route' => 'user.checkout', 'method' => 'post', 'id' => 'payment-form']) }}
		      <div class="form-row">
		        <div class="form-group col-md-6">
		        	{{ Form::label('name', 'Name') }}
	    				{{ Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Name']) }}
		        </div>
		        <div class="form-group col-md-6">
		        	{{ Form::label('email', 'Email') }}
	    				{{ Form::email('email', '', ['class' => 'form-control', 'placeholder' => 'Email']) }}
		        </div>
		      </div>
		      <div class="form-group">
		      	{{ Form::label('address', 'Address') }}
	    			{{ Form::textarea('address', '', ['class' => 'form-control', 'placeholder' => '1234 Main St', 'cols' => '30', 'rows' => '5']) }}
		      </div>
		      <div class="form-row">
		        <div class="form-group col-md-5">
		        	{{ Form::label('city', 'City') }}
	    				{{ Form::text('city', '', ['class' => 'form-control', 'placeholder' => 'City']) }}
		        </div>
		        <div class="form-group col-md-4">
		        	{{ Form::label('province', 'Province') }}
	    				{{ Form::text('province', '', ['class' => 'form-control', 'placeholder' => 'Province']) }}
		        </div>
		        <div class="form-group col-md-3">
		        	{{ Form::label('postal', 'Postal') }}
	    				{{ Form::text('postal', '', ['class' => 'form-control', 'placeholder' => 'Postal']) }}
		        </div>
		      </div>
		      <div class="form-group">
		      	{{ Form::label('phone', 'Phone') }}
	  				{{ Form::text('phone', '', ['class' => 'form-control', 'placeholder' => 'Phone']) }}
		      </div>
	      	<hr>
		      <h5 class="text-center"><i class="fa fa-credit-card"></i> Payment Details</h5>
		      <hr>
		      <div class="form-group">
		      	{{ Form::label('name_card', 'Name on card') }}
	  				{{ Form::text('name_card', '', ['class' => 'form-control', 'placeholder' => 'Name on card']) }}
		      </div>
	        <div class="form-group">
				    <label for="card-element">Credit or debit card</label>
				    <div id="card-element"><!-- A Stripe Element will be inserted here. --></div>
				    <!-- Used to display form errors. -->
				    <div id="card-errors" role="alert"></div>
				  </div>
				  {{ Form::button('Complete Order', ['type' => 'submit', 'class' => 'btn btn-outline-info col-md-12']) }}
		    {{ Form::close() }}
		  </div>
		  <div class="col-md-5">
		    <h4 class="text-center"><i class="fa fa-shopping-cart"></i> Your Order</h4>
		    <hr>
		    <table class="table your-order-table">
		    	<thead>
			      <tr>
			        <th>Image</th>
			        <th>Details</th>
			        <th>Qty</th>
			      </tr>
		    	</thead>
		      @foreach(Cart::instance('default')->content() as $item)
			      <tr>
			        <td><img src="{{ url('/backend/uploads/' . $item->model->image) }}" style="width: 4em"></td>
			        <td>
			          <strong>{{ $item->model->name }}</strong>
			          <br>
			          {{ $item->model->description }}
			          <br> 
			          <span class="text-dark">${{ $item->total() }}</span>
			        </td>
			        <td>
			          <span class="badge badge-light">{{ $item->qty }}</span>
			        </td>
			      </tr>
			    @endforeach
		    </table>
		    <hr>
		    <table class="table your-order-table table-bordered">
		      <tr>
		        <th colspan="2" class="text-center">Price Details</th>
		      </tr>
		      <tr>
		        <td>Subtotal</td>
		        <td>${{ Cart::instance('default')->subtotal() }}</td>
		      </tr>
		      <tr>
		        <td>Tax</td>
		        <td>${{ Cart::instance('default')->tax() }}</td>
		      </tr>
		      <tr>
		        <th>Total</th>
		        <th>${{ Cart::instance('default')->total() }}</th>
		      </tr>
		    </table>
		    <hr>
		  </div>
		</div>
	@else
		<h4>Your cart is empty.</h4>
    <a href="{{ route('user.home') }}" class="btn btn-outline-dark">Continue Shopping</a>
	@endif
	<div class="mt-5">
    <hr>
  </div>
@endsection