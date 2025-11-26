<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\User;
use App\Models\Video;
use App\Models\Subject;
use App\Models\Document;
use App\Models\TestInstance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TestInstanceQuestion;

class UserController extends Controller
{
    public function index()
    {
        $users = User::count();
        $quizzes = Quiz::count();
        $subjects = Subject::count();
        return view('welcome', compact('users', 'quizzes', 'subjects'));
    }

    public function direction()
    {
        if (auth()->check()) {
            $user = auth()->user();
            if ($user->role === 'admin') {
                return redirect('/admin');
            } elseif ($user->role === 'user') {
                return redirect('/user');
            }
        }
        return redirect('/');
    }


    public function userDashboard()
    {
        $subjects = Subject::get();     
        $subjects_count = Subject::count();   
        return view('user.dashboard', compact('subjects', 'subjects_count'));
    }

public function adminDashboard()
{
    $data = [
        'users'           => User::count(),
        'subject_count'        => Subject::count(),
        'subjects'       => Subject::all(),
        'quizzes'         => Quiz::count(),           // savollar soni
        'documents'       => Document::count(),       // hujjatlar
        'videos'          => Video::count(),          // videolar
        'recent_subjects' => Subject::latest()->take(6)->get(),
        'top_subjects'    => Subject::withCount('documents', 'videos')
                                   ->orderByDesc('documents_count')
                                   ->orderByDesc('videos_count')
                                   ->take(5)->get(),
    ];

    return view('admin.dashboard', $data);
}


    //result page
    public function resultPage()
    {
        $results = TestInstance::get()->where('user_id', auth()->id());
        return view('user.results.index', compact('results'));
    }

    public function show($id)
{
    $testInstance = TestInstance::with('subject')
        ->where('user_id', auth()->id())
        ->findOrFail($id);

    $questions = TestInstanceQuestion::with('quiz')
        ->where('test_instance_id', $id)
        ->get();

    return view('user.results.show', compact('testInstance', 'questions'));
}

    public function documentsPage()
    {
        $documents = Document::all();
        $subjects = Subject::all();
        return view('user.documents.index', compact('documents', 'subjects'));
    }

    public function videosPage()
    {
        $videos = Video::all();
        return view('user.videos.index', compact('videos'));
    }






        public function indexAdmin()
    {
        $subjects = Subject::all();
        $admins = User::where('role', "admin")->latest()->get();
        return view('admin.admins', compact('admins', 'subjects'));
    }

    // Admin qilish
    public function makeAdmin(Request $request)
    {
        $request->validate([
            'user_id' => 'required|numeric|exists:users,id'
        ]);

        $user = User::findOrFail($request->user_id);

        if ($user->role === 'admin') {
            return back()->with('error', $user->name . ' allaqachon admin!');
        }

        $user->role = "admin";
        $user->save();

        return back()->with('success', $user->name . ' endi ADMIN bo‘ldi!');
    }

    // Adminlikni olib tashlash
    public function removeAdmin($id)
    {
        $user = User::findOrFail($id);

        if ($user->id === auth()->id()) {
            return back()->with('error', 'O‘zingizni adminlikdan chiqara olmaysiz!');
        }

        $user->role = "user";
        $user->save();

        return back()->with('success', $user->name . ' adminlikdan chiqarildi.');
    }
}
