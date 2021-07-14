<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Denim;
use App\DenimRecord;

class SearchController extends Controller
{

    public function index(User $user) {
      return view('search_results.index', compact('user'));
    }

    public function searchRecord(Request $request, User $user)
    {
      $record = request()->query('record');
      if($record)
      {
        $records = DenimRecord::where('body', 'LIKE', "%{$record}%")
        ->orWhere('wearing_place','LIKE', "%{$record}%")
        ->orWhere('wearing_day','LIKE', "%{$record}%")
        ->orWhere('bland_type','LIKE', "%{$record}%")->get();
      } else {
        $records = DenimRecord::simplePaginate(3);
      };
      return view('search_results.index', compact('records', 'user'));
    }
}


