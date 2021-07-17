{{-- @foreach ($timelines as $timeline)
  {{ $timeline->user_id }}
  {{ $timeline->wearing_day }}
@endforeach --}}

@extends('layouts.app')

@section('header')
  @include('layouts.header') 
@endsection

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
          <div class="container">
            @if (isset($timelines))
              @forelse ($timelines as $record)
                <div class="row justify-content-center">
                  <div class="card p-record col-12 mb-4">
                    <a href="{{route('users.show', $record->user->id)}}" class="p-record-user_name">{{$record->user->name}}</a>
                    @if (!$record->denimRecordImages->isEmpty())
                    <a href="{{route('users.records.show', [$record->user_id, $record->denim_id, $record->id])}}" class="p-record-img--wrapper">
                      <img class="bd-placeholder-img p-record-img" src="{{$record->denimRecordImages[0]->cloud_record_image_path}}" alt="">
                    </a>
                    @endif
                    <div class="card-body p-record-body">
                      {{-- likecomponent --}}
                      <like-component
                      :record="{{ json_encode($record)}}"
                      ></like-component>
                      {{-- likecomponent --}}
                      <a href="{{route('users.show', $record->user->id)}}" class="p-record-user_name">{{$record->user->name}}</a>
                      <p class="card-text p-record-text">{{$record->body}}</p>
                      <p class="mt-3 p-record__bland">ブランド：<a href="{{route('users.denims.show', [$record->user_id, $record->denim_id])}}">{{$record->bland_type}}</a></p>
                      <p class="p-record-date">記録日：{{$record->wearing_day}}</p>
                      <p class="p-record-place">訪問先：{{$record->wearing_place}}</p>
                    </div>
                  </div>
                </div><!-- /.p-record -->
              @empty
                <p class="text-center">
                  他のユーザーをフォローしましょう！
                </p>
              @endforelse
            @endif
          </div><!-- /.container -->
        </div>
    </div>
</div>
@endsection
