@extends('layouts.app')

@section('header')
  @include('layouts.header')
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center p-denim__top">
        <div class="col-md-10">
          <div class="d-flex justify-content-between mb-3">
            <h2 class="p-denim__name">{{$denim->bland_type}}</h2>
          </div><!-- /.p-denim__name -->

          <div class="row mb-3 p-denim__data">
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
              <a href="{{route('users.records.create', [$user->id, $denim->id])}}" class="btn btn-outline-dark">記録する</a>
            @endif
            </div>
          </div><!-- /.p-denim__data -->
        </div>
    </div><!-- /.p-denim__top -->

    <div class="row justify-content-center p-denim__content">
      <div class="col-md-10 mb-5">
        <ul class="nav nav-tabs p-denim__tab" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Record</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Visited Places</a>
          </li>
        </ul>

        <div class="tab-content p-denim__records" id="myTabContent">
          <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="container mt-2 p-denim__recordIndex">
              <div class="row justify-content-center">
                <div class="col-md-12">
                  @if ($denim->denimRecords->count() == 0)
                    <div class="mt-3">
                      <p>登録したデニムの成長を記録しましょう！</p>
                      <br>
                      @if (Auth::id() === $user->id)
                        <a href="{{route('users.records.create', [$user->id, $denim->id])}}" class="btn text-white profile-denim-btn">記録する</a>
                      @endif
                    </div>
                  @else
                    @foreach ($records as $record)
                      <div class="row justify-content-center">
                        <div class="card p-record col-12 mb-4">
                          <p class="p-record-user_name">{{$record->user->name}}</p>
                          @if (!$record->denimRecordImages->isEmpty())
                          <a href="{{route('users.records.show', [$user->id, $denim->id, $record->id])}}" class= "c-img--wrapper">
                            <img class="bd-placeholder-img c-img" src="{{$record->denimRecordImages[0]->cloud_record_image_path}}" alt="">
                          </a>
                          @endif
                          <div class="card-body p-record-body">
                            {{-- likecomponent --}}
                            <like-component
                            :record="{{ json_encode($record)}}"
                            ></like-component>
                            {{-- likecomponent --}}
                            <p class="p-record-user_name">{{$record->user->name}}</p>
                            <p class="card-text p-record-text">{{$record->body}}</p>
                            <p class="mt-3 p-record-date">記録日：{{$record->wearing_day}}</p>
                            <p class="p-record-place">訪問先：{{$record->wearing_place}}</p>
                            <!-- /.record map-->
                            {{-- <div class="text-center">
                              <div id="map" style="height: 200px"></div>
                            </div> --}}
                            <!-- /.record map-->
                          </div>
                        </div>
                      </div><!-- /.p-record -->
                    @endforeach
                  @endif
                </div>
              </div>
            </div><!-- /.p-denim__recordIndex -->
          </div>
          <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="p-denim__map mt-3">
              <div class="container">
                <div class="row">
                  <div class="col-12">
                    @if ($denim->denimRecords->count() == 0)
                      <div class="mt-2">
                        <p>登録したデニムの成長を記録しましょう！</p>
                        <br>
                        @if (Auth::id() === $user->id)
                          <a href="{{route('users.records.create', [$user->id, $denim->id])}}" class="btn text-white profile-denim-btn">記録する</a>
                        @endif
                      </div>
                    @else
                    <!-- /.record all map-->
                      <div id="map" style="height: 500px"></div>
                    <!-- /.record all map-->
                    @endif
                  </div><!-- /.col-md-12 -->
                </div><!-- /.row -->
              </div><!-- /.container -->
            </div><!-- /.p-denim__map -->
          </div>
        </div><!-- /.col-md-8 -->
      </div><!-- /.col-md-8 -->
    </div><!-- /.p-denim__content -->


    <div class="row justify-content-center mt-5 c-pager">
      <div class="col-md-8">
        {{ $records->links() }}
      </div>
    </div><!-- /.c-pager -->
</div>
@endsection

@section('script')
  <script>
    function initAllMap() {
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
  <script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google-map.apikey') }}&callback=initAllMap" defer></script>
@endsection
