<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Subject;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Subject $subject)
    {
        $subjects = Subject::get();
        $quizzes = Quiz::where('subject_id', $subject->id)->paginate(2);
        $id = $subject->id;
        return view('admin.quizzes.index', compact('subjects', 'quizzes', 'id'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Subject $subject)
    {
        $subjects = Subject::get();
        $subject_id = $subject->id;
        
        return view('admin.quizzes.create', compact('subjects', 'subject_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Subject $subject)
    {
        // dd($request->all());
        // dd($subject->id);

        $request->validate([
            'question' => 'required|string|max:1000',
        ]);
        
        Quiz::create([
            'subject_id' => $subject->id,
            'quiz' => $request->question,
            'option1' => $request->options[0],
            'option2' => $request->options[1],
            'option3' => $request->options[2],
            'option4' => $request->options[3],
            'answer' => $request->options[$request->correct],
        ]);

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
public function edit(Subject $subject, Quiz $quiz)
{
    if ($quiz->subject_id !== $subject->id) {
        abort(404);
    }
    $subjects = Subject::get();
    return view('admin.quizzes.edit', compact('subject', 'quiz', 'subjects'));
}

public function update(Request $request, Subject $subject, Quiz $quiz)
{
    if ($quiz->subject_id !== $subject->id) {
        abort(404);
    }

    $request->validate([
        'question'       => 'required|string|max:1000',
        'options'        => 'required|array|size:4',
        'options.*'      => 'required|string|max:255',
        'correct'        => 'required|integer|between:0,3',
    ]);

    $quiz->update([
        'question'       => $request->question,
        'options'        => $request->options,
        'correct_answer' => $request->correct,
    ]);

    return redirect()
        ->route('subjects.quizzes.index', $subject->id)
        ->with('success', 'Savol muvaffaqiyatli yangilandi!');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
