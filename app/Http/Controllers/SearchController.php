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
    
    public function searchDenim(Request $request)
    {
      $denim = request()->query('denim');
      if($denim)
      {
        $denims = Denim::where('bland_type', 'LIKE', "%{$denim}%")
        ->orWhere('waist','LIKE', "%{$denim}%")
        ->orWhere('wearing_count','LIKE', "%{$denim}%")
        ->simplePaginate(1);

      } else {
        $denims = Denim::simplePaginate(3);
      };
      return view('denims.index')->with('denims', $denims);
    }
}


