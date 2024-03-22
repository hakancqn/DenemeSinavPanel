<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\GradeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('teacher')->group(function (){
    Auth::routes();

    Route::redirect('/', '/teacher/dashboard');

    Route::group(['middleware'=>'teacher.login'],function(){
        Route::get('/login',[TeacherController::class, 'login_form'])->name('teacher.login');
        Route::post('/login',[TeacherController::class, 'login_functionality']);
    });

    Route::group(['middleware'=>'teacher'],function(){
        Route::get('/logout',[TeacherController::class, 'logout'])->name('teacher.logout');
        Route::get('/dashboard',[TeacherController::class, 'dashboard'])->name('teacher.dashboard');

        Route::prefix('/student')->group(function (){
            Route::get('/list', [TeacherController::class, 'student'])->name('teacher.student');

            Route::get('/add', [TeacherController::class, 'student_create'])->name('teacher.student.add');
            Route::post('/add', [TeacherController::class, 'student_store']);

            Route::get('/edit/{id}', [TeacherController::class, 'student_edit'])->name('teacher.student.edit');
            Route::post('/edit/{id}', [TeacherController::class, 'student_update']);

            Route::get('/delete/{id}', [TeacherController::class, 'student_destroy'])->name('teacher.student.delete');
        });

        Route::prefix('/grade')->group(function (){
            Route::redirect('', '/teacher/grade/list');
            Route::get('/list', [GradeController::class, 'index'])->name('teacher.grade');

            Route::get('/add', [GradeController::class, 'create'])->name('teacher.grade.add');
            Route::post('/add', [GradeController::class, 'store']);

            Route::get('/edit/{id}', [GradeController::class, 'edit'])->name('teacher.grade.edit');
            Route::post('/edit/{id}', [GradeController::class, 'update']);

            Route::get('/delete/{id}', [GradeController::class, 'destroy'])->name('teacher.grade.delete');
        });
    });
});

require __DIR__.'/auth.php';
