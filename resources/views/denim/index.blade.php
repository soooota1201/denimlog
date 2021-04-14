@extends('layouts.app')

@section('content')

@include('layouts._flash_message')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>デニム一覧</h2>
              
            @foreach ($denims as $denim)
              {{$denim->waist}}
            @endforeach
            
        </div>
    </div>
</div>
@endsection
