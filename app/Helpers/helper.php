<?php
use Carbon\Carbon;
if (!function_exists('DateFormatter')) {
    /**
     * Format a date in "August 2, 2021" format.
     *
     * @param  string  $date
     * @return string
     */
    function dateFormatter($date)
    {
        return Carbon::parse($date)->format('F j, Y');
    }
}