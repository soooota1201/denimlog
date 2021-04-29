<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DenimRecords\CreateDenimRecordRequest;
use App\Http\Requests\DenimRecords\UpdateDenimRecordRequest;
use Illuminate\Support\Facades\Auth;
use JD\Cloudder\Facades\Cloudder;

use App\User;
use App\Denim;
use App\DenimRecord;
use App\DenimRecordImage;
use App\Like;
use App\Comment;

class DenimRecordController extends Controller
{
    public function __construct() {
      $this->middleware('auth')->except(['index', 'show']);
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
    public function create(User $user, Denim $denim)
    {
        return view('denim_records.create', compact('user', 'denim'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateDenimRecordRequest $request, User $user, Denim $denim)
    {
      \DB::beginTransaction();

      try {

        $record = DenimRecord::create([
          'user_id' => Auth::id(),
          'denim_id' => $denim->id,
          'wearing_day' => $request->wearing_day,
          'wearing_place' => $request->wearing_place,
          'body' => $request->body
        ]);

        if($image = $request->file('denim_record_image')) {
          $image_path = $image->getRealPath();
          Cloudder::upload($image_path, null);
          $publicId = Cloudder::getPublicId();
          $logoUrl = Cloudder::secureShow($publicId, [
            'width' => 200,
            'height' => 200
          ]);
          $denimRecordImage = DenimRecordImage::create([
            'denim_record_id' => $record->id,
            'cloud_record_image_path' => $logoUrl,
            'cloud_record_image_id' => $publicId
          ]);
        };

        $denim->wearing_count++;
        $denim->save();

        \DB::commit();
        
      } catch (Exception $e) {

        \Log::error($e);
        \DB::rollBack();
        return redirect(route('users.records.create', compact('user', 'denim')))->with('alert', '記録の保存に失敗しました。')->withInput();
        
      }
        
      return redirect()->route('users.records.show', compact('user', 'denim', 'record'))->with('success', '記録が登録されました！');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, Denim $denim, DenimRecord $record)
    {
      if($user->id !== $denim->user_id || $denim->id !== $record->denim_id)
      {
        abort(404);
      };
      $record->load('denimRecordImages');
      $comments = Comment::where('denim_record_id', $record->id)->orderBy('created_at', 'desc')->get();
      return view('denim_records.show', compact('user', 'denim', 'record', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, Denim $denim, DenimRecord $record)
    {
        return view('denim_records.edit', compact('user', 'denim', 'record'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDenimRecordRequest $request, User $user, Denim $denim, DenimRecord $record)
    {
        $record->update([
          'wearing_day' => $request->wearing_day,
          'wearing_place' => $request->wearing_place,
          'body' => $request->body
        ]);

        return redirect(route('users.records.show', [$user->id, $denim->id, $record->id]))->with('success', '編集が完了しました！');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, Denim $denim, DenimRecord $record)
    {
        $record->delete();

        return redirect()->route('users.denims.show', compact('user', 'denim'))->with('alert', 'デニム記録が削除されました');
    }
}
