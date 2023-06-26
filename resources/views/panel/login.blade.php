<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{__('Login Page')}}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('panel/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{asset('panel/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('panel/dist/css/adminlte.min.css')}}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
        {{--<div class="card-header text-center">
            <a href="../../index2.html" class="h1"><b>Admin</b>LTE</a>
        </div>--}}
        <div class="card-body">
            <p class="login-box-msg">{{__('Sign in')}}</p>

            <form action="{{route('login')}}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="email" name="email" value="{{old('email')}}" class="form-control" placeholder="{{__('Email')}}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    @if(Session::has('user_not_found'))
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{!! Session('user_not_found') !!}</strong>
                        </span>
                    @endif
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="{{__('Password')}}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @if(Session::has('incorrect_password'))
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{!! Session('incorrect_password') !!}</strong>
                        </span>
                    @endif
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember">
                            <label for="remember">{{__('Remember Me')}}</label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">{{__('Sign In')}}</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

        {{--<div class="social-auth-links text-center mt-2 mb-3">
            <a href="#" class="btn btn-block btn-primary">
                <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
            </a>
            <a href="#" class="btn btn-block btn-danger">
                <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
            </a>
        </div>--}}
        <!-- /.social-auth-links -->

            {{--<p class="mb-1">
                <a href="forgot-password.html">I forgot my password</a>
            </p>--}}
            <p class="mb-0">
                <a href="{{route('register.form')}}" class="text-center">{{__('Dont have an account? Register')}}</a>
            </p>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{asset('panel/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('panel/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('panel/dist/js/adminlte.min.js')}}"></script>
</body>
</html>
