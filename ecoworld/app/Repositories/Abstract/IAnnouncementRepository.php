<?php

namespace App\Repositories\Abstract;

use App\DTOs\AnnouncementCreate;
use App\DTOs\AnnouncementEdit;
use App\DTOs\AnnouncementInfo;

interface IAnnouncementRepository
{
    public function GetAll(?int $user_id) : array;
    public function Get(int $id) : AnnouncementInfo;
    public function GetUserAnnouncement(int $user_id) : array;
    public function Create(AnnouncementCreate $item);
    public function Update(AnnouncementEdit $item);
    public function Delete(int $id);
    public function AddVisitor(int $announcement_id, int $user_id);
}
