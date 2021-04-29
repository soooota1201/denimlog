@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>デニム記録個別（SHOW）</h2>

            <div>
              @if($record->is_liked_by_auth_user())
                <a href="{{ route('reply.unlike', $record->id) }}" class="btn btn-success btn-sm">いいね<span class="badge">{{ $record->likes->count() }}</span></a>
              @else
                <a href="{{ route('reply.like', $record->id) }}" class="btn btn-secondary btn-sm">いいね<span class="badge">{{ $record->likes->count() }}</span></a>
              @endif
            </div>
              
            <table class="table">
              <tbody>
                @if (!$record->denimRecordImages->isEmpty())
                  <tr>
                    <td></td>
                    <td>
                      <img src="{{$record->denimRecordImages[0]->cloud_record_image_path}}" alt="">
                    </td>
                  </tr>  
                @endif
                <tr>
                  <td>履いた日</td>
                  <td>{{$record->wearing_day}}</td>
                </tr>
                <tr>
                  <td>履いて行った場所</td>
                  <td>{{$record->wearing_place}}</td>
                </tr>
                <tr>
                  <td>テキスト</td>
                  <td>{{$record->body}}</td>
                </tr>
              </tbody>
            </table>

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
            
            @if (Auth::id() === $user->id)
              <a href="{{route('users.records.edit', [$user->id, $denim->id, $record->id])}}" class="btn btn-lg btn-block btn-outline-dark">編集する</a>
              <a type="button" data-toggle="modal" data-target="#modal{{$record->id}}" class="btn btn-lg btn-block  btn-outline-dark mt4">削除する</a>
            @endif

              <a href="{{route('users.denims.show', [$user->id, $denim->id])}}" class="btn btn-lg btn-block  btn-outline-dark mt4">戻る</a>
        </div>
    </div>
</div>
@endsection
