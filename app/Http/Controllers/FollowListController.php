<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\UserFollow;

class FollowListController extends Controller
{
    public function followingUserIndex(User $user, UserFollow $follow) {
      // dd($user->id);
      $follow_ids = $follow->followingIds($user->id);
      $following_ids = $follow_ids->pluck('followed_id')->toArray();
      $followingUsers = $user->getFollowUsersId($user->id, $following_ids);
      return view('follow_list.following',compact('followingUsers', 'user'));
    }

    public function followedUserIndex(User $user, UserFollow $follow) {
      $follow_ids = $follow->followedIds($user->id);
      $followed_ids = $follow_ids->pluck('following_id')->toArray();
      $followedUsers = $user->getFollowUsersId($user->id, $followed_ids);
      return view('follow_list.followed',compact('followedUsers', 'user'));
    }
}
