<?php

namespace App\Repositories;

use App\DTOs\AnnouncementCreate;
use App\DTOs\AnnouncementHome;
use App\DTOs\AnnouncementInfo;
use App\Models\Announcement;
use App\Models\Announcement as AnnouncementAlias;
use App\Models\Image;
use App\Repositories\Abstract\IAnnouncementRepository;

class AnnouncementRepository implements IAnnouncementRepository
{
    /**
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function GetAll() : array
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
                likeCount: $announcement->like_count
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
                likeCount: $announcement->like_count
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
        $this->processImages($item);
    }

    public function Update(AnnouncementAlias $item)
    {
        // TODO: Implement Update() method.
    }

    public function Delete(int $id)
    {
        // TODO: Implement Delete() method.
    }

    private function processImages(AnnouncementCreate $item)
    {
        $announcement = Announcement::where('title', '=', $item->title)->first();
        if (isset($item->images->first)) {
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
}
