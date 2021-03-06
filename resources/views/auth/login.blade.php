@extends('auth.app')
@section('content')
<div class="login-box">
    <div class="login-logo">
      <a href="{{route('home')}}">
        <img src="{{asset('assets/images/logo/logo.png')}}" height="50">
      </a>
    </div>
    <div class="card card-outline card-primary">
      <div class="card-header">
        <h3 class="card-title float-none text-center">
          Sign in to start your session </h3>
      </div>
      <div class="card-body login-card-body">
        <form action="{{route('login')}}" method="post">
          @csrf
          <div class="input-group mb-3">
            <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{old('username')}}" placeholder="Username" autofocus>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
            @error('username')
            <div class="invalid-feedback">
                <strong>{{$message}}</strong>
            </div>
            @enderror
          </div>
          <div class="input-group mb-3">
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
            @error('password')
            <div class="invalid-feedback">
                <strong>{{$message}}</strong>
            </div>
            @enderror
          </div>
          <div class="row">
            <div class="col-7">
              <div class="icheck-primary">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Remember Me</label>
              </div>
            </div>
            <div class="col-5">
              <button type=submit class="btn btn-block btn-flat btn-primary">
                <span class="fas fa-sign-in-alt"></span>
                Sign In
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
</div>
@endsection