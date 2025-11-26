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

        // 2. Random 20 ta savol tanlash
        $questions = Quiz::where('subject_id', $subjectId)
                         ->inRandomOrder()
                         ->take(5)
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

            $userAnswer = request()->input('answer_'.$item->id);

            // user javobini saqlaymiz
            $item->user_answer = $userAnswer;

            // to‘g‘ri yoki noto‘g‘ri
            $item->is_correct = ($userAnswer == $item->quiz->answer);

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
