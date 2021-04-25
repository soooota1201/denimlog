@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @forelse ($records as $record)
              <div class="row justify-content-center mt-4">
                <a href="{{route('users.records.show', [$record->user_id, $record->denim_id, $record->id])}}" class="col-md-8">
                  <div class="card">
                    <svg class="bd-placeholder-img card-img-top" width="100%" height="450px"  xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Image cap"><title>Placeholder</title><rect fill="#868e96" width="100%" height="100%"/><text fill="#dee2e6" dy=".3em" x="50%" y="50%">Image cap</text></svg>
                    <div class="card-body">
                      <h6 class="card-subtitle mb-2 text-muted">{{$record->wearing_day}}</h6>
                      <h6 class="card-subtitle mb-2 text-muted">{{$record->wearing_place}}</h6>
                      <p class="card-text">{{$record->body}}</p>
                    </div>
                  </div>
                </a>
              </div>
            @empty
              <p class="text-center">
                No results found for query <strong>{{ request()->query('record')}}</strong>
                </p>
            @endforelse
            
            {{$records->appends(['record' => request()->query('record')])->links()}}

        </div>
    </div>
</div>
@endsection
