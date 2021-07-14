@extends('layouts.app')

@section('header')
  @include('layouts.header') 
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="d-flex align-items-center mb-3">
              <a href="{{route('users.denims.show', [$user->id, $denim->id])}}" class="text-dark mr-2"><i class="fas fa-arrow-left"></i><span class="d-inline-block ml-2">{{$denim->bland_type}}へ戻る</span></a>
            </div>
            <form 
            method="POST" 
            action="{{route('users.records.store', [$user->id, $denim->id])
            }}" 
            enctype="multipart/form-data"
            class="mt5">
              @csrf
              <div class="form-group">
                <label for="">デニム画像</label>
                <input type="file" class="form-control" placeholder="" name="denim_record_image[]"  multiple>
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
                <textarea cols="10" rows="10" type="text" class="form-control" placeholder="" name="body">{{ old("body") }}</textarea>
              </div>
              <button type="submit" class="btn btn-lg btn-block btn-outline-dark">登録する<i class="fas fa-angle-right ml-4"></i></button>
            </form>
        </div>
    </div>
</div>
@endsection
