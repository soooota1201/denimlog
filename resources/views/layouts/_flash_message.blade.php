<!-- フラッシュメッセージ -->
@if (session('success'))
  <div class="alert alert-success">
      <button type="button" class="close" data-dismiss="alert">
        <span aria-hidden="true">&times;</span>
      </button>
      {{ session('success') }}
  </div>
@endif

<!-- バリデーションエラーメッセージ -->
@if ($errors->any())
  <div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert">
      <span aria-hidden="true">&times;</span>
    </button>
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{$error}}</li>
      @endforeach
    </ul>
  </div><!-- /.alert alert-danger -->
@endif


<!-- アラートメッセージ -->
@if (session('alert'))
  <button type="button" class="close" data-dismiss="alert">
    <span aria-hidden="true">&times;</span>
  </button>
  <div class="alert alert-danger">
      {{ session('alert') }}
  </div>
@endif