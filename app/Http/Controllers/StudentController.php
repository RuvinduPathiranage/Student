<?php

namespace App\Http\Controllers;

use domain\Facades\StudentFacade;
use Illuminate\Http\Request;
use Inertia\Inertia;



class StudentController extends ParentController
{
    public function index()
    {
        // $response['students'] = StudentFacade::all();
        // return Inertia::render('Student/index', $response);
        return Inertia::render('Student/index');
    }
    public function store(Request $request)
    {
        StudentFacade::store($request->all());
        // $response['students'] = StudentFacade::all();
        // return response()->json($response);
        //  return StudentFacade::store($request->all());
    }
    public function list()
    {
        $response= StudentFacade::all();
        return response()->json($response);

    }
    public function delete($student_id)
    {
        // dd($student_id);
        StudentFacade::delete($student_id);
        // return redirect()->back();
    }
    public function status($student_id)
    {
        StudentFacade::status($student_id);
        // return redirect()->back();
    }
    public function edit($student_id)
    {
        $student = StudentFacade::edit($student_id);
        return response()->json($student);

    }
    public function update(Request $request, $student_id)
    {
        return StudentFacade::update($request->all(), $student_id);
    }
}
