<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamRequest;
use App\Models\ExamStudent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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

    public function student_exam_future(){
        $today_date = Carbon::now();
        $student = Auth::guard()->user();
        $exam_requests = ExamRequest::where('student_id', $student->id)->get();
        $future_exams = Exam::where('date', '>=', $today_date)->get();
        $filtered_exams = [];

        foreach ($future_exams as $future_exam) {
            $include_exam = true;
            foreach ($exam_requests as $exam_request) {
                if ($future_exam->id == $exam_request->exam_id && $student->id == $exam_request->student_id) {
                    $include_exam = false;
                    break; // İç içe döngüyü sonlandır
                }
            }
            if ($include_exam) {
                $filtered_exams[] = $future_exam;
            }
        }

        return view('student.exam.future')
            ->with('future_exams', $filtered_exams);
    }

    public function student_create_exam_request(Request $request){
        $student = Auth::guard()->user();
        ExamRequest::create([
            'student_id' => $student->id,
            'exam_id' => $request->exam_id,
        ]);
        return redirect()->route('student.exam.future.list');
    }
}
