<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\TestInstance;
use App\Models\TestInstanceQuestion;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    // 1) TEST BOSHLASH
    public function start($subjectId)
    {
        // 1. Test instance yaratamiz
        $instance = TestInstance::create([
            'user_id' => Auth::id(),
            'subject_id' => $subjectId,
            'district' => Auth::user()->district,
            'expires_at' => now()->addMinutes(20),
        ]);

        // 2. Random 20 ta savol tanlash (agar 20 ta bo'lmasa mavjudlarini oladi)
        $questions = Quiz::where('subject_id', $subjectId)
                         ->inRandomOrder()
                         ->take(20)
                         ->get();

        // 3. Ularni test_instance_questions ga yozish
        foreach ($questions as $q) {
            TestInstanceQuestion::create([
                'test_instance_id' => $instance->id,
                'quiz_id' => $q->id,
            ]);
        }

        // 4. Userni test sahifasiga yo‘naltirish
        return redirect()->route('user.test.show', $instance->id);
    }

    // 2) TESTNI KO‘RSATISH
    public function show(TestInstance $testInstance)
    {
        $questions = $testInstance->questions()->with('quiz')->get();
        // Agar test muddati hali tugamagan bo'lsa qolgan soniyalarni, aks holda 0 qaytadi
        $remainingSeconds = $testInstance->expires_at->isFuture()
            ? now()->diffInSeconds($testInstance->expires_at)
            : 0;

        return view('user.test.solve', compact('testInstance', 'questions', 'remainingSeconds'));
    }

    // 3) TESTNI YAKUNLASH
    public function finish(TestInstance $testInstance)
    {
        foreach ($testInstance->questions as $item) {
            $quiz = $item->quiz;
            $rawInput = request()->input('answer_'.$item->id);

            if ($quiz && $quiz->isMultiple()) {
                // Ko'p javobli savol
                $userAnswers = is_array($rawInput) 
                    ? array_values(array_filter($rawInput, fn($val) => !is_null($val) && $val !== '')) 
                    : ($rawInput ? [$rawInput] : []);

                $item->user_answer = !empty($userAnswers) ? json_encode($userAnswers, JSON_UNESCAPED_UNICODE) : null;

                $correctAnswers = $quiz->correct_answers;

                $userSorted = $userAnswers;
                $correctSorted = $correctAnswers;
                sort($userSorted);
                sort($correctSorted);

                $item->is_correct = (!empty($correctSorted) && $userSorted === $correctSorted);
            } else {
                // Yagona to'g'ri javobli savol
                $userAnswer = is_array($rawInput) ? ($rawInput[0] ?? null) : $rawInput;
                $item->user_answer = $userAnswer;
                $item->is_correct = ($quiz && !is_null($userAnswer) && (string)$userAnswer === (string)$quiz->answer);
            }

            $item->save();
        }

        // umumiy score
        $score = $testInstance->questions()->where('is_correct', true)->count();
        $testInstance->score = $score;
        $testInstance->save();
        $details = $testInstance->questions()->with('quiz')->get();

        return view('user.test.result', compact('testInstance', 'details'));
    }
}
