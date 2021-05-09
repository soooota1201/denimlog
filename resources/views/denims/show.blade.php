@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="d-flex justify-content-between mb-3">
            <h2>デニム個別（SHOW）</h2>
            @if (Auth::id() === $user->id)
              <a href="{{route('users.records.create', [$user->id, $denim->id])}}" class="btn btn-success">記録する</a>
            @endif
          </div>
              
            <table class="table">
              <tbody>
                @if (!$denim->denimImages->isEmpty())
                  <tr>
                    <td>デニム</td>
                    <td>
                      <img src="{{$denim->denimImages[0]->cloud_image_path}}" alt="">
                    </td>
                  </tr>
                @endif
                <tr>
                  <td>ブランド</td>
                  <td>{{$denim->bland_type}}</td>
                </tr>
                <tr>
                  <td>ウエスト</td>
                  <td>{{$denim->waist}} インチ</td>
                </tr>
                <tr>
                  <td>履き込み回数</td>
                  <td>{{$denim->wearing_count}} 回</td>
                </tr>
              </tbody>
            </table>

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
              <a href="{{route('users.denims.edit', [$user->id, $denim->id])}}" class="btn btn-lg btn-block btn-outline-dark">編集する</a>
              <a type="button" data-toggle="modal" data-target="#modal{{$denim->id}}" class="btn btn-lg btn-block  btn-outline-dark mt4">削除する</a>
            @endif
              <a href="{{route('users.denims.index', $user->id)}}" class="btn btn-lg btn-block  btn-outline-dark mt4">デニム一覧へ戻る</a>
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
