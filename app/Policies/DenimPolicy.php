<?php

namespace App\Policies;

use App\Denim;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class DenimPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any denims.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the denim.
     *
     * @param  \App\User  $user
     * @param  \App\Denim  $denim
     * @return mixed
     */
    public function view(User $user, Denim $denim)
    {
        //
    }

    /**
     * Determine whether the user can create denims.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user, User $routeUser)
    {
      $isOwner = $user->id === $routeUser->id; 
      return $isOwner ? $this->allow() : $this->deny('投稿者本人のみ操作できます。');
    }

    /**
     * Determine whether the user can update the denim.
     *
     * @param  \App\User  $user
     * @param  \App\Denim  $denim
     * @return mixed
     */
    public function update(User $user, Denim $denim)
    {
      $isOwner = $user->id === $denim->user_id; 
      return $isOwner ? $this->allow() : $this->deny('投稿者本人のみ操作できます。') ;
    }

    /**
     * Determine whether the user can delete the denim.
     *
     * @param  \App\User  $user
     * @param  \App\Denim  $denim
     * @return mixed
     */
    public function delete(User $user, Denim $denim)
    {
      $isOwner = $user->id === $denim->user_id; 
      return $isOwner ? $this->allow() : $this->deny('投稿者本人のみ操作できます。') ;
    }

    /**
     * Determine whether the user can restore the denim.
     *
     * @param  \App\User  $user
     * @param  \App\Denim  $denim
     * @return mixed
     */
    public function restore(User $user, Denim $denim)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the denim.
     *
     * @param  \App\User  $user
     * @param  \App\Denim  $denim
     * @return mixed
     */
    public function forceDelete(User $user, Denim $denim)
    {
        //
    }
}
