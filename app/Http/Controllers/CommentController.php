<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Comment;
use App\User;
use App\Denim;
use App\DenimRecord;
use Mail;

class CommentController extends Controller
{
    public function __construct() {
      $this->middleware('auth')->only(['show', 'create', 'store', 'destroy']);
    }

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
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(User $user, Denim $denim, DenimRecord $record, Request $request)
    {
        // dd($request->id);
        $comment = Comment::create([
          'user_id' => Auth::id(),
          'denim_record_id' => $request->id,
          'body' => $request->body
        ]);

        // if($record->user_id !== Auth::id()) {
          $data = [];
          $email = $user->email;
  
          Mail::send(
          'mails.contact', 
          [
            'sender' => Auth::user(),
            'receiver' => $user,
            'denim' => $denim,
            'record' => $record,
            'body' => $request->body,
          ]
          , function ($message) use ($email) {
              $message->to($email)->subject('[DenimLog] あなたの投稿にコメントがありました！');
          });
        // }

        session()->flash('success', 'コメントされました！');
        return redirect()->back();
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
    public function destroy(User $user, Denim $denim, DenimRecord $record, Comment $comment)
    {
        $comment = Comment::find($comment->id);
        if($comment->user_id !== Auth::id())
        {
          abort(404);
        };  
        $comment->delete();

        session()->flash('alert', 'コメント削除されました。');
        return redirect()->back();
    }
}
