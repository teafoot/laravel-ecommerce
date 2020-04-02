@extends('front.layouts.master')

@section("script")
  <script type="text/javascript">
    const quantities = document.querySelectorAll(".quantity");
    Array.from(quantities).forEach(function(element) {
      element.addEventListener('change', function() {
        const row_id = element.dataset.row_id;
        const product_id = element.dataset.product_id;
        const quantity = element.value;

        axios.put('/cart/${product_id}/update', {
          row_id,
          quantity
        }).then(function(response) {
          // console.log(response);
          location.reload();
        }).catch(function(error) {
          // console.log(error);
        });
      });
    });
  </script>
@endsection

@section('content')
  <!-- Page Content -->
  <h2 class="mt-5 text-center"><i class="fa fa-shopping-cart"></i> Shopping Cart</h2>
  <hr>
  @include("front.layouts.message")
  @include("front.layouts.error")
  @if(Cart::instance('default')->count() > 0)
    <h4 class="mt-5 text-center">{{ Cart::instance('default')->count() }} item(s) in Shopping Cart</h4>
    <div class="cart-items">
      <div class="row">
        <div class="col-md-12">
          <table class="table">
            <tbody>
              @foreach(Cart::instance('default')->content() as $item)
                <tr>
                  <td>
                    <strong>{{ $item->model->name }}</strong>
                    <br>
                    {{ $item->model->description }}
                  </td>
                  <td>
                    <input type="number" data-row_id="{{ $item->rowId }}" data-product_id="{{ $item->model->id }}" value="{{ $item->qty }}" class="form-control quantity" style="width: 4.7em" min="1" max="5" step="1">
                  </td>
                  <td>${{ $item->total() }}</td>
                  <td><img src="{{ url('/backend/uploads/' . $item->model->image) }}" style="width: 5em"></td>
                  <td>
                    {{ Form::open(['route' => ['user.cart.item.save_for_later', $item->rowId], 'method' => 'post']) }}
                      {{ Form::button('Save for later', ['type' => 'submit', 'class' => 'btn btn-info btn-sm text-white mb-1']) }}
                    {{ Form::close() }}
                    {{ Form::open(['route' => ['user.cart.item.remove', $item->rowId], 'method' => 'delete']) }}
                      {{ Form::button('Remove', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm']) }}
                    {{ Form::close() }}
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <!-- Price Details -->
        <div class="col-md-6 offset-md-3">
          <div class="sub-total">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th colspan="2" class="text-center">Price Details</th>
                </tr>
              </thead>
              <tbody>
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
              </tbody>
            </table>
          </div>
        </div>
        <div class="col-md-6 offset-md-3">
          <a href="{{ route('user.home') }}" class="btn btn-outline-dark pull-left">Continue Shopping</a>
          <a href="{{ route('user.checkout') }}" class="btn btn-outline-info pull-right">Proceed to checkout</a>
        </div>
      </div>
    </div>
  @else
    <h4>Your cart is empty.</h4>
    <a href="{{ route('user.home') }}" class="btn btn-outline-dark">Continue Shopping</a>
  @endif
  <hr>
  <!-- Save for later  -->
  @if(Cart::instance('saveForLater')->count() > 0)
    <div class="row">
      <div class="col-md-12">
        <h4 class="mt-5 text-center">{{ Cart::instance('saveForLater')->count() }} item(s) saved for Later</h4>
        <table class="table">
          <tbody>
            @foreach(Cart::instance('saveForLater')->content() as $item)
              <tr>
                <td>
                  <strong>{{ $item->model->name }}</strong>
                  <br>
                  {{ $item->model->description }}
                </td>
                <td>
                  <select name="" id="" class="form-control" style="width: 4.7em">
                    <option value="">1</option>
                    <option value="">2</option>
                  </select>
                </td>
                <td>${{ $item->total() }}</td>
                <td><img src="{{ url('/backend/uploads/' . $item->model->image) }}" style="width: 5em"></td>
                <td>
                  {{ Form::open(['route' => ['user.saved.item.move_to_cart', $item->rowId], 'method' => 'post']) }}
                    {{ Form::button('Move to cart', ['type' => 'submit', 'class' => 'btn btn-info btn-sm text-white mb-1']) }}
                  {{ Form::close() }}
                  {{ Form::open(['route' => ['user.saved.item.remove', $item->rowId], 'method' => 'delete']) }}
                    {{ Form::button('Remove', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm']) }}
                  {{ Form::close() }}
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  @else
    <h4>Your saved list is empty.</h4>
  @endif
  <hr>
@endsection