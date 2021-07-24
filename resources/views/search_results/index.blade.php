@extends('layouts.app')

@section('header')
  @include('layouts.header')
@endsection

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
          <div class="container">
            <form class="input-group pt-3" action="{{route('users.search.records', Auth::id())}}" method="GET">
              <input type="text" class="form-control search-input mr-3" name="record" placeholder="search denim and records" value="{{ request()->query('record') }}" style="display: block;">
              <button type="submit" class="btn btn-outline-success">検索する</button>
            </form>
            @if (isset($records))
              <h3 class="mb-3 mt-5">"{{ request()->query('record')}}"の検索結果</h3>
              @forelse ($records as $record)
                <div class="p-record">
                  <div class="card p-record mb-4 col-12">
                    <p class="p-record-user_name">{{$record->user->name}}</p>
                    @if (!$record->denimRecordImages->isEmpty())
                    <a href="{{route('users.records.show', [$record->user_id, $record->denim_id, $record->id])}}" class="c-img--wrapper">
                      <img class="bd-placeholder-img c-img" src="{{$record->denimRecordImages[0]->cloud_record_image_path}}" alt="">
                    </a>
                    @endif
                    <div class="card-body p-record-body">
                      {{-- likecomponent --}}
                      <like-component
                      :record="{{ json_encode($record)}}"
                      ></like-component>
                      {{-- likecomponent --}}
                      <p class="p-record-user_name">{{$record->user->name}}</p>
                      <p class="card-text p-record-text">{{$record->body}}</p>
                      <p class="mt-3 p-record-place">ブランド：{{$record->bland_type}}</p>
                      <p class="p-record-date">記録日：{{$record->wearing_day}}</p>
                      <p class="p-record-place">訪問先：{{$record->wearing_place}}</p>
                    </div>
                  </div>
                </div><!-- /.p-record -->
              @empty
                <p class="text-center">
                  <strong>{{ request()->query('record')}}</strong>の検索結果はありません。
                </p>
              @endforelse
            @endif

            <div class="c-pager">
              {{-- {{$records->appends(['record' => request()->query('record')])->links()}} --}}
            </div><!-- /.c-pager -->
          </div><!-- /.container -->
        </div>
    </div>
</div>
@endsection
