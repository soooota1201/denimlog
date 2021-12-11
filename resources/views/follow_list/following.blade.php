@extends('layouts.app')

@section('header')
  @include('layouts.header')
@endsection

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 pt-4">
          <h2>Follower</h2>
            @if ($followingUsers->count() > 0)
              <table class="table">
                <tbody>
                  @foreach ($followingUsers as $user)
                  <tr>
                    <td><img width="40px" height="40px" style="border-radius: 50%;" src="{{ Gravatar::get($user->email) }}" alt=""></td>
                    <td>{{$user->name}}</td>
                    <td>
                      @if (Auth::id() != $user->id)
                        <follow-component
                        :user="{{ json_encode($user)}}"
                        ></follow-component>
                        {{-- followcomponent --}}
                      @endif
                    </td>
                    <td>
                        <a href="{{route('chat', $user->id)}}"><button class="btn btn-primary">DM</button></a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table><!-- /.table -->
            @else
            <h3 class="text-center">
              まだフォローされていません。
            </h3>
            @endif
        </div>
    </div>
</div>
@endsection
