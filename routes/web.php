<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', [UserController::class, 'index']);
Route::get('/direction', [UserController::class, 'direction']);


// Guest routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'show']);
    Route::post('/login', [LoginController::class, 'login']);

    Route::get('/register', [RegisterController::class, 'show']);
    Route::post('/register', [RegisterController::class, 'register']);
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Admin panel
Route::middleware(['admin'])->group(function () {
    Route::get('/admin', [UserController::class, 'adminDashboard'])->name('admin.dashboard'); 
    Route::resource('/admin/subjects', SubjectController::class);
    //quizzes resource directed with subject
    Route::resource('/admin/subjects/{subject}/quizzes', QuizController::class);    
    Route::resource('/admin/subjects/{subject}/document', DocumentController::class);
    Route::resource('/admin/subjects/{subject}/video', VideoController::class);
    Route::delete('/admin/quiz/{quiz}/delete', [QuizController::class, 'destroy'])->name('admin.quizzes.delete');
    Route::get('/admin/subject/{subject}/quiz/{quiz}/edit', [QuizController::class, 'edit'])->name('admin.quizzes.edit');
    Route::put('/admin/quiz/{quiz}', [QuizController::class, 'update'])->name('admin.subjects.quizzes.update');

    //video delete route
    Route::delete('/admin/video/{video}/delete', [VideoController::class, 'destroy'])->name('admin.videos.delete');

    //document delete route
    Route::delete('/admin/document/{document}/delete', [DocumentController::class, 'destroy'])->name('admin.documents.delete');

    Route::get('/admins', [UserController::class, 'indexAdmin'])->name('admins');

    Route::post('/make-admin', [UserController::class, 'makeAdmin'])
         ->name('make-admin');

    Route::delete('/remove-admin/{id}', [UserController::class, 'removeAdmin'])
         ->name('remove-admin');

    Route::get('admin/results', [App\Http\Controllers\Admin\ResultController::class, 'index'])
         ->name('admin.results.index');
});



// Oddiy user
Route::middleware(['user'])->group(function () {
    Route::get('/user', [UserController::class, 'userDashboard'])->name('user.dashboard');
    Route::get('/user/result', [UserController::class, 'resultPage'])->name('results.index');
    Route::get('/user/documents', [UserController::class, 'documentsPage'])->name('documents.index');
    Route::get('/user/videos', [UserController::class, 'videosPage'])->name('videos.index');
    Route::get('/user/result/{id}', [UserController::class, 'show'])->name('results.show');
    
    Route::get('user/test/start/{subject}', [TestController::class, 'start'])->name('user.test.start');
    Route::get('user/test/{testInstance}', [TestController::class, 'show'])->name('user.test.show');
    Route::post('user/test/{testInstance}/finish', [TestController::class, 'finish'])->name('user.test.finish');

});