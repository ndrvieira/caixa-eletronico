<?php

namespace App\Helpers;

use DateTime;

class DateHelper
{
    public static function convertToDbFormat($date)
    {
        return DateTime::createFromFormat('d/m/Y', $date)->format('Y-m-d');
    }

    public static function convertToBrFormat($date)
    {
        return DateTime::createFromFormat('Y-m-d', $date)->format('d/m/Y');
    }
}
