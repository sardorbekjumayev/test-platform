<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Subject $subject)
    {
        $documents = Document::where('subject_id', $subject->id)->get();
        $subject = Subject::find($subject->id);
        $subjects = Subject::all();
        return view('admin.documents.index', compact('documents', 'subject', 'subjects'));
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
    public function store(Request $request, Subject $subject)
    {
        $request->validate([
            'title'     => 'required|string|max:255',
            'document'  => 'required|file|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx|max:20480', // 20MB
        ]);
        $extension = $request->file('document')->getClientOriginalExtension();
        $path = $request->file('document')->store('documents/subject_' . $subject->id, 'public');

        Document::create([
            'subject_id' => $subject->id,
            'title'      => $request->title,
            'type'       => $extension,
            'file_path'  => $path,
        ]);

        return redirect()->back()->with('success', 'Hujjat muvaffaqiyatli qo‘shildi!');
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
public function destroy(Subject $subject, Document $document)
{

    Storage::disk('public')->delete($document->file_path);
    $document->delete();

    return back()->with('success', 'Hujjat o‘chirildi!');
}
}
