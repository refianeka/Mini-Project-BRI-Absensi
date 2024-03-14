<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function index()
    {
        $title = 'User';

        $users = User::with(['role'])->get();
        $roles = Role::select('id', 'name')->get();

        $editRoles = [];

        foreach ($users as $user) {
            // Mendapatkan role_id user
            $currentRoleId = $user->role->id;

            // melakukan filter role untuk mendapatkan list role yang diinginkan
            $filteredRoles = $roles->reject(function ($role) use ($currentRoleId) {
                return $role->id === $currentRoleId;
            });

            // membuat array dari id user untuk mendapatkan role yang diinginkan
            $editRoles[$user->id] = $filteredRoles;
        }

        return view('user', compact('users', 'roles', 'editRoles', 'title'));
    }

    public function store(Request $request)
    {
        $attributes = [
            'assistant_id' => 'ID Assistant',
            'name' => 'Name',
            'join_date' => 'Join Date',
            'role_id' => 'Role',
            'photo' => 'Photo',
            'email' => 'Email',
            'password' => 'Password',
            'repeat_password' => 'Password',
        ];

        $messages = [
            'required' => 'The :attribute field is required.',
            'email' => 'The :attribute format is invalid.',
            'same' => 'The :attribute must be the same.',
            'unique' => 'The :attribute has already been taken.',
            'min' => 'The :attribute must be at least 8 characters.',
            'digits' => ('The :attribute must be a 8-digit.'),
            'mimes' => ('The :attribute must be a file of type: :values.'),
            'numeric' => ('The :attribute must be a number.'),
        ];

        $validations = [
            'assistant_id' => ['required', 'digits:8', 'unique:users,assistant_id', 'numeric'],
            'name' => ['required'],
            'join_date' => ['required'],
            'role_id' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'photo' => ['nullable', 'image', 'mimes:jpg,png,jpeg'],
            'password' => ['required', 'same:repeat_password', 'min:8'],
            'repeat_password' => ['required', 'same:password', 'min:8'],
        ];

        $request->validate($validations, $messages, $attributes);

        $newName = 'default.jpg';

        if ($request->hasFile('photo')) {

            $extension = $request->file('photo')->getClientOriginalExtension();
            $newName = $request->name . '-' . now()->timestamp . '.' . $extension;
            $request->file('photo')->storeAs('photo', $newName);
        }

        $user = new User();
        $user->assistant_id = $request->assistant_id;
        $user->name = $request->name;
        $user->join_date = $request->join_date;
        $user->role_id = $request->role_id;
        $user->email = $request->email;
        $user->photo = $newName;
        $user->password = Hash::make($request['password']);
        $user->save();

        if (!$user) {
            Alert::error('Failed', 'Gagal menambahkan user baru!');
            return redirect()->back();
        }

        Alert::success('Success', 'Berhasil menambahkan user baru!');
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $attributes = [
            'name' => 'Name',
            'role_id' => 'Role',
            'photo' => 'Photo',
        ];

        $messages = [
            'required' => 'The :attribute field is required.',
            'mimes' => ('The :attribute must be a file of type: :values.'),
        ];

        $validations = [
            'name' => ['required'],
            'role_id' => ['required'],
            'photo' => ['nullable', 'image', 'mimes:jpg,png,jpeg'],
        ];

        $request->validate($validations, $messages, $attributes);

        $user = User::findOrFail($id);

        $newName = $user->photo;

        if ($newName && $newName !== 'default.jpg') {
            Storage::delete('photo/' . $user->photo);
        }

        if ($request->hasFile('photo')) {

            $extension = $request->file('photo')->getClientOriginalExtension();
            $newName = $request->name . '-' . now()->timestamp . '.' . $extension;
            $request->file('photo')->storeAs('photo', $newName);
        }

        $user->name = $request->name;
        $user->role_id = $request->role_id;
        $user->photo = $newName;
        $user->save();

        if (!$user) {
            Alert::error('Failed', 'Gagal memperbarui ' . $user->name);
            return redirect()->back();
        }

        Alert::success('Success', 'Berhasil memperbarui ' . $user->name);
        return redirect()->back();
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $checkUser = Attendance::where('assistant_id', $user->id)->first();

        if ($checkUser) {

            Alert::error('Failed', 'Gagal menghapus ' . $user->name);
            return redirect()->back();
        } else {

            if ($user->photo && $user->photo !== 'default.jpg') {
                Storage::delete('photo/' . $user->photo);
            }

            $user->forceDelete();

            Alert::success('Success', 'Berhasil menghapus ' . $user->name);
            return redirect()->back();
        }
    }
}
