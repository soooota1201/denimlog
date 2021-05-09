@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

          @if (!request()->query('denim'))
            <div class="mb-3">
              <a href="{{route('users.show', $user->id)}}" class="text-dark mr-2"><i class="fas fa-arrow-left"></i><span class="d-inline-block ml-2">プロフィールへ戻る</span></a>
            </div>
          @endif

          @if (!request()->query('denim'))
          <div class="d-flex justify-content-between mb-3">
            <h2>{{$user->name}}のデニム一覧</h2>
            @if (Auth::id() === $user->id)
              <a href="{{route('users.denims.create', $user->id)}}" type="button" class="btn btn-success">登録する</a>
            @endif
          </div>
          @endif

          @if (request()->query('denim'))
              @forelse ($denims as $denim)
              <a href="{{route('users.denims.show', [$denim->user_id, $denim->id])}}" class="card mb-3" style="">
                <div class="row no-gutters">
                  <div class="col-md-4">
                      @if (!$denim->denimImages->isEmpty())
                      <img width="180" height="160" src="{{$denim->denimImages[0]->cloud_image_path}}" alt="">
                      @endif
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
            @empty
              <p class="text-center">
                No results found for query <strong>{{ request()->query('denim')}}</strong>
              </p>
            @endforelse
            {{$denims->appends(['denim' => request()->query('denim')])->links()}}
          @else
            @foreach ($denims as $denim)
              <a href="{{route('users.denims.show', [$user->id, $denim->id])}}" class="card mb-3" style="">
                <div class="row no-gutters">
                  <div class="col-md-4">
                      @if (!$denim->denimImages->isEmpty())
                      <img width="180" height="160" src="{{$denim->denimImages[0]->cloud_image_path}}" alt="">
                      @endif
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
            {{ $denims->links() }}
          @endif
        </div>
    </div>
</div>
@endsection
