<?php

namespace App\Repositories;

use App\DTOs\AnnouncementCreate;
use App\DTOs\AnnouncementEdit;
use App\DTOs\AnnouncementHome;
use App\DTOs\AnnouncementInfo;
use App\Models\Announcement;
use App\Models\AnnouncementUser;
use App\Models\Image;
use App\Models\User;
use App\Repositories\Abstract\IAnnouncementRepository;

class AnnouncementRepository implements IAnnouncementRepository
{
    /**
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function GetAll(?int $user_id) : array
    {
        $announcements = Announcement::all();
        $announcementsDtos = array();
        foreach ($announcements as $announcement) {
            $images = array();
            foreach ($announcement->images as $image) {
                $images[] = $image->url;
            }
                $announcementsDtos[] = new AnnouncementHome(
                    title: $announcement->title,
                    id: $announcement->id,
                    location: $announcement->location,
                    date: date('d.m.Y G:i', strtotime($announcement->date)),
                    images: $images,
                    likeCount: $announcement->like_count,
                    liked: isset($user_id) && $this->CheckIfUserLikeIt($user_id, $announcement->id)
                );
            }
        return $announcementsDtos;
    }

    public function GetUserAnnouncement(int $user_id): array
    {
        $announcements = Announcement::all()->where('author_id', $user_id);

        $announcementsDtos = array();
        foreach ($announcements as $announcement) {
            $images = array();
            foreach ($announcement->images as $image) {
                $images[] = $image->url;
            }
            $announcementsDtos[] = new AnnouncementHome(
                title: $announcement->title,
                id: $announcement->id,
                location: $announcement->location,
                date: date('d.m.Y G:i', strtotime($announcement->date)),
                images: $images,
                likeCount: $announcement->like_count,
                liked: isset($user_id) ? $this->CheckIfUserLikeIt($user_id, $announcement->id) : false
            );
        }
        return $announcementsDtos;
    }

    /**
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function Get(int $id) : AnnouncementInfo
    {
        $announcement = Announcement::with( 'author')->find($id);
        $element = null;
        if (isset($announcement)) {
            $images = array();
            foreach ($announcement->images as $image) {
                $images[] = $image->url;
            }
            $element = new AnnouncementInfo(
                title: $announcement->title,
                description: $announcement->description,
                id: $announcement->id,
                location: $announcement->location,
                date: date('d.m.Y G:i', strtotime($announcement->date)),
                images: $images,
                likeCount: $announcement->like_count,
                author: $announcement->author->username
            );
        }
        return $element;
    }

    public function Create(AnnouncementCreate $item)
    {
        $announcement = new Announcement();
        $announcement->title = $item->title;
        $announcement->description = $item->description;
        $announcement->location = $item->location;
        $announcement->date = \DateTime::createFromFormat("d.m.Y G:i", $item->date);
        $announcement->author_id = $item->author_id;
        $announcement->save();
        $this->processCreateImages($item);
    }

    public function GetForUpdate(int $id) : AnnouncementInfo
    {
        $announcement = Announcement::with( 'author')->find($id);
        $element = null;
        if (isset($announcement)) {
            $images = array();
            foreach ($announcement->images as $image) {
                $images[] = $image->url;
            }
            $element = new AnnouncementInfo(
                title: $announcement->title,
                description: $announcement->description,
                id: $announcement->id,
                location: $announcement->location,
                date: date('Y-m-d\TH:i', strtotime($announcement->date)),
                images: $images,
                likeCount: $announcement->like_count,
                author: $announcement->author->username
            );
        }
        return $element;
    }

    public function Update(AnnouncementEdit $item)
    {
        $announcement = Announcement::find($item->id);
        $announcement->title = $item->title;
        $announcement->description = $item->description;
        $announcement->location = $item->location;
        $announcement->date = \DateTime::createFromFormat("d.m.Y G:i", $item->date);
        $announcement->save();
        $this->processImages($item);
    }

    public function Delete(int $id)
    {
        $announcement = Announcement::find($id);
        foreach ($announcement->images as $img) {
            $announcement->images()->detach($img);
        }
        $announcement->delete();
    }

    private function processImages(AnnouncementEdit $item)
    {
        $announcement = Announcement::where('title', '=', $item->title)->first();
        $existingImages = $announcement->images;
        foreach ($existingImages as $img) {
            $announcement->images()->detach($img);
        }
        if (isset($item->images[0])) {
            foreach ($item->images as $i) {
                $img = new Image();
                $filename = $i->getClientOriginalName();
                $i->move(public_path().'/images/', $filename);;
                $img->url = $filename;
                $img->save();
                $announcement->images()->attach($img);
            }
        } else {
            $img = Image::all()->where('url', 'default-rubbish.jpg')->first();
            $announcement->images()->attach($img);
        }
    }

    private function processCreateImages(AnnouncementCreate $item)
    {
        $announcement = Announcement::where('title', '=', $item->title)->first();
        if (isset($item->images[0])) {
            foreach ($item->images as $i) {
                $img = new Image();
                $filename = $i->getClientOriginalName();
                $i->move(public_path().'/images/', $filename);;
                $img->url = $filename;
                $img->save();
                $announcement->images()->attach($img);
            }
        } else {
            $img = Image::all()->where('url', 'default-rubbish.jpg')->first();
            $announcement->images()->attach($img);
        }
    }

    public function AddVisitor(int $announcement_id, int $user_id)
    {
        $announcement = Announcement::find($announcement_id);
        $unique_user = true;
        foreach ($announcement->users as $value) {
            if($value->id == $user_id) {
                $unique_user = false;
            }
        }
        if ($unique_user) {
            $user = User::find($user_id);
            $announcement->users()->attach($user, ['respond' => true, 'like'=>false]);
            $announcement->like_count += 1;
            $announcement->save();
        }
    }

    public function AddLike(int $announcement_id, int $user_id)
    {
        $exisingNote = AnnouncementUser::where('announcement_id', $announcement_id)
            ->where('user_id', $user_id)->first();

        if (isset($exisingNote)) {
            if ($exisingNote->like) {
                $exisingNote->like = false;
            } else {
                $exisingNote->like = true;
            }
        } else {
            $exisingNote = new AnnouncementUser();
            $exisingNote->like = true;
            $exisingNote->announcement_id = $announcement_id;
            $exisingNote->user_id = $user_id;
            $exisingNote->respond = false;
        }
        $exisingNote->save();
    }

    private function CheckIfUserLikeIt($user_id, $announcement_id) {
        $exisingNote = AnnouncementUser::where('announcement_id', $announcement_id)
            ->where('user_id', $user_id)->where('like', true)->first();
        return isset($exisingNote);
    }
}
