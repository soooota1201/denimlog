@extends('layouts.app')

@section('content')

@include('layouts._flash_message')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>デニム個別（SHOW）</h2>
              
            <table class="table">
              <tbody>
                <tr>
                  <td>ブランド</td>
                  <td>{{$denim->bland_type}}</td>
                </tr>
                <tr>
                  <td>ウエスト</td>
                  <td>{{$denim->waist}} インチ</td>
                </tr>
                <tr>
                  <td>履き込み回数</td>
                  <td>{{$denim->wearing_count}} 回</td>
                </tr>
              </tbody>
            </table>
            
            <a href="{{route('denims.edit', $denim->id)}}" class="btn btn-lg btn-block btn-outline-dark">編集する</a>
            <a href="{{route('denims.destroy', $denim->id)}}" class="btn btn-lg btn-block  btn-outline-dark mt4">削除する</a>
        </div>
    </div>
</div>
@endsection
