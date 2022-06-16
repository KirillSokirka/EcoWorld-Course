<?php

namespace App\Http\Controllers;

use App\DTOs\AnnouncementStore;
use App\Http\Requests\AnnouncementCreateRequest;
use App\Http\Requests\AnnouncementUpdateRequest;
use App\Repositories\Abstract\IAnnouncementRepository;
use App\Repositories\AnnouncementRepository;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

function getAllImages($validated) {

    $files = array();
    if(isset($validated['images']))
    {
        foreach($validated['images'] as $image)
        {
            $files[] = $image;
        }
    }
    return $files;
}

class AnnouncementController extends BaseController
{
    private IAnnouncementRepository $repository;

    public function __construct(AnnouncementRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        return response()->json([
            'data' => $this->repository->GetAll($request)
        ]);
    }

    public function indexWithFilter(Request $request)
    {
        return response()->json([
            'data' => $this->repository->GetAll($request),
            'uri' => ''
        ]);
    }

    public function show($id) {
        $item = $this->repository->Get($id);
        return view('announcements.show', compact('item'));
    }

    public function create()
    {
        if (Auth::check())
            return view('announcements.create');
        else
            return redirect('/');
    }

    /**
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function store(AnnouncementCreateRequest $request)
    {
        $validated = $request->validated();
        $author_id = Auth::id();
        $dto = new AnnouncementStore(
            title: $validated['title'],
            description: $validated['description'],
            location: $validated['location'],
            date: date('d.m.Y G:i', strtotime($validated['date'])),
            images: getAllImages($validated),
            author_id: $author_id
        );
        $this->repository->Create($dto);
        return redirect('/');
    }

    public function user_announcements($id)
    {
        return response()->json([
            'data' => $this->repository->GetUserAnnouncement($id)
        ]);
    }

    public function byUser() {
        if (!Auth::check())
            return redirect('/');
        else {
            $id = Auth::id();
            return view('announcements.byuser', compact('id'));
        }
    }

    public function edit($id)
    {
        if (Auth::check()) {
            $item = $this->repository->GetForUpdate($id);
            return view('announcements.edit', compact('item'));
        }
        else
            return redirect('/');
    }

    public function editStore(AnnouncementUpdateRequest $request) {
        $validated = $request->validated();
        $dto = new AnnouncementStore(
            id: $validated['id'],
            title: $validated['title'],
            description: $validated['description'],
            location: $validated['location'],
            date: date('d.m.Y G:i', strtotime($validated['date'])),
            images: getAllImages($validated),
        );
        $this->repository->Update($dto);
        return redirect('/');
    }

    public function delete($id) {

        $this->repository->Delete($id);
        return redirect('/');
    }


}
