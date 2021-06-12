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
            @if (Auth::id() === $user->id)
              <a href="{{route('users.records.create', [$user->id, $denim->id])}}" class="btn btn-success">記録する</a>
            @endif
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
              <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
              <div class="btn-group" role="group">
                <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  編集する
                </button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                  <a class="dropdown-item"href="{{route('users.denims.edit', [$user->id, $denim->id])}}">編集する</a>
                  <a class="dropdown-item"type="button" data-toggle="modal" data-target="#modal{{$denim->id}}">削除する</a>
                </div>
              </div>
            </div>
            @endif
              <a href="{{route('users.denims.index', $user->id)}}" class="btn btn-lg btn-block  btn-outline-dark mt4">デニム一覧へ戻る</a>
            </div>
          </div><!-- /.row -->
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
                    <span class="btn btn-sm btn-success record-card-like mb-1">いいね</span>
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
