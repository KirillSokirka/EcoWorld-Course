<?php

namespace App\Repositories\Abstract;

use App\DTOs\AnnouncementStore;
use App\DTOs\AnnouncementInfo;
use Illuminate\Http\Request;

interface IAnnouncementRepository
{
    public function GetAll(Request $request) : array;
    public function Get(int $id) : AnnouncementInfo;
    public function GetUserAnnouncement(int $user_id) : array;
    public function Create(AnnouncementStore $item);
    public function Update(AnnouncementStore $item);
    public function Delete(int $id);
}
