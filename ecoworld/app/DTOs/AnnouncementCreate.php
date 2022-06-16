<?php

namespace App\DTOs;

use Spatie\DataTransferObject\DataTransferObject;

class AnnouncementCreate extends DataTransferObject
{
    public string $title;
    public string $location;
    public string $date;
    public array $images;
    public string $description;
    public int $author_id;
}
