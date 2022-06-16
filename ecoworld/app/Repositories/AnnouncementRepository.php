<?php

namespace App\Repositories;

use App\DTOs\AnnouncementStore;
use App\DTOs\AnnouncementHome;
use App\DTOs\AnnouncementInfo;
use App\Models\Announcement;
use App\Models\Image;
use App\Repositories\Abstract\IAnnouncementRepository;
use Illuminate\Http\Request;

class AnnouncementRepository implements IAnnouncementRepository
{
    /**
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function GetAll(Request $request) : array
    {
        $announcements = Announcement::filter($request)->get();
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

    public function Create(AnnouncementStore $item)
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
                date: date('c', strtotime($announcement->date)),
                images: $images,
                likeCount: $announcement->like_count,
                author: $announcement->author->username
            );
        }
        return $element;
    }

    public function Update(AnnouncementStore $item)
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

    private function processImages(AnnouncementStore $item)
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
}
