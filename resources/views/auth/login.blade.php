<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <!-- <meta name="csrf-token" content="{{ csrf_token() }}"> -->

    <title>Login Panel</title>

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<!-- Bootstrap 3.3.7 -->
{!!Html::style('public/custom/css/bootstrap.min.css')!!}
<!-- Font Awesome -->
{!!Html::style('public/custom/css_icon/font-awesome/css/font-awesome.min.css')!!}
<!-- Ionicons -->
{!!Html::style('public/custom/css_icon/Ionicons/css/ionicons.min.css')!!}
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
<!-- Google Font -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
<link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900'>
<link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Montserrat:400,700'>
{!!Html::style('public/custom/css/login.css')!!}
<!-- jQuery 3 -->
{!!Html::script('public/custom/js/plugins/jquery/dist/jquery.min.js')!!}
<!-- Bootstrap 3.3.7 -->
{!!Html::script('public/custom/js/plugins/bootstrap/dist/js/bootstrap.min.js')!!}
</head>
<body>
<div class="container">
  @include('common.message')
  <div class="info">
    <h1> Login Panel</h1>
  </div>
</div>
<div class="form">
  <div class="image_holder"></div>
  
    @if(Session::get('error'))
      <div class="custom-alerts alert alert-danger fade in">
        <ul style="list-style-type:none">
          <li><i class="fa fa-check-circle-o" aria-hidden="true"></i> {{ Session::get('error') }}</li>
          <?php Session::put('error', NULL); ?>
        </ul>
      </div>
    @elseif ($errors->has('email'))
      <div class="custom-alerts alert alert-danger fade in"> <strong>{{ $errors->first('email') }}</strong> </div>
    @endif
    @include('common.message')

  <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
     {{ csrf_field() }}
    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus placeholder="Email">
    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Password">
    <!-- <input id="password" type="password" name="password" placeholder="Password" required> -->
    <button type="submit" class="btn btn-primary"><i class="fa fa-user"></i> Log in</button>
    <p class="message"><a href="javascript:;" data-toggle="modal" data-target="#forgotPassword">Forget password ?</a></p>
    
  </form>

</div>

</body>
</html>

