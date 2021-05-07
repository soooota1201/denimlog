@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <h3 class="mb-4">{{$record->denim->bland_type}}</h3>
        <div class="container">
            <div class="row justify-content-center">
                <div class="card record-card col-12" href="{{route('users.records.show', [$user->id, $denim->id, $record->id])}}">
                  <p class="record-card-user_name">{{$record->user->name}}</p>
                  @if (!$record->denimRecordImages->isEmpty())
                    <img class="bd-placeholder-img card-img-top" src="{{$record->denimRecordImages[0]->cloud_record_image_path}}" alt="">
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
        </div><!-- /.container -->
      </div>
    </div>
</div>
      


<div class="container mt-3">
  <div class="row justify-content-center">
    <div class="col-md-8">
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
    
      <form method="POST" action="{{ route('comments.store', $record->id)}}">
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
      
      @if (Auth::id() === $user->id)
        <a href="{{route('users.records.edit', [$user->id, $denim->id, $record->id])}}" class="btn btn-lg btn-block btn-outline-dark">編集する</a>
        <a type="button" data-toggle="modal" data-target="#modal{{$record->id}}" class="btn btn-lg btn-block  btn-outline-dark mt4">削除する</a>
      @endif
    
      <a href="{{route('users.denims.show', [$user->id, $denim->id])}}" class="btn btn-lg btn-block  btn-outline-dark mt4">戻る</a>
      <a type="button" data-toggle="modal" data-target="#modal-comment{{$record->id}}" class="btn btn-lg btn-block  btn-outline-dark mt4">コメントする</a>
    
      <ul class="list-unstyled mt-4">
        @foreach ($comments as $comment)
    
          <li class="media pt-2 pb-2 border-bottom">
            <div class="media-body">
              <h5 class="mt-0 mb-1">{{$comment->user->name}}</h5>
              {{$comment->body}}
            </div>
            @if ($comment->user_id === Auth::id())
              <a type="button" data-toggle="modal" data-target="#modal-comment-delete{{$comment->id}}" class="btn btn-danger">削除する</a>
            @endif
          </li>
          
          {{-- modal --}}
          <form method="POST" action="{{ route('comments.destroy', $comment->id)}}">
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
    </div><!-- /.col-md-8 -->
  </div><!-- /.row justify-content-center -->
  

</div><!-- /.container -->

@endsection
