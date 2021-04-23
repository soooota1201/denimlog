@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class=" mb-4">
                <h2>ユーザープロフィール画面</h2>
                <p>user_name : {{$user->name}}</p>
            </div>
            <a href="{{route('users.edit', $user->id)}}" class="btn btn-lg btn-block  btn-outline-dark mt4">プロフィールを編集する</a>
            <a href="{{route('users.denims.index', Auth::id())}}" class="btn btn-lg btn-block  btn-outline-dark mt4">デニム一覧へ</a>
        </div>
    </div>
</div>
@endsection
