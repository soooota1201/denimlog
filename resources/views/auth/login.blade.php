@extends('layouts.app')

@section('content')
<div class="login">
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-6">
              <div class="">
                  <h1 class="app-name text-center text-white">DENIM LOG</h1>
                  <p class="text-center login-title">{{ __('Login') }}</p>
  
                  <div class="">
                      <form method="POST" action="{{ route('login') }}">
                          @csrf
                          <div class="form-group">
                              {{-- <label for="email" class="col-form-label text-center text-white">{{ __('E-Mail Address') }}</label> --}}
  
                              <div class="">
                                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="メールアドレス" autofocus>
  
                                  @error('email')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>
  
                          <div class="form-group">
                              {{-- <label for="password" class="col-form-label text-center text-white">{{ __('Password') }}</label> --}}
  
                              <div class="">
                                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="パスワード" required autocomplete="current-password">
  
                                  @error('password')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>
  
                          <div class="form-group">
                              <div class="">
                                  <div class="form-check">
                                      <input class="form-check-input text-white" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
  
                                      <label class="form-check-label text-white" for="remember">
                                          {{ __('Remember Me') }}
                                      </label>
                                  </div>
                              </div>
                          </div>
  
                          <div class="form-group">
                              <div class="">
                                  <button type="submit" class="btn btn-primary btn-block">
                                      {{ __('Login') }}
                                  </button>
  
                                  @if (Route::has('password.request'))
                                      <a class="btn btn-link text-white" href="{{ route('password.request') }}">
                                          {{ __('Forgot Your Password?') }}
                                      </a>
                                  @endif
                              </div>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div><!-- /.login -->
@endsection
