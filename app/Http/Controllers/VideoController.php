<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Subject;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Subject $subject)
    {
        $subjects = Subject::all();
        $videos_count = Video::where('subject_id', $subject->id)->count();
        $videos = Video::where('subject_id', $subject->id)->get();
        return view('admin.videos.index', compact('subjects', 'videos_count', 'videos', 'subject'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'subject_id' => 'required|exists:subjects,id',
        'title'      => 'required|string|max:255',
        'url'        => 'required|url',
    ]);

    Video::create($request->all());

    return back()->with('success', 'Video muvaffaqiyatli qo‘shildi!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $video = Video::findOrFail($id);
        $video->delete();

        return back()->with('success', 'Video muvaffaqiyatli o‘chirildi!');
    }
}
