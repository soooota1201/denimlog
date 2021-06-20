<?php

namespace App\Calendar;
use Carbon\Carbon;

class Calendar {

	private $carbon;

	function __construct($date){
		$this->carbon = new Carbon($date);
	}
	/**
	 * タイトル
	 */
	public function getTitle(){
		return $this->carbon->format('Y年n月');
	}

	/**
	 * カレンダーを出力する
	 */
	function render(){
		$html = [];
		$html[] = '<div class="calendar">';
		$html[] = '<table class="table">';
		$html[] = '<thead>';
		$html[] = '<tr>';
		$html[] = '<th>月</th>';
		$html[] = '<th>火</th>';
		$html[] = '<th>水</th>';
		$html[] = '<th>木</th>';
		$html[] = '<th>金</th>';
		$html[] = '<th>土</th>';
    $html[] = '<th>日</th>';
		$html[] = '</tr>';
		$html[] = '</thead>';
    $html[] = '<tbody>';
    $weeks = $this->getWeeks();
    foreach($weeks as $week) {
      $html[] = '<tr class="' .$week->getClassName(). '">';
      $days = $week->getDays();
      foreach($days as $day) {
        $html[] = '<td class="' .$day->getClassName(). '">';
        $html[] = $day->render();
        $html[] = '</td>';
      };
      $html[] = '</tr>';
    };
    $html[] = '</tbody>';
		$html[] = '</table>';
		$html[] = '</div>';
		return implode("", $html);
	}

  /**
   * 週の情報を取得する
   */
  protected function getWeeks() {
    $weeks = [];
    $firstDay = $this->carbon->copy()->firstOfMonth();//初日
    $lastDay = $this->carbon->copy()->lastOfMonth();//月末まで
    $week = new Week($firstDay->copy());//１週目
    $weeks[] = $week;
    $temporallyDay = $firstDay->copy()->addDay(7)->startOfWeek();

    while($temporallyDay->lte($lastDay)) {
      $week = new Week($temporallyDay, count($weeks));
      $weeks[] = $week;
      $temporallyDay->addDay(7);
    }

    return $weeks;
  }
}