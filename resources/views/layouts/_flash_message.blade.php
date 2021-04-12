<!-- フラッシュメッセージ -->
@if (session('success'))
  <div class="alert alert-success">
      {{ session('success') }}
  </div>
@endif

<!-- バリデーションエラーメッセージ -->
@if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{$error}}</li>
      @endforeach
    </ul>
  </div><!-- /.alert alert-danger -->
@endif


<!-- アラートメッセージ -->
@if (session('alert'))
  <div class="alert alert-danger">
      {{ session('alert') }}
  </div>
@endif