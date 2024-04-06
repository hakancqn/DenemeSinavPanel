<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grades = Grade::all();

        return view('teacher.grade.list')
            ->with('grades', $grades);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('teacher.grade.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        Grade::insert(['name' => $request->name]);

        return redirect()->route('teacher.grade');
    }

    public function edit($id)
    {
        $grade = Grade::where('id', $id)->first();

        return view('teacher.grade.edit')
            ->with('grade', $grade);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required',
        ]);

        $grade = Grade::where('id', $request->id)->first();

        $grade->name = $request->name;
        $grade->save();

        return redirect()->route('teacher.grade');
    }

    public function destroy($id)
    {
        $grade = Grade::where('id', $id)->first();

        $grade->forceDelete();

        return redirect()->route('teacher.grade');
    }

    public function student($grade_id)
    {
        $grade = Grade::where('id', $grade_id)->first();
        $students = User::where('grade_id', $grade_id)->get();

        return view('teacher.grade.student.list')->with('students', $students)->with('grade', $grade);
    }
}
