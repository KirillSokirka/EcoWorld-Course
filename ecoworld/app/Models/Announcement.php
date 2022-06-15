<?php

namespace App\Models;

use App\Filters\AnnouncementFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Announcement extends Model
{
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function images()
    {
        return $this->belongsToMany(Image::class);
    }

    public function scopeFilter(Builder $builder, $request)
    {
        return (new AnnouncementFilter($request))->filter($builder);
    }
}
