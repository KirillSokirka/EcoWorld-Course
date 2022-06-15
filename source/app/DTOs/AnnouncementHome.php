<?php

namespace App\DTOs;

use Spatie\DataTransferObject\DataTransferObject;

class AnnouncementHome extends DataTransferObject
{
    public int $id;
    public string $title;
    public string $location;
    public string $date;
    public array $images;
    public int $likeCount;
}
