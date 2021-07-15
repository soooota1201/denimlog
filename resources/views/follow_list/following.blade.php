@extends('layouts.app')

@section('header')
  @include('layouts.header') 
@endsection

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 pt-4">
          <h2>フォロー</h2>
            @if ($followingUsers->count() > 0)
              <table class="table">
                <tbody>
                  @foreach ($followingUsers as $user)
                  <tr>
                    <td><img width="40px" height="40px" style="border-radius: 50%;" src="{{ Gravatar::get($user->email) }}" alt=""></td>
                    <td>{{$user->name}}</td>
                    <td>
                      @if (Auth::id() != $user->id)
                        @if (!Auth::user()->is_following($user->id))
                          <form action="{{route('users.follow', $user->id)}}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">
                              follow
                            </button>
                          </form>
                        @else
                          <form action="{{route('users.unfollow', $user->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-success">
                              following
                            </button>
                          </form>
                        @endif 
                      @endif
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table><!-- /.table -->
            @else
            <h3 class="text-center">
              他のユーザーをフォローしましょう！
            </h3>
            @endif
        </div>
    </div>
</div>
@endsection
