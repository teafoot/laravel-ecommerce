@extends('front.layouts.master')

@section('content')
	<div class="row">
	  <div class="col-md-12" id="register">
      @include("front.layouts.message")
    	@include('front.layouts.errors')
	    <div class="card col-md-8 offset-md-2">
	      <div class="card-body">
	        <h2 class="card-title">Login</h2>
	        <hr>
	        {{ Form::open(['route' => 'user.login', 'method' => 'post']) }}
            <div class="form-group">
              {{ Form::label('email', 'Email') }}
              @if($errors->has('email'))
              	{{ Form::email('email', '', ['class' => 'form-control is-invalid', 'placeholder' => 'Email']) }}
              @else
              	{{ Form::email('email', '', ['class' => 'form-control', 'placeholder' => 'Email']) }}
              @endif
            </div>
            <div class="form-group">
              {{ Form::label('password', 'Password') }}
              @if($errors->has('password'))
	              {{ Form::password('password', ['class' => 'form-control is-invalid', 'placeholder' => 'Password']) }}
              @else
              	{{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) }}
              @endif
            </div>
            <div class="form-group">
              {{ Form::button('Sign In', ['type' => 'submit', 'class' => 'btn btn-outline-info col-md-2']) }}
            </div>
          {{ Form::close() }}
	      </div>
	    </div>
	  </div>
	</div>
@endsection