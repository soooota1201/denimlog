<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Denim;
use App\DenimRecord;

class SearchController extends Controller
{
    public function searchRecord(Request $request)
    {
      $record = request()->query('record');
      if($record)
      {
        $records = DenimRecord::where('body', 'LIKE', "%{$record}%")
        ->orWhere('wearing_place','LIKE', "%{$record}%")
        ->orWhere('wearing_day','LIKE', "%{$record}%")
        ->simplePaginate(1);

      } else {
        $records = DenimRecord::simplePaginate(3);
      };
      return view('denim_records.index')
      ->with('records', $records);
    }
}


