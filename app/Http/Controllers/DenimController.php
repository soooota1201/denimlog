<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Denims\CreateDenimRequest;
use App\Http\Requests\Denims\UpdateDenimRequest;
use Illuminate\Support\Facades\Auth;
use App\Denim;
use App\User;
use App\DenimRecord;
use App\DenimImage;
use JD\Cloudder\Facades\Cloudder;

class DenimController extends Controller
{

    public function __construct() {
      $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $denims = Denim::where('user_id', $user->id)->paginate(5);

        $denims->load('denimImages');
        
        return view('denims.index', compact('user', 'denims'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    {
        if($user->id !== Auth::id())
        {
          return redirect()->route('users.denims.create', Auth::id());
        };
        return view('denims.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateDenimRequest $request, User $user, Denim $denim)
    {
      \DB::beginTransaction();

      try {

        $this->authorize('create', [Denim::class, $user]);
  
        $denim = Denim::create([
          'user_id' => Auth::id(),
          'bland_type' => $request->bland_type,
          'waist' => $request->waist,
          'wearing_count' => $request->wearing_count,
        ]);
  
        if ($image = $request->file('denim_image')) {
            $image_path = $image->getRealPath();
            Cloudder::upload($image_path, null);
            //直前にアップロードされた画像のpublicIdを取得する。
            $publicId = Cloudder::getPublicId();
            $logoUrl = Cloudder::secureShow($publicId, [
                'width'     => 200,
                'height'    => 200
            ]);
            $denimImage = DenimImage::create([
              'denim_id' => $denim->id,
              'cloud_image_path' => $logoUrl,
              'cloud_image_id'  => $publicId
            ]);
        }

        \DB::commit();
  
      } catch (Exception $e) {
        \Log::error($e);
        \DB::rollBack();
        return redirect(route('users.denim.create', compact('user')))->with('alert', '記録の保存に失敗しました。')->withInput();
      }

      return redirect(route('users.denims.show', [$user->id, $denim->id]))->with('success', '登録が完了しました！');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, Denim $denim)
    {
      if($user->id !== $denim->user_id)
      {
        abort(404);
      };

      $denim->load('denimImages');
      $denim_wearing_place = $denim->with('denimRecords');
      $records = DenimRecord::where('denim_id', $denim->id)->latest()->paginate(10);
      $wearing_places = DenimRecord::where('denim_id', $denim->id)->pluck('wearing_place')->toArray();
      return view('denims.show', compact('user', 'denim', 'records', 'wearing_places'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, Denim $denim)
    {
        $this->authorize('update', $denim);

        return view('denims.edit', compact('user', 'denim'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDenimRequest $request, User $user, Denim $denim)
    {
        $denim->update([
          'bland_type' => $request->bland_type,
          'waist' => $request->waist,
          'wearing_count' => $request->wearing_count
        ]);

        return redirect(route('users.denims.show', [$user->id, $denim->id]))->with('success', '編集が完了しました！');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, Denim $denim)
    {
        $this->authorize('delete', $denim);
        $denim->delete();
        return redirect(route('users.denims.index', $user->id))->with('alert', 'デニムが削除されました');
    }
}
