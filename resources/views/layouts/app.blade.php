<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', '') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
      
        @yield('header')
      
        @include('layouts._flash_message')
        
        <main class="l-main">
          <div class="container mt-5">
            <div class="row justify-content-center">
              
              <div class="col-md-3 order-0">
                <div class="sticky-top pt-4">
                  <ul class="list-group">
                    <li class="list-group-item"><a href="#"><i class="fas fa-home mr-2"></i>Home</a></li><!-- /.list-group-item -->
                    <li class="list-group-item"><a href="#"><i class="fas fa-search mr-2"></i>Explore</a></li><!-- /.list-group-item -->
                    <li class="list-group-item"><a href="#"><i class="fas fa-user mr-2"></i>Profile</a></li><!-- /.list-group-item -->
                  </ul><!-- /.list-group -->
                </div><!-- /.sticky-top -->
                
              </div><!-- /.col-md-4 -->
  
              <div class="col-md-8">
                
                @yield('content')
              
              </div><!-- /.col-md-8 -->
  
            </div>
          </div><!-- /.container -->

        </main>

        @yield('footer')
    </div>
    @yield('script')
</body>
</html>
