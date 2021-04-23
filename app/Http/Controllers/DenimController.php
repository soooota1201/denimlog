<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Denims\CreateDenimRequest;
use App\Http\Requests\Denims\UpdateDenimRequest;
use Illuminate\Support\Facades\Auth;
use App\Denim;
use App\User;
use App\DenimRecord;

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
        $denims = Denim::where('user_id', $user->id)->get();
        
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
        $this->authorize('create', [Denim::class, $user]);

        $denim = Denim::create([
          'user_id' => Auth::id(),
          'bland_type' => $request->bland_type,
          'waist' => $request->waist,
          'wearing_count' => $request->wearing_count,
        ]);

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

      $records = DenimRecord::where('denim_id', $denim->id)->get();

      return view('denims.show', compact('user', 'denim', 'records'));
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
