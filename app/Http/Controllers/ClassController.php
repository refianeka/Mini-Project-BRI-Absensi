<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Classes;
use Illuminate\Http\Request;
use GuzzleHttp\Promise\Create;
use RealRashid\SweetAlert\Facades\Alert;

class ClassController extends Controller
{
    public function index()
    {
        $title = 'Class';

        $classes = Classes::All();

        return view('class', compact('classes', 'title'));
    }

    public function store(Request $request)
    {
        $attributes = [
            'name' => 'Class Name',
            'major' => 'Major',
            'faculty' => 'Faculty',
            'level' => 'Level',
        ];

        $messages = [
            'required' => 'The :attribute field is required.',
            'unique' => 'The :attribute has already been taken.',
            'numeric' => ('The :attribute must be a number.'),
        ];

        $validations = [
            'name' => ['required', 'unique:classes,name'],
            'major' => ['required'],
            'faculty' => ['required'],
            'level' => ['required', 'numeric'],
        ];

        $request->validate($validations, $messages, $attributes);

        $class = Classes::Create($request->all());

        if (!$class) {
            Alert::error('Failed', 'Gagal menambahkan class baru!');
            return redirect()->back();
        }

        Alert::success('Success', 'Berhasil menambahkan class baru!');
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $attributes = [
            'name' => 'Class Name',
            'major' => 'Major',
            'faculty' => 'Faculty',
            'level' => 'Level',
        ];

        $messages = [
            'required' => 'The :attribute field is required.',
            'unique' => 'The :attribute has already been taken.',
            'numeric' => ('The :attribute must be a number.'),
        ];

        $validations = [
            'name' => ['required'],
            'major' => ['required'],
            'faculty' => ['required'],
            'level' => ['required', 'numeric'],
        ];

        $request->validate($validations, $messages, $attributes);

        $class = Classes::findOrFail($id);

        $class->update($request->all());

        if (!$class) {
            Alert::error('Failed', 'Gagal memperbarui ' . $class->name);
            return redirect()->back();
        }

        Alert::success('Success', 'Berhasil memperbarui ' . $class->name);
        return redirect()->back();
    }

    public function delete($id)
    {

        $class = Classes::findOrFail($id);
        $checkClass = Attendance::where('class_id', $class->id)->first();

        if ($checkClass) {
            Alert::error('Failed', 'Gagal menghapus ' . $class->name);
            return redirect()->back();
        } else {
            $class->forceDelete();

            Alert::success('Success', 'Berhasil menghapus ' . $class->name);
            return redirect()->back();
        }
    }
}
