@extends('front.layouts.master')

@section('content')
  <div class="row">
    <div class="col-md-12" id="register">
      <div class="card col-md-8 offset-md-2">
        <div class="card-body">
          <h2 class="card-title">Sign Up</h2>
          <hr>
          {{ Form::open(['route' => 'user.register', 'method' => 'post']) }}
            <div class="form-group">
              {{ Form::label('name', 'Name') }}
              @if($errors->has('name'))
                {{ Form::text('name', '', ['class' => 'form-control is-invalid', 'placeholder' => 'Name']) }}
                <span class="text-danger">{{ $errors->first('name') }}</span>
              @else
                {{ Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Name']) }}
              @endif
            </div>
            <div class="form-group">
              {{ Form::label('email', 'Email') }}
              @if($errors->has('email'))
                {{ Form::email('email', '', ['class' => 'form-control is-invalid', 'placeholder' => 'Email']) }}
                <span class="text-danger">{{ $errors->first('email') }}</span>
              @else
                {{ Form::email('email', '', ['class' => 'form-control', 'placeholder' => 'Email']) }}
              @endif
            </div>
            <div class="form-group">
              {{ Form::label('password', 'Password') }}
              @if($errors->has('password'))
                {{ Form::password('password', ['class' => 'form-control is-invalid', 'placeholder' => 'Password']) }}
                <span class="text-danger">{{ $errors->first('password') }}</span>
              @else
                {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) }}
              @endif
            </div>
            <div class="form-group">
              {{ Form::label('password_confirmation', 'Confirm Password') }}
              @if($errors->has('password'))
                {{ Form::password('password_confirmation', ['class' => 'form-control is-invalid', 'placeholder' => 'Confirm Password']) }}
                <span class="text-danger">{{ $errors->first('password') }}</span>
              @else
                {{ Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Confirm Password']) }}
              @endif
            </div>
            <div class="form-group">
              {{ Form::label('address', 'Address') }}
              @if($errors->has('address'))
                {{ Form::textarea('address', '', ['class' => 'form-control is-invalid', 'placeholder' => 'Address', 'cols' => '10', 'rows' => '5']) }}
                <span class="text-danger">{{ $errors->first('address') }}</span>
              @else
                {{ Form::textarea('address', '', ['class' => 'form-control', 'placeholder' => 'Address', 'cols' => '10', 'rows' => '5']) }}
              @endif
            </div>
            <div class="form-group">
              {{ Form::button('Sign Up', ['type' => 'submit', 'class' => 'btn btn-outline-info col-md-2']) }}
            </div>
          {{ Form::close() }}
        </div>
      </div>
    </div>
  </div>
@endsection