<header>
  <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm l-header">
      <div class="container">
          <a class="navbar-brand text-white header-logo" href="/users">
              {{ config('app.name', '') }}
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
              <span class="navbar-toggler-icon"></span>
          </button>
  
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <!-- Left Side Of Navbar -->
              <ul class="navbar-nav mr-auto">
  
              </ul>
  
              <!-- Right Side Of Navbar -->
              <ul class="navbar-nav ml-auto">
                  <!-- Authentication Links -->
                  @guest
                      <li class="nav-item">
                          <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                      </li>
                  @else
                      <form class="input-group mr-3" action="{{url('/search/records')}}" method="GET">
                        <input type="text" class="form-control" name="record" placeholder="他ユーザーの記録を検索" value="{{ request()->query('record') }}">
                      </form>
                      <li class="nav-item dropdown">
                          <a id="navbarDropdown" class="nav-link dropdown-toggle text-white font-weight-bold" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                              {{ Auth::user()->name }} <span class="caret"></span>
                          </a>
                          {{-- {{dd($user->id)}} --}}
  
                          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                              @if (Auth::id() == $user->id)
                                <a class="dropdown-item" href="{{route('users.show', $user->id)}}">プロフィール</a>
                              @endif
                              @if (Auth::id() == $user->id)
                                <a class="dropdown-item" href="{{route('users.denims.index', $user->id)}}">デニム一覧</a>
                              @endif
                              
                              <a class="dropdown-item" href="{{ route('logout') }}"
                                  onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                  {{ __('Logout') }}
                              </a>
  
                              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                  @csrf
                              </form>
                          </div>
                      </li>
                  @endguest
              </ul>
          </div>
      </div>
  </nav>
</header>