<?php

namespace App\Filters;

class DateFilter
{
    public function filter($builder, $value)
    {
        $order = '';
        if ($value == '')
        return $builder->orderBy('date', );
    }
}
