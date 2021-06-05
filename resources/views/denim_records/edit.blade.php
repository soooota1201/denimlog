@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="mb-3">
              <a href="{{route('users.denims.show', [$user->id, $denim->id])}}" class="text-dark mr-2"><i class="fas fa-arrow-left"></i><span class="d-inline-block ml-2">戻る</span></a>
            </div>
            <form 
            method="POST" 
            action="{{route('users.records.update',[$user->id, $denim->id, $record->id])
            }}" 
            enctype="multipart/form-data"
            class="mt5">
              @csrf
              @method('PUT')
              <div class="form-group">
                <label for="">デニム画像</label>
                @if (!$record->denimRecordImages->isEmpty())
                  <img class="bd-placeholder-img card-img-top mb-3" src="{{$record->denimRecordImages[0]->cloud_record_image_path}}" alt="">
                @endif
                <input type="file" class="form-control" placeholder="" name="denim_record_image[]" value="" multiple>
              </div>
              <div class="form-group">
                <label for="">履いた日</label>
                <input type="date" class="form-control" value="{{$record->wearing_day}}" name="wearing_day">
              </div>
              <div class="form-group">
                <label for="">履いて行った場所</label>
                <input type="text" class="form-control" name="wearing_place" value="{{$record->wearing_place}}">
              </div>
              <div class="form-group">
                <label for="">テキスト</label>
                <textarea cols="10" rows="7" type="text" class="form-control" name="body">{{$record->body}}</textarea>
              </div>
              
              <button type="submit" class="btn btn-lg btn-block btn-outline-dark">変更する<i class="fas fa-angle-right ml-4"></i></button>
            </form>
        </div>
    </div>
</div>
@endsection
