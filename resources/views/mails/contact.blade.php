<div class="card" style="width: 100%;">
  <div class="card-body">
    <h5 class="card-title"><p>{{ $sender->name }}</p>さんからのコメント</h5>
    <p class="card-text"><p>{{ $body }}</p></p>
    <a href="{{route('users.records.show', [$receiver->id, $denim->id, $record->id])}}">コメントされた投稿のリンク</a>
  </div>
</div>