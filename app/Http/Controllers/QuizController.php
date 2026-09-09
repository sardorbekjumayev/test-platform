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
        $subjects = Subject::all();
        $quizzes = Quiz::where('subject_id', $subject->id)->latest()->paginate(15);
        $id = $subject->id;
        return view('admin.quizzes.index', compact('subjects', 'quizzes', 'id', 'subject'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Subject $subject)
    {
        $subjects = Subject::all();
        $subject_id = $subject->id;
        
        return view('admin.quizzes.create', compact('subjects', 'subject_id', 'subject'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Subject $subject)
    {
        $request->validate([
            'question' => 'required|string|max:1000',
            'type' => 'nullable|in:single,multiple',
            'options' => 'required|array|size:4',
            'options.*' => 'required|string|max:255',
            'correct' => 'required',
        ]);

        $type = $request->input('type', 'single');

        if ($type === 'multiple') {
            $selectedIndices = (array) $request->input('correct', []);
            $selectedAnswers = [];
            foreach ($selectedIndices as $idx) {
                if (isset($request->options[$idx]) && $request->options[$idx] !== '') {
                    $selectedAnswers[] = $request->options[$idx];
                }
            }
            $answer = json_encode(array_values($selectedAnswers), JSON_UNESCAPED_UNICODE);
        } else {
            $correctIndex = is_array($request->correct) ? ($request->correct[0] ?? 0) : $request->correct;
            $answer = $request->options[$correctIndex] ?? '';
        }

        Quiz::create([
            'subject_id' => $subject->id,
            'type' => $type,
            'quiz' => $request->question,
            'option1' => $request->options[0] ?? '',
            'option2' => $request->options[1] ?? '',
            'option3' => $request->options[2] ?? '',
            'option4' => $request->options[3] ?? '',
            'answer' => $answer,
        ]);

        return redirect()
            ->route('quizzes.index', $subject->id)
            ->with('success', 'Savol muvaffaqiyatli qo‘shildi!');
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
        $subjects = Subject::all();
        return view('admin.quizzes.edit', compact('subject', 'quiz', 'subjects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subject $subject, Quiz $quiz)
    {
        if ($quiz->subject_id !== $subject->id) {
            abort(404);
        }

        $request->validate([
            'question' => 'required|string|max:1000',
            'type' => 'nullable|in:single,multiple',
            'options' => 'required|array|size:4',
            'options.*' => 'required|string|max:255',
            'correct' => 'required',
        ]);

        $type = $request->input('type', 'single');

        if ($type === 'multiple') {
            $selectedIndices = (array) $request->input('correct', []);
            $selectedAnswers = [];
            foreach ($selectedIndices as $idx) {
                if (isset($request->options[$idx]) && $request->options[$idx] !== '') {
                    $selectedAnswers[] = $request->options[$idx];
                }
            }
            $answer = json_encode(array_values($selectedAnswers), JSON_UNESCAPED_UNICODE);
        } else {
            $correctIndex = is_array($request->correct) ? ($request->correct[0] ?? 0) : $request->correct;
            $answer = $request->options[$correctIndex] ?? '';
        }

        $quiz->update([
            'type' => $type,
            'quiz' => $request->question,
            'option1' => $request->options[0] ?? '',
            'option2' => $request->options[1] ?? '',
            'option3' => $request->options[2] ?? '',
            'option4' => $request->options[3] ?? '',
            'answer' => $answer,
        ]);

        return redirect()
            ->route('quizzes.index', $subject->id)
            ->with('success', 'Savol muvaffaqiyatli yangilandi!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $quiz = Quiz::findOrFail($id);
        $subjectId = $quiz->subject_id;
        $quiz->delete();

        return back()->with('success', 'Savol muvaffaqiyatli o‘chirildi!');
    }
}
