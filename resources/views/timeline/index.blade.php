{{-- @foreach ($timelines as $timeline)
  {{ $timeline->user_id }}
  {{ $timeline->wearing_day }}
@endforeach --}}

@extends('layouts.app')

@section('header')
  @include('layouts.header') 
@endsection

@section('content')

<div class="container pt-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
          <div class="container">
            @if (isset($timelines))
              @forelse ($timelines as $record)
                <div class="p-record">
                  <div class="card record-card mb-4">
                    <a href="{{route('users.show', $record->user->id)}}" class="record-card-user_name">{{$record->user->name}}</a>
                    @if (!$record->denimRecordImages->isEmpty())
                    <a href="{{route('users.records.show', [$record->user_id, $record->denim_id, $record->id])}}" class="record-card-img--wrapper">
                      <img class="bd-placeholder-img record-card-img" src="{{$record->denimRecordImages[0]->cloud_record_image_path}}" alt="">
                    </a>
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
                      <p class="mt-3 record-card-place">ブランド：{{$record->bland_type}}</p>
                      <p class="record-card-date">記録日：{{$record->wearing_day}}</p>
                      <p class="record-card-place">履き込み地：{{$record->wearing_place}}</p>
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
