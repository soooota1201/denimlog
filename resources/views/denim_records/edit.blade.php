@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>デニム記録の情報を更新してください</h2>

            <form 
            method="POST" 
            action="{{route('users.records.update',[$user->id, $denim->id, $record->id])
            }}" 
            class="mt5">
              @csrf
              @method('PUT')

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
                <input type="text" class="form-control" name="body" value="{{$record->body}}">
              </div>
              
              <button type="submit" class="btn btn-primary">変更する</button>
            </form>
        </div>
    </div>
</div>
@endsection
