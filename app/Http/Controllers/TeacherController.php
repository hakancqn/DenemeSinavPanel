<?php

namespace App\Http\Controllers;

use App\Models\ExamRequest;
use App\Models\ExamStudent;
use App\Models\Grade;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use function Faker\Provider\pt_BR\check_digit;

class TeacherController extends Controller
{
    //todo: teacher login form
    public function login_form()
    {
        return view('teacher.auth.login');
    }

    //todo: teacher login functionality
    public function login_functionality(Request $request){
        $request->validate([
            'id_no'=>'required',
            'password'=>'required',
        ]);

        if (Auth::guard('teacher')->attempt(['id_no' => $request->id_no, 'password' => $request->password])) {
            return redirect()->route('teacher.dashboard');
        }else{
            Session::flash('error-message','Invalid Email or Password');
            return back();
        }
    }

    public function dashboard()
    {
        $teacher = Auth::guard('teacher')->user();
        return view('teacher.dashboard')
            ->with('teacher', $teacher);
    }

    //todo: teacher logout functionality
    public function logout(Request $request): \Illuminate\Http\RedirectResponse
    {
        Auth::guard('teacher')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/teacher/login');
    }

    public function student()
    {
        $students = User::all();

        return view('teacher.student.list')
            ->with('students', $students);
    }

    public function student_create()
    {
        $grades = Grade::all();
        return view('teacher.student.add')
            ->with('grades', $grades);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function student_store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        User::insert([
            'name'      =>  $request->name,
            'email'     =>  $request->email,
            'id_no'     =>  $request->id_no,
            'school_no' =>  $request->school_no,
            'grade_id'     =>  $request->grade,
        ]);

        return redirect()->route('teacher.student');
    }

    public function student_edit($id)
    {
        $student = User::where('id', $id)->first();

        $grades = Grade::all();

        return view('teacher.student.edit')
            ->with('student', $student)
            ->with('grades', $grades);
    }

    /**
     * Update the specified resource in storage.
     */
    public function student_update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'email' => 'required',
            'id_no' => 'required',
            'school_no' => 'required',
            'grade_id' => 'required',
        ]);

        $student = User::where('id', $request->id)->first();

        $student->name = $request->name;
        $student->email = $request->email;
        $student->id_no = $request->id_no;
        $student->school_no = $request->school_no;
        $student->grade_id = $request->grade_id;

        $student->save();

        return redirect()->route('teacher.student');
    }

    public function student_destroy($id)
    {
        $student = User::where('id', $id)->first();

        $student->forceDelete();

        return redirect()->route('teacher.student');
    }

    public function student_exam($id)
    {
        $examstudents = ExamStudent::where('student_id', $id)->get();
        $student = User::where('id', $id)->first();

        return view('teacher.student.exam.list')
            ->with('examstudents', $examstudents)
            ->with('student', $student);
    }

    public function student_exam_request(){
        $requests = ExamRequest::where('accepted', 0)->where('denied', 0)->get();

        return view('teacher.student.exam.request.list')
            ->with('requests', $requests);
    }

    public function student_exam_request_accept($requestid){
        $request = ExamRequest::where('id', $requestid)->first();
        $request->accepted = 1;
        $request->save();
        return redirect()->route('teacher.student.exam.request.list');
    }

    public function student_exam_request_deny($requestid){
        $request = ExamRequest::where('id', $requestid)->first();
        $request->denied = 1;
        $request->save();
        return redirect()->route('teacher.student.exam.request.list');
    }
}
