<?php

namespace App\Filters;

use App\Filters\Abstract\AbstractFilter;

class AnnouncementFilter extends AbstractFilter
{
    protected $filters = [
        'type' => DateFilter::class
    ];
}
