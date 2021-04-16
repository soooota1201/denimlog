@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>デニムの記録を入力してください(Denim Record)</h2>

            @if ($errors->any())
              <div class="alert alert-danger">
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                  @endforeach
                </ul>
              </div><!-- /.alert alert-danger -->
            @endif

            <form 
            method="POST" 
            action="{{route('users.denims.records.store', [$user->id, $denim->id])
            }}" 
            class="mt5">
              @csrf

              <div class="form-group">
                <label for="">履いた日</label>
                <input type="date" class="form-control" placeholder="" name="wearing_day">
              </div>
              <div class="form-group">
                <label for="">履いて行った場所</label>
                <input type="text" class="form-control" placeholder="" name="wearing_place" value="">
              </div>
              <div class="form-group">
                <label for="">テキスト</label>
                <input type="text" class="form-control" placeholder="" name="body" value="">
              </div>
              
              <button type="submit" class="btn btn-primary">登録する</button>
            </form>
        </div>
    </div>
</div>
@endsection
