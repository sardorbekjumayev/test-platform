<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TestInstance;
use App\Models\Subject;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function index(Request $request)
    {
        $query = TestInstance::with(['user', 'subject'])
            ->select('test_instances.*')
            ->join('users', 'test_instances.user_id', '=', 'users.id');

        // District filter
        if ($request->filled('district')) {
            $query->where('test_instances.district', $request->district);
        }

        // Subject filter
        if ($request->filled('subject')) {
            $query->where('test_instances.subject_id', $request->subject);
        }

        // Tartiblash: eng yangi birinchi
        $query->orderBy('test_instances.created_at', 'desc');

        $results = $query->paginate(20);

        // Filter uchun kerakli ma'lumotlar
        $districts = TestInstance::distinct()->pluck('district')->sort();
        $subjects  = Subject::orderBy('name')->get();

        return view('admin.results.index', compact('results', 'districts', 'subjects'));
    }
}