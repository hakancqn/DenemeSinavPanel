<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamStudent;
use Illuminate\Http\Request;

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

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ExamStudent $examStudent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ExamStudent $examStudent)
    {
        //
    }
}
