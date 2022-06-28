<?php


namespace App\Date;


class DateHandling
{
    public  static function getListDayToMonth(){
        $today = today();
        $dates = [];
        for($i=1; $i < $today->daysInMonth + 1; ++$i) {
            $dates[] = \Carbon\Carbon::createFromDate($today->year, $today->month, $i)->format('Y-m-d');
        }
        return $dates;
    }
}
