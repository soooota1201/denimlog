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

    public function store(User $user)
    {
        $user->follow(Auth::id());
        $result = true;
        return response()->json([
          'result' => $result,
        ]);
    }

    public function destroy(User $user)
    {
        $user->unfollow(Auth::id());
        $result = false;
        return response()->json([
          'result' => $result,
        ]);
    }

    public function hasFollow(User $user) {
      $user = User::find($user->id);
      if ($user->followings()->where('followed_id', Auth::id())->exists()) {
          $result = true;
      } else {
          $result = false;
      }
      return response()->json($result);
    }

    public function followList(DenimRecord $record, UserFollow $follow, User $user)
    {
        $follow_ids = $follow->followedIds($user->id);
        $following_ids = $follow_ids->pluck('following_id')->toArray();
        $timelines = $record->getTimelines($user->id, $following_ids);
        return view('timeline.index',compact('timelines', 'user'));
    }
}
