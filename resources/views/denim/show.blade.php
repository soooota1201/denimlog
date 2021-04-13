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

            <form method="POST" action="{{ route('denims.destroy', $denim->id)}}">
              @csrf

              @method('DELETE')
              
                <!-- Modal -->
                <div class="modal fade" id="modal{{$denim->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">本当に削除しますか？</h5>
                                <button type="button" class="close" data-dismiss="modal">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                {{$denim->title}}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                                <button type="submit" class="btn btn-danger">
                                    削除
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            
            <a href="{{route('denims.edit', $denim->id)}}" class="btn btn-lg btn-block btn-outline-dark">編集する</a>
            <a type="button" data-toggle="modal" data-target="#modal{{$denim->id}}" class="btn btn-lg btn-block  btn-outline-dark mt4">削除する</a>

            

            
        </div>
    </div>
</div>
@endsection
