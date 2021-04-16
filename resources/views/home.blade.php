@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
            <a href="{{route('users.denims.index', Auth::id())}}" class="btn btn-lg btn-block  btn-outline-dark mt4">デニム一覧へ</a>
        </div>
    </div>
</div>
@endsection
