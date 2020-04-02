<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Home</title>
    <!-- Bootstrap core CSS -->
    {{ Html::style("frontend/assets/vendor/bootstrap/css/bootstrap.min.css") }}
    {{ Html::style("http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css") }}
    <!-- Custom styles for this template -->
    {{ Html::style("frontend/assets/css/heroic-features.css") }}
    @yield('style')
  </head>
  <body>
    @include('front.layouts.nav')
    <!-- Page Content -->
    <div class="container">
      <!-- Page Features -->
      @yield('content')
    </div>
    <!-- /.container -->
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    @yield('script')
  </body>
</html>
