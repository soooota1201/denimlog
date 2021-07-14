@extends('layouts.app')

@section('header')
  @include('layouts.header') 
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h2>デニムの情報を入力してください</h2>

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
                <input type="text" class="form-control" placeholder="Levi's 501" name="bland_type" value="{{ old('bland_type') }}">
              </div>
              <div class="form-group">
                <label for="">ウエスト（任意）</label>
                <input type="number" class="form-control" placeholder="30" min="0" name="waist" value="{{ old('waist') }}">
              </div>
              <div class="form-group">
                <label for="">履き込み回数（任意、新品は空欄）</label>
                <input type="number" min="0" class="form-control" placeholder="30" name="wearing_count" value="{{ old('wearing_count') }}">
              </div>
              <div class="form-group">
                <label for="">デニム画像</label>
                <input type="file" class="form-control" placeholder="" name="denim_image" value="{{ old('denim_image') }}">
              </div>
              <button type="submit" class="btn btn-lg btn-block btn-outline-dark">登録する<i class="fas fa-angle-right ml-4"></i></button>
            </form>
        </div>
    </div>
</div>
@endsection
