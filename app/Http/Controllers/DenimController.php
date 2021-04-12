<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Denims\CreateDenimRequest;
use App\Http\Requests\Denims\UpdateDenimRequest;
use Illuminate\Support\Facades\Auth;
use App\Denim;

class DenimController extends Controller
{
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
        return view('denim.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateDenimRequest $request)
    {
        $denim = Denim::create([
          'user_id' => Auth::id(),
          'bland_type' => $request->bland_type,
          'waist' => $request->waist,
          'wearing_count' => $request->wearing_count,
        ]);

        return redirect('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Denim $denim)
    {
        return view('denim.show', compact('denim'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Denim $denim)
    {
        return view('denim.edit', compact('denim'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDenimRequest $request, Denim $denim)
    {
        $denim->update([
          'user_id' => Auth::id(),
          'bland_type' => $request->bland_type,
          'waist' => $request->waist,
          'wearing_count' => $request->wearing_count
        ]);

        return redirect(route('denims.show', $denim->id))->with('success', '編集が完了しました！');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        
    }
}
