<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Denim;
use App\DenimRecord;

class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(User $user, Denim $denim, DenimRecord $record)
    {
        // dd($record->users());

        $record = DenimRecord::find($record->id);
        $record->users()->attach(Auth::id());
        $count = $record->users()->count();
        $result = true;
        return response()->json([
          'result' => $result,
          'count' => $count,
        ]);

        // return redirect()->route('users.records.show', compact('user', 'denim', 'record'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, Denim $denim, DenimRecord $record)
    {
        $record = DenimRecord::find($record->id);
        $record->users()->detach(Auth::id());
        $count = $record->users()->count();
        $result = false;
        return response()->json([
          'result' => $result,
          'count' => $count,
        ]);
        // return redirect()->route('users.records.show', compact('user', 'denim', 'record'));
    }

    public function count (User $user, Denim $denim, DenimRecord $record)
    {
        $record = DenimRecord::find($record->id);
        $count = $record->users()->count();
        return response()->json($count);
    }

    public function hasLike(User $user, Denim $denim, DenimRecord $record) {
      $record = DenimRecord::find($record->id);
      if ($record->users()->where('user_id', Auth::id())->exists()) {
          $result = true;
      } else {
          $result = false;
      }
      return response()->json($result);
    }
}
