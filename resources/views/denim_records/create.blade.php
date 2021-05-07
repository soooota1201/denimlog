@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3 class="mb-4">{{$denim->bland_type}}</h3>
            <form 
            method="POST" 
            action="{{route('users.records.store', [$user->id, $denim->id])
            }}" 
            enctype="multipart/form-data"
            class="mt5">
              @csrf
              <div class="form-group">
                <label for="">デニム画像</label>
                <input type="file" class="form-control" placeholder="" name="denim_record_image" value="">
              </div>
              <div class="form-group">
                <label for="">履いた日</label>
                <input type="date" class="form-control" placeholder="" name="wearing_day" value="{{ old("wearing_day") }}">
              </div>
              <div class="form-group">
                <label for="">履きこみ地</label>
                <input type="text" class="form-control" placeholder="" name="wearing_place" value="{{ old("wearing_place")}}">
              </div>
              <div class="form-group">
                <label for="">テキスト</label>
                <textarea cols="10" rows="10" type="text" class="form-control" placeholder="" name="body" value="{{ old("body") }}"></textarea>
              </div>
              <button type="submit" class="btn btn-primary">登録する</button>
            </form>
        </div>
    </div>
</div>
@endsection
