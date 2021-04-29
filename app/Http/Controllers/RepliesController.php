<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\DenimRecord;
use App\Like;

class RepliesController extends Controller
{
    public function __construct() {
      $this->middleware('auth')->except(['like', 'unlike']);
    }

    public function like($record) {
      // dd($record->id);
      Like::create([
        'user_id' => Auth::id(),
        'denim_record_id' => $record
      ]);

      session()->flash('success', 'You Liked the Reply.');

      return redirect()->back();
    }

    public function unlike($id)
    {
      $like = Like::where('denim_record_id', $id)->where('user_id', Auth::id())->first();
      $like->delete();

      session()->flash('success', 'You Unliked the Reply.');

      return redirect()->back();
    }
}
