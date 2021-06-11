@extends('layouts.app')

@section('header')
  @include('layouts.header') 
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>デニムの情報を入力してください（Create, Store）</h2>

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
            action="{{isset($denim) ? route('users.denims.update', [$user->id, $denim->id]) : route('users.denims.store', [$user->id])
            }}" 
            enctype="multipart/form-data"
            class="mt5">
              @csrf

              @if (isset($denim))
                @method('PUT')
              @endif

              <div class="form-group">
                <label for="">ブランド</label>
                <input type="text" class="form-control" placeholder="Levi's 501" name="bland_type">
              </div>
              <div class="form-group">
                <label for="">ウエスト（任意）</label>
                <input type="text" class="form-control" placeholder="30" name="waist" value="">
              </div>
              <div class="form-group">
                <label for="">履き込み回数（任意、新品は空欄）</label>
                <input type="text" class="form-control" placeholder="30" name="wearing_count" value="">
              </div>
              <div class="form-group">
                <label for="">デニム画像</label>
                <input type="file" class="form-control" placeholder="" name="denim_image" value="">
              </div>

              <button type="submit" class="btn btn-primary">登録する</button>
            </form>
        </div>
    </div>
</div>
@endsection
