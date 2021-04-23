@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

          <div class="d-flex justify-content-between mb-3">
            <h2>{{$user->name}}のデニム一覧</h2>
            @if (Auth::id() === $user->id)
              <a href="{{route('users.denims.create', $user->id)}}" type="button" class="btn btn-success">登録する</a>
            @endif
          </div>

            @foreach ($denims as $denim)
              <a href="{{route('users.denims.show', [$user->id, $denim->id])}}" class="card mb-3" style="">
                <div class="row no-gutters">
                  <div class="col-md-4">
                    <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Image"><title>Placeholder</title><rect fill="#868e96" width="100%" height="100%"/><text fill="#dee2e6" dy=".3em" x="50%" y="50%">Image</text></svg>
                  </div>
                  <div class="col-md-8">
                    <div class="card-body">
                      <h5 class="card-title">{{$denim->bland_type}}</h5>
                      <p class="card-text">ウエスト：{{$denim->waist}}インチ</p>
                      <p class="card-text">履き込み回数：{{$denim->wearing_count}}回</p>
                    </div>
                  </div>
                </div>
              </a>
            @endforeach
            
        </div>
    </div>
</div>
@endsection
