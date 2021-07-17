@extends('layouts.app')

@section('header')
  @include('layouts.header') 
@endsection

@section('content')

<div class="container p-denimIndex">
    <div class="row justify-content-center">
        <div class="col-md-10">
          <div class="d-flex justify-content-between align-items-md-center align-items-start flex-md-row flex-column mb-5">
            <h2 class="p-denimIndex__heading"><a href="{{route('users.show', $user->id)}}">{{$user->name}}</a>のデニム一覧</h2>
            @if (Auth::id() === $user->id)
              @if ($denims->count() != 0)
                <a href="{{route('users.denims.create', $user->id)}}" type="button" class="btn btn-outline-dark mt-md-0 mt-3">登録する</a>
              @endif
            @endif
          </div>

          @if ($denims->count() == 0)
            <div class="mt-4">
              <p>お気に入りのデニムを登録しましょう！</p>
              <br>
              @if (Auth::id() === $user->id)
                <a href="{{route('users.denims.create', $user->id)}}" class="btn text-white profile-denim-btn">登録する<i class="fas fa-chevron-right ml-2"></i></a>
            </div><!-- /.mt-3 -->
            @endif
          @endif

          @foreach ($denims as $denim)
            <a href="{{route('users.denims.show', [$user->id, $denim->id])}}" class="card mb-3 p-denimCard" style="">
              <div class="row no-gutters">
                <div class="col-4">
                    @if (!$denim->denimImages->isEmpty())
                    <img style="width: 100%; height: 120px; object-fit: cover;
                    " src="{{$denim->denimImages[0]->cloud_image_path}}" alt="">
                    @endif
                  </div>
                <div class="col-8">
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
        </div>
    </div>
</div>
@endsection
