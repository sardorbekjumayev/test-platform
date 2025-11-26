<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{


    public function show()
    {
        return view('auth.register');
    }

public function register(Request $request)
{
    $request->validate([
        'fname'     => 'required|string|max:255',
        'lname'     => 'required|string|max:255',
        'email'     => 'required|email|unique:users,email',
        'district'  => 'required|string',
        'password'  => 'required|min:6|confirmed', // confirmed avto password_confirmation ni tekshiradi
    ]);

    User::create([
        'name'     => $request->fname . ' ' . $request->lname,
        'email'    => $request->email,
        'district' => $request->district,
        'role'     => 'user',
        'password' => Hash::make($request->password),
    ]);

    return redirect('/login')->with('success', 'Roʻyxatdan muvaffaqiyatli oʻtildi!');
}
}
