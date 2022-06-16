<?php

namespace App\Filters;
use Carbon\Carbon;

class DateFilter
{
    public function filter($builder, $value)
    {
        if ($value == 'Month') {
            return $builder->where("date", "<", Carbon::now()->addDay());
        } elseif ($value == 'Week') {
            return $builder->where("date", "<", Carbon::now()->addWeek());
        } else {
            return $builder;
        }
    }
}
