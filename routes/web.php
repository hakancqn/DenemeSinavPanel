<?php

use App\Http\Controllers\ExamController;
use App\Http\Controllers\ExamStudentController;
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

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () { return view('student.dashboard'); })->name('student.dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('/exam')->group(function () {
        Route::get('/past', [ExamStudentController::class, 'student_exam_past'])->name('student.exam.past.list');
        Route::get('/result/{id}', [ExamStudentController::class, 'student_exam_past_results'])->name('student.exam.past.result');

        Route::get('/future', [ExamStudentController::class, 'student_exam_future'])->name('student.exam.future.list');

        Route::post('/create/request', [ExamStudentController::class, 'student_create_exam_request'])->name('student.create.exam.request');
    });
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
            Route::redirect('', '/teacher/student/list');
            Route::get('/list', [TeacherController::class, 'student'])->name('teacher.student');

            Route::get('/add', [TeacherController::class, 'student_create'])->name('teacher.student.add');
            Route::post('/add', [TeacherController::class, 'student_store']);

            Route::get('/edit/{id}', [TeacherController::class, 'student_edit'])->name('teacher.student.edit');
            Route::post('/edit/{id}', [TeacherController::class, 'student_update']);

            Route::get('/delete/{id}', [TeacherController::class, 'student_destroy'])->name('teacher.student.delete');


            Route::prefix('/exam')->group(function (){
                Route::redirect('','teacher/student/exam/list');
                Route::get('/list/{studentid}', [TeacherController::class, 'student_exam'])->name('teacher.student.exam.list');
                Route::prefix('/request')->group(function (){
                    Route::redirect('','teacher/student/exam/request/list');
                    Route::get('/list', [TeacherController::class, 'student_exam_request'])->name('teacher.student.exam.request.list');
                    Route::get('/accept/{requestid}', [TeacherController::class, 'student_exam_request_accept'])->name('teacher.student.exam.request.accept');
                    Route::get('/deny/{requestid}', [TeacherController::class, 'student_exam_request_deny'])->name('teacher.student.exam.request.deny');
                });
            });
        });

        Route::prefix('/grade')->group(function (){
            Route::redirect('', '/teacher/grade/list');
            Route::get('/list', [GradeController::class, 'index'])->name('teacher.grade');

            Route::get('/add', [GradeController::class, 'create'])->name('teacher.grade.add');
            Route::post('/add', [GradeController::class, 'store']);

            Route::get('/edit/{id}', [GradeController::class, 'edit'])->name('teacher.grade.edit');
            Route::post('/edit/{id}', [GradeController::class, 'update']);

            Route::get('/delete/{id}', [GradeController::class, 'destroy'])->name('teacher.grade.delete');

            Route::get('/student/{id}', [GradeController::class, 'student'])->name('teacher.grade.student.list');
        });

        Route::prefix('/exam')->group(function (){
            Route::redirect('', '/teacher/exam/list');
            Route::prefix('/list')->group(function (){
                Route::get('/future', [ExamController::class, 'future_exam'])->name('teacher.exam.future.list');
                Route::get('/past', [ExamController::class, 'past_exam'])->name('teacher.exam.past.list');
            });

            Route::get('/add', [ExamController::class, 'create'])->name('teacher.exam.add');
            Route::post('/add', [ExamController::class, 'store']);

            Route::get('/edit/{id}', [ExamController::class, 'edit'])->name('teacher.exam.edit');
            Route::post('/edit/{id}', [ExamController::class, 'update']);

            Route::get('/delete/{id}', [ExamController::class, 'destroy'])->name('teacher.exam.delete');

            Route::prefix('/student')->group(function (){
                Route::redirect('','teacher/exam/student/list');
                Route::get('/list/{examid}', [ExamStudentController::class, 'index'])->name('teacher.exam.student.list');
                Route::get('/add/{examid}', [ExamStudentController::class, 'create'])->name('teacher.exam.student.create');
                Route::post('/add/{examid}', [ExamStudentController::class, 'store']);
                Route::post('/edit/{examid}', [ExamStudentController::class, 'edit'])->name('teacher.exam.student.edit');
            });
        });
    });
});

require __DIR__.'/auth.php';
