<?php

namespace App\Repositories\Abstract;

use App\DTOs\AnnouncementCreate;
use App\DTOs\AnnouncementInfo;
use App\Models\Announcement;
use http\Env\Request;

interface IAnnouncementRepository
{
    public function GetAll(Request $request) : array;
    public function Get(int $id) : AnnouncementInfo;
    public function GetUserAnnouncement(int $user_id) : array;
    public function Create(AnnouncementCreate $item);
    public function Update(Announcement $item);
    public function Delete(int $id);
}
