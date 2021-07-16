@extends('layouts.app')

@section('header')
  @include('layouts.header') 
@endsection

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="mb-5">
              {{-- @if (Auth::id() != $user->id)
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
              @endif --}}
              <div class="row justify-content-between align-items-center">
                @if (empty($user->thumbnail_image_path))
                  <figure class="col-md-4 col-4 profile-img--wrapper"><img class="profile-img" src="{{Gravatar::src($user->email)}}" alt=""></figure>  
                @else
                  <figure class="col-md-4 col-4 profile-img--wrapper"><img class="profile-img" src="{{$user->thumbnail_image_path}}" alt=""></figure>
                @endif
                <div class="col-8">
                  <p class="profile-name">{{$user->name}}</p>
                  @if (Auth::id() != $user->id)
                    {{-- followcomponent --}}
                    <follow-component
                    :user="{{ json_encode($user)}}"
                    ></follow-component>
                    {{-- followcomponent --}}
                  @endif
                  <p class=" profile-data"><span class="mr-2">身長：{{$user->height}}cm</span><span>体重：{{$user->weight}}kg</span></p>
                  <p>
                    <a href="{{route('users.following.user.index', $user->id)}}">
                      following {{$user->followings()->count()}}
                    </a>
                    <a href="{{route('users.followed.user.index', $user->id)}}">
                      follower {{$user->followers()->count()}}
                    </a>
                  </p>
                  <p class="profile-text mt-2">{{$user->user_profile}}</p>
                  {{-- <a href="{{route('users.edit', $user->id)}}" class="btn btn-lg btn-block btn-outline-dark profile-edit">プロフィールを編集する</a> --}}
                </div>
              </div>
            </div>

            <vuejs-heatmap
            :entries="{{$wearing_days}}"
            :tooltip-enabled="true"
            {{-- :tooltip-unit="Star" --}}
            :locale="{months: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            days: ['S', 'M', 'T', 'W', 'T', 'F', 'S']}"
            :max="700"
            ></vuejs-heatmap>

            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Record</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Your Denim</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="allVisitedPlaces-tab" data-toggle="tab" href="#allVisitedPlaces" role="tab" aria-controls="allVisitedPlaces" aria-selected="false">All Visited Places</a>
              </li>
              
            </ul>
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                @if ($denims->count() == 0)
                  <div class="mt-3">
                    <p>お気に入りのデニムを登録しましょう！</p>
                    <br>
                    @if (Auth::id() === $user->id)
                      <a href="{{route('users.denims.create', $user->id)}}" class="btn text-white profile-denim-btn">登録する<i class="fas fa-chevron-right ml-2"></i></a>
                  </div><!-- /.mt-3 -->
                  @endif
                @endif
                @if (!$denims->count() == 0 && $records->count() == 0)
                  <div class="mt-3">
                    <p>登録したデニムの成長を記録しましょう！</p>
                    <br>
                    @if (Auth::id() === $user->id)
                      <a href="{{route('users.denims.index', $user->id)}}" class="btn text-white profile-denim-btn">デニム一覧へ<i class="fas fa-chevron-right ml-2"></i></a>
                    @endif
                  </div><!-- /.mt-3 -->
                @endif
                {{-- 記録一覧 --}}
                @if (!$denims->count() == 0 && !$records->count() == 0)
                  <div class="container mt-3">
                    @foreach ($records as $record)
                      <div class="row justify-content-center">
                        <div class="card record-card col-12 mb-4">
                          <p class="record-card-user_name">{{$record->user->name}}</p>
                          @if (!$record->denimRecordImages->isEmpty())
                          <a href="{{route('users.records.show', [$user->id, $record->denim_id, $record->id])}}" class="record-card-img--wrapper">
                            <img class="bd-placeholder-img record-card-img" src="{{$record->denimRecordImages[0]->cloud_record_image_path}}" alt="">
                          </a>
                          @endif
                          <div class="card-body record-card-body">
                            {{-- <div>
                              @if($record->is_liked_by_auth_user())
                                <a href="{{ route('reply.unlike', $record->id) }}" class="btn btn-success btn-sm">いいね<span class="badge">{{ $record->likes->count() }}</span></a>
                              @else
                                <a href="{{ route('reply.like', $record->id) }}" class="btn btn-secondary btn-sm">いいね<span class="badge">{{ $record->likes->count() }}</span></a>
                              @endif
                            </div> --}}
                            <div>
                              {{-- likecomponent --}}
                              <like-component
                              :record="{{ json_encode($record)}}"
                              ></like-component>
                              {{-- likecomponent --}}
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
              <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                @if (!$denims->count() == 0)
                <div class="d-flex justify-content-between align-items-center mt-3">
                  <p class="profile-denim">デニム一覧</p>
                    @if (Auth::id() === $user->id)
                      <a href="{{route('users.denims.create', $user->id)}}" class="btn text-white profile-denim-btn">登録する<i class="fas fa-chevron-right ml-2"></i></a>
                    @endif
                  </div><!-- /.d-flex -->
                @endif
                <div class="mt-3">
                  @if (!$denims->count() == 0) {{-- デニムが登録されている場合 --}}
                    @foreach ($denims as $denim)
                      <a href="{{route('users.denims.show', [$user->id, $denim->id])}}" class="card mb-3" style="">
                        <div class="row no-gutters">
                          <div class="col-4">
                            @if (!$denim->denimImages->isEmpty())
                            <img style="width: 100%; height: 120px; object-fit: cover;" src="{{$denim->denimImages[0]->cloud_image_path}}" alt="">
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
                      <a href="{{route('users.denims.index', $user->id)}}" class="btn btn-outline-dark mt4">デニム一覧へ<i class="fas fa-chevron-right ml-2"></i></a>
                    </div>
                  @else {{-- デニムが登録されていない場合 --}}
                    <p>お気に入りのデニムを登録しましょう！</p>
                    <br>
                    @if (Auth::id() === $user->id)
                      <a href="{{route('users.denims.create', $user->id)}}" class="btn text-white profile-denim-btn">登録する<i class="fas fa-chevron-right ml-2"></i></a>
                    @endif
                    <br>
                  @endif
                </div>
              </div>
              <div class="tab-pane fade" id="allVisitedPlaces" role="tabpanel" aria-labelledby="allVisitedPlaces-tab">
                
              </div>
            </div>
            
        </div>
    </div>
</div>
@endsection

@section('script')
    
@endsection
