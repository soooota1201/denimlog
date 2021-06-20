@extends('layouts.app')

@section('header')
  @include('layouts.header') 
@endsection

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="mb-5">
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
              <div class="row justify-content-between align-items-center">
                <figure class="col-md-4 col-4 profile-img--wrapper"><img class="profile-img" src="{{$user->thumbnail_image_path}}" alt=""></figure>
                <div class="col-8">
                  <p class="profile-name">{{$user->name}}</p>
                  <p class=" profile-data"><span class="mr-2">身長：{{$user->height}}cm</span><span>体重：{{$user->weight}}kg</span></p>
                  <p>
                    <span>
                      following {{$user->followings()->count()}}
                    </span>
                    <span>
                      follower {{$user->followers()->count()}}
                    </span>
                  </p>
                  <p class="profile-text mt-2">{{$user->user_profile}}</p>
                  <a href="{{route('users.edit', $user->id)}}" class="btn btn-lg btn-block btn-outline-dark profile-edit">プロフィールを編集する</a>
                </div>
              </div>
            </div>

            <vuejs-heatmap
            :entries="[{'counting': 500,'created_at': '2021-03-21'},{'counting': 500,'created_at': '2021-05-20'}]" 
            :color-range="['#c9ecec', '#09b3af']"
            :tooltip-enabled="true"
            :tooltip-unit="Star"
            :locale="{months: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            days: ['S', 'M', 'T', 'W', 'T', 'F', 'S']}"
            :on-click=test
            ></vuejs-heatmap>

            {{-- @include('users.calendar') --}}

            <div class="d-flex justify-content-between align-items-center mb-3">
              <p class="profile-denim">デニム一覧</p>
              @if (!$denims->count() == 0)
                @if (Auth::id() === $user->id)
                  <a href="{{route('users.denims.create', $user->id)}}" class="btn text-white profile-denim-btn">登録する<i class="fas fa-chevron-right ml-2"></i></a>
                @endif
              @endif
            </div><!-- /.d-flex -->

            {{-- {{dd($denims->count())}} --}}
            @if (!$denims->count() == 0)
              @foreach ($denims as $denim)
                <a href="{{route('users.denims.show', [$user->id, $denim->id])}}" class="card mb-3" style="">
                  <div class="row no-gutters">
                    <div class="col-4">
                      @if (!$denim->denimImages->isEmpty())
                      <img src="{{$denim->denimImages[0]->cloud_image_path}}" alt="">
                      @endif
                    </div>
                    <div class="col-8">
                      <div class="card-body">
                        <h5 class="card-title">{{$denim->bland_type}}</h5>
                        <p class="card-text">ウエスト：{{$denim->waist}}インチ</p>
                        <p class="card-text">履き込み回数：{{$denim->wearing_count}}回</p>
                      </div>
                    </div>
                  </div>
                </a>
              @endforeach
              <div class="mb-5 text-center">
                <a href="{{route('users.denims.index', Auth::id())}}" class="btn btn-outline-dark mt4">デニム一覧へ<i class="fas fa-chevron-right ml-2"></i></a>
              </div>
            @else
              <p>お気に入りのデニムを登録しましょう！</p>
              <br>
              @if (Auth::id() === $user->id)
              <a href="{{route('users.denims.create', $user->id)}}" class="btn text-white profile-denim-btn">登録する<i class="fas fa-chevron-right ml-2"></i></a>
              @endif
              <br>
            @endif
            
            @if (!$denims->count() == 0 && !$records->count() == 0)
              <div class="mb-3">
                <p class="profile-denim">記録一覧</p>  
              </div>
              <div class="container">
                @foreach ($records as $record)
                  <div class="row justify-content-center">
                    <div class="card record-card col-12 mb-4">
                      <p class="record-card-user_name">{{$record->user->name}}</p>
                      @if (!$record->denimRecordImages->isEmpty())
                      <a href="{{route('users.records.show', [$user->id, $denim->id, $record->id])}}" class="record-card-img--wrapper">
                        <img class="bd-placeholder-img record-card-img" src="{{$record->denimRecordImages[0]->cloud_record_image_path}}" alt="">
                      </a>
                      @endif
                      <div class="card-body record-card-body">
                        <div>
                          @if($record->is_liked_by_auth_user())
                            <a href="{{ route('reply.unlike', $record->id) }}" class="btn btn-success btn-sm">いいね<span class="badge">{{ $record->likes->count() }}</span></a>
                          @else
                            <a href="{{ route('reply.like', $record->id) }}" class="btn btn-secondary btn-sm">いいね<span class="badge">{{ $record->likes->count() }}</span></a>
                          @endif
                        </div>
                        <p class="record-card-user_name">{{$record->user->name}}</p>
                        <p class="card-text record-card-text">{{$record->body}}</p>
                        <p class="mt-3 record-card-date">記録日：{{$record->wearing_day}}</p>
                        <p class="record-card-place">履き込み地：{{$record->wearing_place}}</p>
                      </div>
                    </div>
                  </div>
                @endforeach
              </div><!-- /.container -->
            @endif
        </div>
    </div>
</div>
@endsection
