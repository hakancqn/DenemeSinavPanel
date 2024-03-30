<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $exams = Exam::all();

        return view('teacher.exam.list')
            ->with('exams', $exams);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('teacher.exam.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'date' => 'required',
        ]);

        Exam::insert([
            'name' => $request->name,
            'date' => $request->date,
        ]);

        return redirect()->route('teacher.exam');
    }

    public function edit($id)
    {
        $exam = Exam::where('id', $id)->first();

        return view('teacher.exam.edit')
            ->with('exam', $exam);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'date' => 'required',
        ]);

        $exam = Exam::where('id', $request->id)->first();

        $exam->name = $request->name;
        $exam->date = $request->date;
        $exam->save();

        return redirect()->route('teacher.exam');
    }

    public function destroy($id)
    {
        $exam = Exam::where('id', $id)->first();

        $exam->forceDelete();

        return redirect()->route('teacher.exam');
    }
}
