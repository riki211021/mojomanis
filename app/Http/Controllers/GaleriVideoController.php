<?php

namespace App\Http\Controllers;

use App\Models\GaleriVideo;
use Illuminate\Http\Request;

class GaleriVideoController extends Controller
{
    // ---- ADMIN ----
    public function index()
    {
        $data = GaleriVideo::latest()->paginate(10);
        return view('admin.video.index', compact('data'));
    }

    public function create()
    {
        return view('admin.video.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
        ]);

        $thumbnail = null;
        $video = null;

        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail')->store('video-thumbnail', 'public');
        }

        if ($request->hasFile('video')) {
            $video = $request->file('video')->store('video-upload', 'public');
        }

        GaleriVideo::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'thumbnail' => $thumbnail,
            'video' => $video,
            'link_youtube' => $request->link_youtube,
        ]);

        return redirect()->route('admin.video.index')
    ->with('success', 'Video berhasil ditambahkan!');

    }

    public function edit(GaleriVideo $video)
    {
        return view('admin.video.edit', compact('video'));
    }

    public function update(Request $request, GaleriVideo $video)
    {
        $thumbnail = $video->thumbnail;
        $vid = $video->video;

        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail')->store('video-thumbnail', 'public');
        }

        if ($request->hasFile('video')) {
            $vid = $request->file('video')->store('video-upload', 'public');
        }

        $video->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'thumbnail' => $thumbnail,
            'video' => $vid,
            'link_youtube' => $request->link_youtube,
        ]);

        return redirect()->route('admin.video.index')->with('success', 'Video berhasil diupdate!');
    }

    public function destroy(GaleriVideo $video)
    {
        $video->delete();
        return back()->with('success', 'Video berhasil dihapus!');
    }

    public function public()
{
    $videos = GaleriVideo::latest()->get();
    return view('video.public', compact('videos'));
}

public function show($id)
{
    $video = GaleriVideo::findOrFail($id);
    return view('video.show', compact('video'));
}



}
