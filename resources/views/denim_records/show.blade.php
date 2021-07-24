@extends('layouts.app')

@section('header')
  @include('layouts.header')
@endsection

@section('content')

<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-10 mb-2">
        {{-- <div class="mb-3">
          <a href="{{route('users.denims.show', [$user->id, $denim->id])}}" class="text-dark mr-2"><i class="fas fa-arrow-left"></i><span class="record-denim ml-2">{{$record->denim->bland_type}}</span></a>
        </div> --}}
        <div class="container">
            <div class="row justify-content-center">
                <div class="card p-record col-12" href="{{route('users.records.show', [$user->id, $denim->id, $record->id])}}">
                  <p class="p-record-user_name d-inline-block">{{$record->user->name}}</p>

                  @if (!$record->denimRecordImages->isEmpty() && count($record->denimRecordImages) != 1)
                    <swiper-component :records="{{ json_encode($record->denimRecordImages) }}"></swiper-component>
                  @else
                    <figure class="c-img--wrapper">
                      <img src="{{$record->denimRecordImages[0]->cloud_record_image_path}}" class="c-img">
                    </figure>
                  @endif

                  <div class="card-body p-record-body">
                    @if (Auth::id() === $user->id)
                      <div class="btn-group float-right" role="group" aria-label="Button group with nested dropdown">
                        <div class="" role="group">
                          <button class="btn text-dark denim-edit-btn"  data-toggle="dropdown">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>

                          @if (Auth::id() === $user->id)
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnGroupDrop1">
                              <a class="dropdown-item" href="{{route('users.records.edit', [$user->id, $denim->id, $record->id])}}">編集する</a>
                              <a class="dropdown-item"type="button" data-toggle="modal" data-target="#modal{{$record->id}}">削除する</a>
                            </div>
                          @endif
                        </div>
                      </div>
                    @endif
                  <div class="row align-items-center">
                    <div class="mr-2">
                      {{-- likecomponent --}}
                      <like-component
                      :record="{{ json_encode($record)}}"
                      ></like-component>
                      {{-- likecomponent --}}
                    </div>
                    <div>
                       <a type="button" data-toggle="modal" data-target="#modal-comment{{$record->id}}" class="btn btn-outline-dark btn-sm"><i class="far fa-comment"></i></a>
                    </div>
                  </div><!-- /.row -->
                    <a href="{{route('users.show', $record->user->id)}}" class="p-record-user_name">{{$record->user->name}}</a>
                    <p class="card-text p-record-text">{{$record->body}}</p>
                    <p class="mt-3 p-record-date">記録日：{{$record->wearing_day}}</p>
                    <p class="p-record-place">訪問先：{{$record->wearing_place}}</p>
                  </div>
                  <div class="text-center">
                    <div id="map" style="height: 200px"></div>
                  </div>
                </div>
            </div>
        </div><!-- /.container -->
      </div>
    </div>
</div>

<div class="container mt-3">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <form method="POST" action="{{ route('users.records.destroy', [$user->id, $denim->id, $record->id])}}">
        @csrf
        @method('DELETE')
          <!-- Modal -->
          <div class="modal fade" id="modal{{$record->id}}" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title">下記の記録を本当に削除しますか？</h5>
                          <button type="button" class="close" data-dismiss="modal">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">
                        <p>{{$record->wearing_day}}</p>
                        <p>{{$record->wearing_place}}</p>
                        <p>{{$record->body}}</p>
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

      <form method="POST" action="{{ route('users.comments.store', [$user->id, $denim->id, $record->id, $record->id])}}">
        @csrf
          <!-- Modal -->
          <div class="modal fade" id="modal-comment{{$record->id}}" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title">コメントを記入してください</h5>
                          <button type="button" class="close" data-dismiss="modal">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="form-group p-2">
                      <label for="">コメント</label>
                      <textarea class="form-control" placeholder="" name="body" cols="30" rows="10"></textarea>
                    </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                          <button type="submit" class="btn btn-success">
                              投稿する
                          </button>
                      </div>
                  </div>
              </div>
          </div>
      </form>

      @if ($comments->count() != 0)
        <div class="p-comment mb-5">
          <p class="">
            <a class="btn btn-outline-dark" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
              コメントを見る
            </a>
          </p>
          <div class="collapse mt-3" id="collapseExample">
            <ul class="list-unstyled">
              @foreach ($comments as $comment)
                <li class="media pt-2 pb-2 border-bottom">
                  <div class="media-body">
                    <h5 class="mt-0 mb-1">{{$comment->user->name}}</h5>
                    {{$comment->body}}
                  </div>
                  @if ($comment->user_id === Auth::id())
                    <a type="button" data-toggle="modal" data-target="#modal-comment-delete{{$comment->id}}" class="btn btn-outline-danger">削除する</a>
                  @endif
                </li>

                {{-- modal --}}
                <form method="POST" action="{{ route('users.comments.destroy', [$user->id, $denim->id, $record->id, $comment->id])}}">
                  @csrf
                  @method('DELETE')
                  <!-- Modal -->
                  <div class="modal fade" id="modal-comment-delete{{$comment->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title">コメントを本当に削除しますか？</h5>
                              <button type="button" class="close" data-dismiss="modal">
                                  <span aria-hidden="true">&times;</span>
                              </button>
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
              @endforeach
            </ul>

          </div>
        </div>
      @endif

    </div><!-- /.col-md-8 -->
  </div><!-- /.row justify-content-center -->
</div><!-- /.container -->

@endsection

@section('script')
<script>
  var map;
  var marker;
  var geocoder;
  function initMap() {
    geocoder = new google.maps.Geocoder();
    geocoder.geocode({
        'address': @json($record->wearing_place)
    }, function(results, status) { // 結果
          if (status === google.maps.GeocoderStatus.OK) { // ステータスがOKの場合
            map = new google.maps.Map(document.getElementById('map'), {
              center: results[0].geometry.location, // 地図の中心を指定
                zoom: 16 // 地図のズームを指定
            });
          marker = new google.maps.Marker({
            position: results[0].geometry.location, // マーカーを立てる位置を指定
            map: map // マーカーを立てる地図を指定
          });
      } else { // 失敗した場合
          alert(status);
        }
    });
  }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google-map.apikey') }}&callback=initMap" defer></script>
@endsection
