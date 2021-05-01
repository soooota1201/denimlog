@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="mb-4">
              
              <h2>ユーザープロフィール画面</h2>
              <span>
                following {{$user->followings()->count()}}
              </span>
              <span>
                follower {{$user->followers()->count()}}
              </span>
              
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
              <p>user_name : {{$user->name}}</p>
              <figure><img src="{{$user->thumbnail_image_path}}" alt=""></figure>
              <p><span class="mr-4">身長：{{$user->height}}cm</span><span>体重：{{$user->weight}}kg</span></p>
              <p>{{$user->user_profile}}</p>
            </div>
            <div class="mb-5">
              <a href="{{route('users.edit', $user->id)}}" class="btn btn-lg btn-block  btn-outline-dark mt4">プロフィールを編集する</a>
            </div>
            
            @foreach ($denims as $denim)
              <a href="{{route('users.denims.show', [$user->id, $denim->id])}}" class="card mb-3" style="">
                <div class="row no-gutters">
                  <div class="col-md-4">
                    <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Image"><title>Placeholder</title><rect fill="#868e96" width="100%" height="100%"/><text fill="#dee2e6" dy=".3em" x="50%" y="50%">Image</text></svg>
                  </div>
                  <div class="col-md-8">
                    <div class="card-body">
                      <h5 class="card-title">{{$denim->bland_type}}</h5>
                      <p class="card-text">ウエスト：{{$denim->waist}}インチ</p>
                      <p class="card-text">履き込み回数：{{$denim->wearing_count}}回</p>
                    </div>
                  </div>
                </div>
              </a>
            @endforeach

            <div class="mb-5">
              <a href="{{route('users.denims.index', Auth::id())}}" class="btn btn-lg btn-block  btn-outline-dark mt4">デニム一覧へ</a>
            </div>

            @foreach ($records as $record)
              <div class="row justify-content-center mt-4">
                <a href="{{route('users.records.show', [$user->id, $denim->id, $record->id])}}" class="col-md-8">
                  <div class="card">
                    <svg class="bd-placeholder-img card-img-top" width="100%" height="450px"  xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Image cap"><title>Placeholder</title><rect fill="#868e96" width="100%" height="100%"/><text fill="#dee2e6" dy=".3em" x="50%" y="50%">Image cap</text></svg>
                    <div class="card-body">
                      <h6 class="card-subtitle mb-2 text-muted">{{$record->wearing_day}}</h6>
                      <h6 class="card-subtitle mb-2 text-muted">{{$record->wearing_place}}</h6>
                      <p class="card-text">{{$record->body}}</p>
                    </div>
                  </div>
                </a>
              </div>
            @endforeach

        </div>
    </div>
</div>
@endsection
