
<?php

class DateHelper
{
  public static function getCurrentDate()
  {
    return date('Y-m-d');
  }

  public static function getWeeklyStartAndEndDate()
  {
    $start_date = date('Y-m-d');

    $currentTime = time();
    $oneWeekFromNow = strtotime("+7 day", $currentTime);
    $end_date = date('Y-m-d', $oneWeekFromNow);

    return ['start_date' => $start_date, 'end_date' => $end_date];
  }

  public static function getMonthlyStartAndEndDate()
  {
    $start_date = date('Y-m-d');

    $currentTime = time();
    $oneMonthFromNow = strtotime("+1 month", $currentTime);
    $end_date = date('Y-m-d', $oneMonthFromNow);

    return ['start_date' => $start_date, 'end_date' => $end_date];
  }

  public static function getYearlyStartAndEndDate()
  {
    $start_date = date('Y-m-d');

    $currentTime = time();
    $oneYearFromNow = strtotime("+1 year", $currentTime);
    $end_date = date('Y-m-d', $oneYearFromNow);

    return ['start_date' => $start_date, 'end_date' => $end_date];
  }
}
