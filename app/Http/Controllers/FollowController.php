<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\UserFollow;
use App\User;

class FollowController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth')->only(['store', 'destroy']);
    }

    public function store($id)
    {
        Auth::user()->follow($id);
        session()->flash('success', 'フォローしました');
        return redirect()->back();
    }

    public function destroy($id)
    {
        Auth::user()->unfollow($id);
        session()->flash('alert', 'フォローを外しました');
        return redirect()->back();
    }
}
