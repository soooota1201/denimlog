@extends('layouts.app')

@section('header')
  @include('layouts.header')
@endsection

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 mb-5">
            <div class="mb-2">
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
                  @if (isset($user->height) || isset($user->weight))
                  <p class="profile-data">
                    <span class="mr-2">
                        @if (isset($user->height))
                            ?????????{{$user->height}}cm
                        @endif
                    </span>
                    <span>
                        @if (isset($user->weight))
                            ?????????{{$user->weight}}kg</span>
                        @endif
                    </p>
                @endif
                <p class="profile-follow">
                    <a href="{{route('users.followed.user.index', $user->id)}}" class="mr-2">
                        following {{$user->followers()->count()}}
                    </a>
                    <a href="{{route('users.following.user.index', $user->id)}}">
                        follower {{$user->followings()->count()}}
                    </a>
                </p>
                <p class="profile-text mt-2">{{$user->user_profile}}</p>
                {{-- <a href="{{route('users.edit', $user->id)}}" class="btn btn-lg btn-block btn-outline-dark profile-edit">?????????????????????????????????</a> --}}
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
                    <p class="mt-4">??????????????????????????????????????????????????????</p>
                    <br>
                    @if (Auth::id() === $user->id)
                      <a href="{{route('users.denims.create', $user->id)}}" class="btn text-white profile-denim-btn">????????????<i class="fas fa-chevron-right ml-2"></i></a>
                  </div><!-- /.mt-3 -->
                  @endif
                @endif
                @if (!$denims->count() == 0 && $records->count() == 0)
                  <div class="mt-4">
                    <p>?????????????????????????????????????????????????????????</p>
                    <br>
                    @if (Auth::id() === $user->id)
                      <a href="{{route('users.denims.index', $user->id)}}" class="btn text-white profile-denim-btn">??????????????????<i class="fas fa-chevron-right ml-2"></i></a>
                    @endif
                  </div><!-- /.mt-3 -->
                @endif
                {{-- ???????????? --}}
                @if (!$denims->count() == 0 && !$records->count() == 0)
                  <div class="container mt-4">
                    @foreach ($records as $record)
                      <div class="row justify-content-center">
                        <div class="card p-record col-12 mb-4">
                          <a href="{{route('users.show', $record->user->id)}}" class="p-record-user_name">{{$record->user->name}}</a>
                          @if (!$record->denimRecordImages->isEmpty())
                          <a href="{{route('users.records.show', [$user->id, $record->denim_id, $record->id])}}" class="c-img--wrapper">
                            <img class="bd-placeholder-img c-img" src="{{$record->denimRecordImages[0]->cloud_record_image_path}}" alt="">
                          </a>
                          @endif
                          <div class="card-body p-record-body">
                            {{-- <div>
                              @if($record->is_liked_by_auth_user())
                                <a href="{{ route('reply.unlike', $record->id) }}" class="btn btn-success btn-sm">?????????<span class="badge">{{ $record->likes->count() }}</span></a>
                              @else
                                <a href="{{ route('reply.like', $record->id) }}" class="btn btn-secondary btn-sm">?????????<span class="badge">{{ $record->likes->count() }}</span></a>
                              @endif
                            </div> --}}
                            <div>
                              {{-- likecomponent --}}
                              <like-component
                              :record="{{ json_encode($record)}}"
                              ></like-component>
                              {{-- likecomponent --}}
                            </div>
                            <a href="{{route('users.show', $record->user->id)}}" class="p-record-user_name">{{$record->user->name}}</a>
                            <p class="card-text p-record-text">{{$record->body}}</p>
                            <p class="mt-3 p-record-date">????????????{{$record->wearing_day}}</p>
                            <p class="p-record-place">????????????{{$record->wearing_place}}</p>
                          </div>
                        </div>
                      </div>
                    @endforeach
                  </div><!-- /.container -->
                @endif
              </div>
              <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                @if (!$denims->count() == 0)
                <div class="d-flex justify-content-end align-items-center mt-3">
                    <a href="{{route('users.denims.index', $user->id)}}" class="btn btn-outline-dark mr-2">??????????????????<i class="fas fa-chevron-right ml-2"></i></a>
                    @if (Auth::id() === $user->id)
                      <a href="{{route('users.denims.create', $user->id)}}" class="btn text-white profile-denim-btn">????????????<i class="fas fa-chevron-right ml-2"></i></a>
                    @endif
                  </div><!-- /.d-flex -->
                @endif
                <div class="mt-3">
                  @if (!$denims->count() == 0) {{-- ??????????????????????????????????????? --}}
                    @foreach ($denims as $denim)
                      <a href="{{route('users.denims.show', [$user->id, $denim->id])}}" class="card mb-3 p-denimCard" style="">
                        <div class="row no-gutters">
                          <div class="col-4">
                            @if (!$denim->denimImages->isEmpty())
                            <img style="width: 100%; height: 120px; object-fit: cover;" src="{{$denim->denimImages[0]->cloud_image_path}}" alt="">
                            @endif
                          </div>
                          <div class="col-8">
                            <div class="card-body">
                              <h5 class="card-title">{{$denim->bland_type}}</h5>
                              <p class="card-text">???????????????{{$denim->waist}}?????????</p>
                              <p class="card-text">?????????????????????{{$denim->wearing_count}}???</p>
                            </div>
                          </div>
                        </div>
                      </a>
                    @endforeach
                  @else {{-- ?????????????????????????????????????????? --}}
                    <p class="mt-4">??????????????????????????????????????????????????????</p>
                    <br>
                    @if (Auth::id() === $user->id)
                      <a href="{{route('users.denims.create', $user->id)}}" class="btn text-white profile-denim-btn">????????????<i class="fas fa-chevron-right ml-2"></i></a>
                    @endif
                    <br>
                  @endif
                </div>
              </div>
              <div class="tab-pane fade" id="allVisitedPlaces" role="tabpanel" aria-labelledby="allVisitedPlaces-tab">
                    @if ($denims->count() == 0)
                        <div class="mt-3">
                            <p class="mt-4">??????????????????????????????????????????????????????</p>
                            <br>
                            @if (Auth::id() === $user->id)
                            <a href="{{route('users.denims.create', $user->id)}}" class="btn text-white profile-denim-btn">????????????<i class="fas fa-chevron-right ml-2"></i></a>
                            @endif
                        </div><!-- /.mt-3 -->
                    @else
                        <div class="mt-3" id="map" style="height: 500px"></div>
                    @endif
              </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('script')
  <script>
    function initAllMap() {
      var addresses = @json($wearing_places);

      var latlng = []; //??????????????????????????????
      var marker = []; //???????????????????????????????????????
      var myLatLng; //?????????????????????????????????
      var geocoder;
      geocoder = new google.maps.Geocoder();

      var map = new google.maps.Map(document.getElementById('map'));//?????????????????????

      function geo(callback){
        var cRef = addresses.length;
        for (var i = 0; i < addresses.length; i++) {
          (function (i) {
            geocoder.geocode({'address': addresses[i]},
              function(results, status) { // ??????
                if (status === google.maps.GeocoderStatus.OK) { // ??????????????????OK?????????
                  latlng[i]=results[0].geometry.location;// ??????????????????????????????????????????
                  marker[i] = new google.maps.Marker({
                    position: results[0].geometry.location, // ???????????????????????????????????????
                    map: map // ???????????????????????????????????????
                  });
                } else { // ??????????????????
                }//if???????????????if???????????????;???????????????
                if (--cRef <= 0) {
                  callback();//????????????????????????aftergeo??????
                }
              }//function(results, status)?????????
            );//geocoder.geocode?????????
          }) (i);
        }//for????????????
      }//function geo??????

      geo(aftergeo);

      function aftergeo(){
        myLatLng = latlng[0];//?????????????????????????????????????????????
        var opt = {
          center: myLatLng, // ????????????????????????
          zoom: 16 // ???????????????????????????
        };//???????????????????????????????????????center???zoom?????????
        map.setOptions(opt);//??????????????????map????????????
      }//function aftergeo??????
  };
  </script>
  <script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google-map.apikey') }}&callback=initAllMap" defer></script>
@endsection
