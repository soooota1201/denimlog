@extends('layouts.app')

@section('header')
  @include('layouts.header') 
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="d-flex justify-content-between mb-3">
            <h2>{{$denim->bland_type}}</h2>
          </div>

          <div class="row mb-3">
            <div class="col-md-5">
              @if (!$denim->denimImages->isEmpty())
                <figure class="denim-img--wrapper">
                  <img src="{{$denim->denimImages[0]->cloud_image_path}}" alt="" class="denim-img">
                </figure>
              @endif
            </div>
            <div class="col-md-7">
              @if (Auth::id() === $user->id)
                <div class="btn-group float-right" role="group" aria-label="Button group with nested dropdown">
                  <div class="" role="group">
                    <button class="btn text-dark denim-edit-btn"  data-toggle="dropdown">
                      <i class="fas fa-ellipsis-h"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnGroupDrop1">
                      <a class="dropdown-item"href="{{route('users.denims.edit', [$user->id, $denim->id])}}">編集する</a>
                      <a class="dropdown-item"type="button" data-toggle="modal" data-target="#modal{{$denim->id}}">削除する</a>
                    </div>
                  </div>
                </div>
              @endif  
              <div class="mb-2">
                <p>ウエスト：{{$denim->waist}} インチ</p>
              </div>
              <div class="mb-2">
                <p>履き込み回数：{{$denim->wearing_count}} 回</p>
              </div>
              <form method="POST" action="{{ route('users.denims.destroy', [$user->id, $denim->id])}}">
              @csrf

              @method('DELETE')
              
              <!-- Modal -->
              <div class="modal fade" id="modal{{$denim->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title">本当に削除しますか？</h5>
                              <button type="button" class="close" data-dismiss="modal">
                                  <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                          <div class="modal-body">
                              {{$denim->title}}
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                              <button type="submit" class="btn btn-danger">
                                  削除
                              </button>
                          </div>
                      </div>
                  </div>
              </div>
            </form>

            @if (Auth::id() === $user->id)
              <a href="{{route('users.records.create', [$user->id, $denim->id])}}" class="btn btn-success">記録する</a>
            @endif
            </div>
          </div><!-- /.row -->
          <div id="map" style="height: 500px"></div>
        </div>
    </div>

    <div class="container mt-5">
      <div class="row justify-content-center">
        <div class="col-md-8">
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
        </div>
      </div>
    </div><!-- /.container -->

    <div class="row justify-content-center mt-5">
      <div class="col-md-8">
        {{ $records->links() }}
      </div><!-- /.col-md-8 -->
    </div><!-- /.row -->
</div>
@endsection

@section('script')
  <script>
    function initMap() {
      var addresses = @json($wearing_places);

      var latlng = []; //緯度経度の値をセット
      var marker = []; //マーカーの位置情報をセット
      var myLatLng; //地図の中心点をセット用
      var geocoder;
      geocoder = new google.maps.Geocoder();

      var map = new google.maps.Map(document.getElementById('map'));//地図を作成する

      function geo(callback){
        var cRef = addresses.length;
        for (var i = 0; i < addresses.length; i++) {
          (function (i) { 
            geocoder.geocode({'address': addresses[i]}, 
              function(results, status) { // 結果
                if (status === google.maps.GeocoderStatus.OK) { // ステータスがOKの場合
                  latlng[i]=results[0].geometry.location;// マーカーを立てる位置をセット
                  marker[i] = new google.maps.Marker({
                    position: results[0].geometry.location, // マーカーを立てる位置を指定
                    map: map // マーカーを立てる地図を指定
                  });
                } else { // 失敗した場合
                }//if文の終了。ifは文なので;はいらない
                if (--cRef <= 0) {
                  callback();//全て取得できたらaftergeo実行
                }
              }//function(results, status)の終了
            );//geocoder.geocodeの終了
          }) (i);
        }//for文の終了
      }//function geo終了

      geo(aftergeo);

      function aftergeo(){
        myLatLng = latlng[0];//最初の住所を地図の中心点に設定
        var opt = {
          center: myLatLng, // 地図の中心を指定
          zoom: 16 // 地図のズームを指定
        };//地図作成のオプションのうちcenterとzoomは必須
        map.setOptions(opt);//オプションをmapにセット
      }//function aftergeo終了
  };
  </script>
  <script src="{{ config('services.google-map.apikey') }}" defer></script>
@endsection