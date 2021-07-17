@extends('layouts.app')

@section('header')
  @include('layouts.header') 
@endsection

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h2>プロフィールを更新してください</h2>

            <form 
            method="POST" 
            action="{{
              route('users.update',$user->id)
            }}" 
            enctype="multipart/form-data"
            class="mt5">
              @csrf

              @if (isset($user))
                @method('PUT')
              @endif

              <div class="form-group">
                <label for="">ユーザー名</label>
                <input type="text" class="form-control" placeholder="" name="name" value="{{$user->name}}">
              </div>
              <div class="form-group">
                <label for="">メールアドレス</label>
                <input type="text" class="form-control" placeholder="" name="email" value="{{$user->email}}">
              </div>
              <div class="form-group">
                <label for="">身長</label>
                <input type="text" class="form-control" placeholder="" name="height" value="{{$user->height}}">
              </div>
              <div class="form-group">
                <label for="">体重</label>
                <input type="text" class="form-control" placeholder="" name="weight" value="{{$user->weight}}">
              </div>
              <div class="form-group">
                <label for="">プロフィール</label>
                <textarea type="text" class="form-control" placeholder="" name="user_profile">{{$user->user_profile}}</textarea>
              </div>
              <div class="form-group">
                <label for="">プロフィール画像</label>
                <input type="file" class="form-control" placeholder="" name="thumbnail_image" value="">
              </div>
              
              <button type="submit" class="btn btn-primary">更新する</button>
            </form>
        </div>
    </div>
</div>
@endsection
