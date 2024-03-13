<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function index()
    {
        $title = 'Login';

        return view('auth.login', compact('title'));
    }

    public function login(Request $request)
    {
        $attributes = [
            'email' => 'Email',
            'password' => 'Password',
        ];

        $messages = [
            'required' => 'The :attribute field is required.',
            'email' => 'The :attribute format is invalid.',
            'exists' => 'The :attribute is not registered.',
        ];

        $validations = [
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required'],
        ];


        $data = $request->validate($validations, $messages, $attributes);

        if (Auth::attempt($data)) {

            $request->session()->regenerate();

            $userId = Auth::user()->id;
            $today = Carbon::now("GMT+7")->toDateString();

            $checkUser = Attendance::where('assistant_id', $userId)->first();

            if (!$checkUser || $checkUser->assistant_id != $userId) {
                return redirect()->intended('attendance');
            } else {
                if ($checkUser->date != $today) {

                    if ($checkUser->date < $today) {
                        $user = User::find($userId);
                        $user->status_attendance = 0;
                        $user->save();

                        return redirect()->intended('attendance');
                    }
                }
            }
        }

        Alert::error('Failed', 'Password Salah');
        return redirect()->back();
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
