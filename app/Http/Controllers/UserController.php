<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Users\UpdateUserRequest;
use App\User;
use App\Denim;
use App\DenimRecord;
use JD\Cloudder\Facades\Cloudder;

class UserController extends Controller
{
    public function __construct() {
      $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
      $denims = Denim::where('user_id', $user->id)->take(3)->latest()->get();
      $records = DenimRecord::where('user_id', $user->id)->get();
      
      return view('users.show', compact('user', 'denims', 'records'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update([
          'name' => $request->name,
          'height' => $request->height,
          'weight' => $request->weight,
          'user_profile' => $request->user_profile
        ]);

        if ($image = $request->file('thumbnail_image')) {
            $image_path = $image->getRealPath();
            Cloudder::upload($image_path, null);
            //直前にアップロードされた画像のpublicIdを取得する。
            $publicId = Cloudder::getPublicId();
            $logoUrl = Cloudder::secureShow($publicId, [
                'width'     => 200,
                'height'    => 200
            ]);
            $user->thumbnail_image_path = $logoUrl;
            $user->thumbnail_public_id  = $publicId;
            $user->save();
        }
        
        return redirect(route('users.show', compact('user')))->with('success', 'プロフィールの編集が完了しました！');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
