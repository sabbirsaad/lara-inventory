<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class StudentController extends Controller
{
    public function index()
    {
        return view('student.studentList');
    }

    public function show()
    {
        $students = Student::all();
        return response()->json(['students' => $students]);
    }

    public function create()
    {
        return view('student.studentCreate');
    }

    public function store(Request $request)
    {
        $student = new Student();
        $student->name = $request->name;
        $student->email = $request->email;

        if ($request->image) {
            $ext = $request->image->getClientOriginalExtension();
            $newFileName = time() . '.' . $ext;
            $request->image->move(public_path() . '/uploads/students', $newFileName);
            $student->image = $newFileName;
            $student->save();
        }
        return response()->json(['res' => 'Student created successfully']);
    }
    public function edit($id)
    {
        $students = Student::where('student_id', $id)->get();
        return view('student.studentEdit', ['students' => $students]);
    }

    public function update(Request $request)
    {
        $student = Student::find($request->id);
        $student->name = $request->name;
        $student->email = $request->email;

        if ($request->image[0]) {
            $oldImage = $student->image;
            $image = $request->image[0];
            $ext = $image->getClientOriginalExtension();
            $newFileName = time() . '.' . $ext;
            $image->move(public_path() . '/uploads/students', $newFileName);
            $student->image = $newFileName;
            $student->save();

            File::delete(public_path() . '/uploads/products', $oldImage);
        }
        return response()->json(['res' => 'student updated']);
    }

    public function destroy($id)
    {
        $data = Student::findOrFail($id)->get();

        $data[0]->delete();

        return response()->json(['res' => 'data deleted']);
    }
}
