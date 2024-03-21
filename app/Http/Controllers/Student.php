<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Crypt;

class Student extends Controller
{
    public function displayStudent()
    {
        $students = DB::table('_students')->get();

        return view('studentList', ['students' => $students]);
    }

    public function createStudent()
    {
        return view('createStudent');
    }

    public function submitStudent()
    {


        $validator = Validator::make(request()->all(), [
            'fullName' => 'required|string|max:100',
            'email' => 'required|email|unique:_students,email',
            'password' => 'required|string|min:8',
            'phone' => 'required|string|max:10',
            'photo' => 'nullable|image|max:2048',
            'gender' => 'required',
        ]);


        if ($validator->fails()) {
            return redirect()->route('student.create')
                ->withErrors($validator)
                ->withInput();
        }


        if (request()->hasFile('photo')) {

            $file = request()->file('photo');
            $filename = $file->getClientOriginalName();
            $path = 'uploads/category/';
            $file->move($path, $filename);
        }

        DB::table('_students')->insert([
            'fullName' => request()->input('fullName'),
            'email' => request()->input('email'),
            'password' =>  Crypt::encrypt(request()->input('password')),
            'phone' => request()->input('phone'),
            'photo' =>  $path . $filename,
            'gender' => request()->input('gender')
        ]);


        return redirect()->route('student.display')->with('status', 'Student created successfully!');
    }

    public function deleteStudent(Request $rq)
    {
        $student = DB::table('_students')->find($rq->id);

        $filename = $student->photo;
        if (File::exists($filename)) {
            File::delete($filename);
        }

        $deleted = DB::table('_students')->where('id', $rq->id)->delete();

        if (!$deleted) {
            return redirect()->back()->with('error', 'Student is not Found!');
        }
        return redirect()->back()->with('status', 'Student deleted successfully!');
    }

    public function  editStudent(Request $rq)
    {
        $student = DB::table('_students')->find($rq->id);
        $student->password=Crypt::decrypt($student->password);

        return view('editStudent', compact('student'));
    }
    public function updateStudent()
    {
        $currfile = 'uploads/category/'. request()->input('currentphoto');
        $file = request()->file('photo');

        if (!is_null($file) && isset($file)) {
            $filename = $file->getClientOriginalName();
            if ($currfile && File::exists($currfile)) {
                File::delete( $currfile);
            }

            $path = 'uploads/category/';
            $file->move($path, $filename);
            $currfile =$path. $filename;

        }

        $validator = Validator::make(request()->all(), [
            'fullName' => 'required|string|max:100',
            'email' => 'required|email',
            'password' => 'required|string|min:8',
            'phone' => 'required|string|max:10',
            'photo' => 'nullable|image|max:2048',
            'gender' => 'required',
        ]);


        if ($validator->fails()) {
            return redirect()->route('student.edit', request()->input('id'))
                ->withErrors($validator)
                ->withInput();
        }


        $affected = DB::table('_students')
            ->where('id', request()->input('id'))
            ->update([
                'fullName' => request()->input('fullName'),
                'email' => request()->input('email'),
                'password' =>  Crypt::encrypt(request()->input('password')),
                'phone' => request()->input('phone'),
                'photo' => $currfile,
                'gender' => request()->input('gender')
            ]);



        if (!$affected) {
            return redirect()->route('student.display')->with('error', 'Student is not updated!');
        }

        return redirect()->route('student.display')->with('status', 'Student is  updated!');
    }
}
