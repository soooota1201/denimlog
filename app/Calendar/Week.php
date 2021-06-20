<?php

namespace App\Calendar;
use Carbon\Carbon;

class Week {
  protected $carbon;
  protected $index = 0;

  function __construct($date, $index = 0) {
    $this->carbon = new Carbon($date);
    $this->index = $index;
  }

  function getClassName() {
    return "week-" . $this->index;
  }

  /**
   * @return WeekDay[];
   */
  function getDays() {
    $days = [];

    //開始日〜終了日
		$startDay = $this->carbon->copy()->startOfWeek();
		$lastDay = $this->carbon->copy()->endOfWeek();

		//作業用
		$tmpDay = $startDay->copy();

    while($tmpDay->lte($lastDay)) {
      if($tmpDay->month != $this->carbon->month) {
        $day = new BlankDay($tmpDay->copy());
        $days[] = $day;
        $tmpDay->addDay(1);
        continue;
      }

      $day = new Day($tmpDay->copy());
      $days[] = $day;
      $tmpDay->addDay(1);
    }

    return $days;
  }
}
