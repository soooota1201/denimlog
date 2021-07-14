@extends('layouts.login-layout')

@section('content')
<div class="login">
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-6 mt-5">
              <div class="">
                <h1 class="app-name text-center text-white">DENIM LOG</h1>
                <p class="text-center login-title">{{ __('Register') }}</p>
                  <div class="">
                      <form method="POST" action="{{ route('register') }}">
                          @csrf
  
                          <div class="form-group">
                              <div class="">
                                  <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="ユーザー名">
  
                                  @error('name')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>
  
                          <div class="form-group">
                              <div class="">
                                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="メールアドレス">
  
                                  @error('email')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>
  
                          <div class="form-group">
                              <div class="">
                                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="パスワード">
  
                                  @error('password')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>
  
                          <div class="form-group">
                              <div class="">
                                  <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password"　placeholder="確認用パスワード">
                              </div>
                          </div>
  
                          <div class="form-group mb-0">
                              <div class="">
                                  <button style="background: #F1AC56;"  type="submit" class="btn btn-block text-white">
                                      {{ __('Register') }}
                                  </button>
                              </div>
                          </div>

                          @guest
                            <div class="form-group mt-3">
                              <a class="text-white register-back" href="{{ route('login') }}">←{{ __('Login') }}ページへ戻る</a>
                            </div>
                          @endguest
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div><!-- /.login -->
@endsection
