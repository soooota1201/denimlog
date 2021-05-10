@extends('layouts.app')

@section('content')
<div class="login">
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-6 mt-5">
              <div class="">
                  <div class="">
                      @if (session('status'))
                          <div class="alert alert-success" role="alert">
                              {{ session('status') }}
                          </div>
                      @endif
  
                      <form method="POST" action="{{ route('password.email') }}">
                          @csrf
  
                          <div class="form-group row">
                              <label for="email" class="col-12 col-form-label textleft text-white">{{ __('E-Mail Address') }}</label>
  
                              <div class="col-12">
                                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
  
                                  @error('email')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>
  
                          <div class="form-group mb-0">
                              <div class="">
                                  <button type="submit" class="btn btn-primary btn-block text-white">
                                      {{ __('Send Password Reset Link') }}
                                  </button>
                              </div>
                          </div>
                      </form>

                      @guest
                        <div class="form-group mt-3">
                          <a class="text-white register-back" href="{{ route('login') }}">←{{ __('Login') }}ページへ戻る</a>
                        </div>
                      @endguest
                  </div>
              </div>
          </div>
      </div>
  </div>
</div><!-- /.login -->
@endsection
