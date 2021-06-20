<?php
namespace App\Calendar;

/**
* 余白を出力するためのクラス
*/
class BlankDay extends Day {
	
  function getClassName(){
		return "day-blank";
	}

	/**
	 * @return 
	 */
	function render(){
		return '';
	}

}