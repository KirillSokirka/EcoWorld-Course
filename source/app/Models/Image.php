<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Image extends Model
{
    public function announcements(): BelongsToMany
    {
        return $this->belongsToMany(Announcement::class);
    }
}
