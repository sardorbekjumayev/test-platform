<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
 
        $subjects = Subject::get();
        return view('admin.subjects.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subjects = Subject::get();
        return view('admin.subjects.create', compact('subjects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:subjects,name',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            $subject = new Subject();
            $subject->name = $request->input('name');

            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                // store in storage/app/public/subjects, make sure `php artisan storage:link` is run
                $path = $request->file('image')->store('subjects', 'public');
                $subject->image = $path;
            }

            $subject->save();

            return redirect()->route('subjects.index')->with('success', 'Subject created successfully.');
        } catch (\Exception $e) {
            // optionally log the exception: \Log::error($e);
            return redirect()->back()->withInput()->with('error', 'Failed to create subject.');
        }
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
public function edit(Subject $subject)
{
    $subjects = Subject::get();
    return view('admin.subjects.edit', compact('subject', 'subjects'));
}

public function update(Request $request, Subject $subject)
{
    $request->validate([
        'name'  => 'required|string|max:255|unique:subjects,name,'.$subject->id,
        'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
    ]);

    // 1. Faqat kerakli ma’lumotlarni o‘zimiz qo‘lda beramiz → fillable bilan hech qanday muammo yo‘q
    $subject->name = $request->name;

    // 2. Agar rasm yuklansa → eski rasmni o‘chiramiz, yangisini saqlaymiz
    if ($request->hasFile('image')) {

        // eski rasmni o‘chirish
        if ($subject->image) {
            Storage::disk('public')->delete($subject->image);   // bu yerda faqat "subjects/abc.jpg"
        }

        // yangi rasmni saqlash
        $subject->image = $request->file('image')->store('subjects', 'public');
    }

    // 3.save() → mass assignment emas, shuning uchun fillable kerak emas!
    $subject->save();

    return redirect()
        ->route('subjects.index')
        ->with('success', 'Fan muvaffaqiyatli yangilandi!');
}

    /**
     * Remove the specified resource from storage.
     */
public function destroy(Subject $subject) // Route Model Binding ishlatish eng yaxshisi!
{
    try {
        // Agar rasm mavjud bo‘lsa → o‘chiramiz
        if ($subject->image) {
            Storage::disk('public')->delete($subject->image);
        }

        // Subjectni o‘chiramiz
        $subject->delete();

        return redirect()
            ->route('subjects.index')
            ->with('success', 'Fan va unga tegishli rasm muvaffaqiyatli o‘chirildi!');

    } catch (\Exception $e) {
        // Agar biror xatolik bo‘lsa (masalan, fayl allaqachon o‘chirilgan bo‘lsa)
        return redirect()
            ->route('subjects.index')
            ->with('error', 'Fan o‘chirildi, lekin rasmni o‘chirishda xatolik yuz berdi.');
    }
}
}
