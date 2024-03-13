<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Code;
use App\Models\User;
use App\Models\Classes;
use App\Models\Material;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AttendanceController extends Controller
{
    public function index()
    {
        $title = 'Attendance';

        $classes = Classes::select('id', 'name')->get();
        $materials = Material::select('id', 'name')->get();

        $userId = Auth::user()->id;
        $user = User::where('id', $userId)->first();

        return view('attendance', compact('classes', 'materials', 'user', 'title'));
    }

    public function store(Request $request)
    {
        $attributes = [
            'class_id' => 'Class',
            'material_id' => 'Material',
            'code_id' => 'Code',
            'teaching_role' => 'Teaching Role',
        ];

        $messages = [
            'required' => 'The :attribute field is required.',
            'min' => ('The :attribute must be a 8-digit.'),
        ];

        $validations = [
            'class_id' => ['required'],
            'material_id' => ['required'],
            'code_id' => ['required', 'min:8'],
            'teaching_role' => ['required'],
        ];

        $request->validate($validations, $messages, $attributes);

        $userId = Auth::user()->id;
        $getAssistantId = $request->assistant_id;
        $getClassId = $request->class_id;
        $getMaterialId = $request->material_id;
        $getCodeId = $request->code_id;
        $getTeachingRole = $request->teaching_role;

        $getMatchId = User::where('assistant_id', $getAssistantId)->first();

        if ($userId == $getMatchId->id) {

            $getMatchCode = Code::where('code', $getCodeId)->first();

            if (!$getMatchCode) {
                Alert::error('Failed', 'Kode absen tidak ada!');
                return redirect()->back();
            }

            if ($getCodeId != $getMatchCode->code) {
                Alert::error('Failed', 'Kode absen tidak valid!');
                return redirect()->back();
            }

            if ($getMatchCode->id_user_get) {
                Alert::error('Failed', 'Kode absen sudah digunakan!');
                return redirect()->back();
            }

            if ($getMatchCode->user_id == $userId) {
                Alert::error('Failed', 'Kode absen tidak boleh dipakai untuk diri sendiri!');
                return redirect()->back();
            }

            $data = new Attendance;
            $data->assistant_id = $userId;
            $data->class_id = $getClassId;
            $data->material_id = $getMaterialId;
            $data->teaching_role = $getTeachingRole;

            $today = Carbon::now("GMT+7")->toDateString();
            $timeNow = Carbon::now("GMT+7")->toTimeString();

            $data->date = $today;
            $data->start = $timeNow;
            $data->code_id = $getMatchCode->id;
            $data->save();

            $getMatchCode->status = 1;
            $getMatchCode->id_user_get = $userId;
            $getMatchCode->save();

            $getMatchId->status_attendance = 1;
            $getMatchId->save();

            if (!$data) {
                Alert::error('Failed', 'Absen gagal');
                return redirect()->back();
            } else {
                Alert::success('Success', 'Absen berhasil');
                return redirect()->back();
            }
        } else {

            Alert::error('Failed', 'ID Asisten tidak sesuai!');
            return redirect()->back();
        }
    }

    public function update(Request $request)
    {
        $today = Carbon::now("GMT+7")->toDateString();

        $userId = Auth::user()->id;
        $attendanceCheck = Attendance::where('assistant_id', $userId)->where('date', $today)->where('end', null)->first();

        $start = $attendanceCheck->start;
        $end = Carbon::now("GMT+7")->toTimeString();
        $attendanceCheck->end = $end;

        $duration = Carbon::now("GMT+7")->diffInMinutes($start);
        $attendanceCheck->duration = $duration;

        $attendanceCheck->save();

        $user = User::where('id', $userId)->first();
        $user->status_attendance = 0;
        $user->save();

        if (!$attendanceCheck) {
            Alert::error('Failed', 'ClockOut Gagal');
            return redirect()->back();
        } else {
            Alert::success('Success', 'ClockOut Berhasil');
            return redirect()->back();
        }
    }
}
