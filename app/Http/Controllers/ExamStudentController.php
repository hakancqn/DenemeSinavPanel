<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamStudent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($examid)
    {
        $exams = ExamStudent::where('exam_id', $examid)->get();

        return view('teacher.exam.student.list')
            ->with('exams', $exams);
    }

    public function create($examId){
        $studentsAll = User::all();

        $exam = Exam::where('id', $examId)->first();

        // Belirli sınav id'sine sahip kayıtları al
        $examStudents = ExamStudent::where('exam_id', $examId)->pluck('student_id');

        // Sınavda kayıtlı olmayan kullanıcıları bul
        $students = $studentsAll->reject(function ($student) use ($examStudents) {
            return $examStudents->contains($student->id);
        });

        return view('teacher.exam.student.add')
            ->with('students', $students)
            ->with('exam', $exam);
    }

    public function store(Request $request){
        ExamStudent::insert([
            "exam_id"               => $request->examId,
            "student_id"            => $request->student_id,
            "turkce_dogru"          => $request->turkce_dogru,
            "turkce_yanlis"         => $request->turkce_yanlis,
            "matematik_dogru"       => $request->matematik_dogru,
            "matematik_yanlis"      => $request->matematik_yanlis,
            "inkilap_dogru"         => $request->inkilap_dogru,
            "inkilap_yanlis"        => $request->inkilap_yanlis,
            "fenbilimleri_dogru"    => $request->fenbilimleri_dogru,
            "fenbilimleri_yanlis"   => $request->fenbilimleri_yanlis,
        ]);
        return redirect()->route('teacher.exam.student.list', $request->examId);
    }

    public function edit(Request $request)
    {
        $veriler = $request->request;
        foreach ($veriler as $veri) {
            $examstudent = ExamStudent::where('id', $veri['id'])->first();

            $examstudent->turkce_dogru = $veri['turkce_dogru'];
            $examstudent->turkce_yanlis = $veri['turkce_yanlis'];
            $examstudent->matematik_dogru = $veri['matematik_dogru'];
            $examstudent->matematik_yanlis = $veri['matematik_yanlis'];
            $examstudent->inkilap_dogru = $veri['inkilap_dogru'];
            $examstudent->inkilap_yanlis = $veri['inkilap_yanlis'];
            $examstudent->fenbilimleri_dogru = $veri['fenbilimleri_dogru'];
            $examstudent->fenbilimleri_yanlis = $veri['fenbilimleri_yanlis'];

            $examstudent->save();
        }

        return response()->json(['message' => 'İşlem başarıyla tamamlandı.'], 200);
    }

    public function student_exam_past(){
        $student = Auth::guard()->user();
        $student_id = $student->id;
        $results = ExamStudent::where('student_id', $student_id)->get();
        return view('student.exam.past')
            ->with('exams', $results);
    }

    public function student_exam_past_results($id){
        $exam = ExamStudent::where('id', $id)->first();
        return view('student.exam.past_result')
            ->with('exam', $exam);
    }
}
