<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <link rel="icon" type="image/png" sizes="96x96" href="{{ url('backend/assets/img/favicon.png') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>Peter's Shop Admin</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
    <meta name="viewport" content="width=device-width"/>
    {{ Html::style("backend/assets/css/bootstrap.min.css") }}
    {{ Html::style("backend/assets/css/animate.min.css") }}
    {{ Html::style("backend/assets/css/paper-dashboard.css") }}
    {{ Html::style("http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css") }}
    {{ Html::style("https://fonts.googleapis.com/css?family=Muli:400,300") }}
    {{ Html::style("backend/assets/css/themify-icons.css") }}
  </head>
  <body>
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">Peter's Shop Admin</a>
        </div>
      </div>
    </nav>
    <div class="wrapper">
      <div class="container" style="margin-top: 50px">
        <div class="row">
          <div class="col-md-8 col-md-offset-2">
            @include("admin.layouts.errors")
            @include("admin.layouts.message")
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title"><strong>Sign In</strong></h3>
              </div>
              <div class="panel-body">
                {{ Form::open(['route' => 'admin.login', 'method' => 'post']) }}
                  <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                    {{ Form::label('email', 'Email') }}
                    {{ Form::text('email', '', ['type' => 'email', 'class' => 'form-control border-input', 'placeholder' => 'Email']) }}
                    <span class="text-danger">{{ $errors->has('email') ? $errors->first('email') : '' }}</span>
                  </div>
                  <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                    {{ Form::label('password', 'Password') }}
                    {{ Form::password('password', ['class' => 'form-control border-input', 'placeholder' => 'Password']) }}
                    <span class="text-danger">{{ $errors->has('password') ? $errors->first('password') : '' }}</span>
                  </div>
                  <div class="form-group">
                    {{ Form::button('Sign In', ['type' => 'submit', 'class' => 'btn btn-primary']) }}
                  </div>
                {{ Form::close() }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    {{ Html::script("backend/assets/js/jquery-1.10.2.js") }}
    {{ Html::script("backend/assets/js/bootstrap.min.js") }}
  </body>
</html>
