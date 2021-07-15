<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\UserFollow;
use App\DenimRecord;
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

    public function followList(DenimRecord $record, UserFollow $follow, User $user)
    {
        $follow_ids = $follow->followingIds($user->id);
        $following_ids = $follow_ids->pluck('followed_id')->toArray();
        $timelines = $record->getTimelines($user->id, $following_ids);
        return view('timeline.index',compact('timelines', 'user'));
    }
}
