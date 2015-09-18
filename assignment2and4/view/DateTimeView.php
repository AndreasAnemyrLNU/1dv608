<?php

class DateTimeView {

	private $timestamp;

	function __construct(\model\DateTimeModel $timestamp)
	{
		$this->timestamp = $timestamp;
	}

	public function show() {

		//TODO Can be an idea to get this as an assoc array instead. Less callings to get values!
		$dow 	= $this->timestamp->getDayOfTheWeekTextual();
 		$dom 	= $this->timestamp->getDayOfMonth();
		$suf 	= $this->timestamp->getSuffixEnglish();
		$month 	= $this->timestamp->getMonth();
		$year 	= $this->timestamp->getYear();
		$hour 	= $this->timestamp->getHour();
		$min 	= $this->timestamp->getMinute();
		$sec	= $this->timestamp->getSecond();

		return "<p>$dow, the $dom$suf of $month $year, The time is $hour:$min:$sec</p>";
	}
}