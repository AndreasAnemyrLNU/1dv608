<?php
/**
 * Created by PhpStorm.
 * User: AndreasAnemyr
 * Date: 2015-09-18
 * Time: 11:06
 */

namespace model;


class DateTimeModel
{
    private $year;

    private $month;

    private $hour;

    private $minute;

    private $second;

    private $dayOfTheWeekTextual;

    private $suffixEnglish;

    private $dayOfMonth;

    function __construct()
    {
        //TODO 0001 fix better solution for Timezone. Another OO oriented solution?
        $timestamp = time();

        $this->setYear(date("Y", $timestamp));      //2015
        $this->setMonth(date("F", $timestamp));     //01,31
        $this->setHour(date("H", $timestamp));      //01, 23
        $this->setMinute(date("i", $timestamp));    //01, 59
        $this->setSecond(date("s", $timestamp));    //01, 59
        $this->setdayOfTheWeekTextual(date("l", $timestamp));    //Thursday
        $this->setSuffixEnglish(date("S", $timestamp)); //st rd etc
        $this->setDayOfMonth(date("j", $timestamp));    //6, 13 , 1 one digit
    }

    /**
     * @return mixed
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param mixed $year
     */
    public function setYear($year)
    {
        $this->year = $year;
    }

    /**
     * @return mixed
     */
    public function getMonth()
    {
        return $this->month;
    }

    /**
     * @param mixed $month
     */
    public function setMonth($month)
    {
        $this->month = $month;
    }

    /**
     * @return mixed
     */
    public function getHour()
    {
        return $this->hour;
    }

    /**
     * @param mixed $hour
     */
    public function setHour($hour)
    {
        $this->hour = $hour;
    }

    /**
     * @return mixed
     */
    public function getMinute()
    {
        return $this->minute;
    }

    /**
     * @param mixed $minute
     */
    public function setMinute($minute)
    {
        $this->minute = $minute;
    }

    /**
     * @return mixed
     */
    public function getSecond()
    {
        return $this->second;
    }

    /**
     * @param mixed $second
     */
    public function setSecond($second)
    {
        $this->second = $second;
    }

    /**
     * @return mixed
     */
    public function getDayOfTheWeekTextual()
    {
        return $this->dayOfTheWeekTextual;
    }

    /**
     * @param mixed $dayOfTheWeekTextual
     */
    public function setDayOfTheWeekTextual($dayOfTheWeekTextual)
    {
        $this->dayOfTheWeekTextual = $dayOfTheWeekTextual;
    }

    /**
     * @return mixed
     */
    public function getSuffixEnglish()
    {
        return $this->suffixEnglish;
    }

    /**
     * @param mixed $suffixEnglish
     */
    public function setSuffixEnglish($suffixEnglish)
    {
        $this->suffixEnglish = $suffixEnglish;
    }

    /**
     * @return mixed
     */
    public function getDayOfMonth()
    {
        return $this->dayOfMonth;
    }

    /**
     * @param mixed $dayOfMonth
     */
    public function setDayOfMonth($dayOfMonth)
    {
        $this->dayOfMonth = $dayOfMonth;
    }
}