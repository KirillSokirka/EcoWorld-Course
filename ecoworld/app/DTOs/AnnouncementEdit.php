<?php

namespace App\DTOs;

use Spatie\DataTransferObject\DataTransferObject;

class AnnouncementEdit extends DataTransferObject
{
    public string $title;
    public string $location;
    public string $date;
    public array $images;
    public string $description;
    public int $id;
}
