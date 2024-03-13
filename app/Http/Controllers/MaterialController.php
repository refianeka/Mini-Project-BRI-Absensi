<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Material;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class MaterialController extends Controller
{
    public function index()
    {
        $title = 'Material';

        $materials = Material::All();

        return view('material', compact('materials', 'title'));
    }

    public function store(Request $request)
    {
        $attributes = [
            'name' => 'Material Name',
        ];

        $messages = [
            'required' => 'The :attribute field is required.',
            'unique' => 'The :attribute has already been taken.',
        ];

        $validations = [
            'name' => ['required', 'unique:materials,name'],
        ];

        $request->validate($validations, $messages, $attributes);

        $material = Material::Create($request->all());

        if (!$material) {
            Alert::error('Failed', 'Gagal menambahkan material baru!');
            return redirect()->back();
        }

        Alert::success('Success', 'Berhasil menambahkan material baru!');
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $attributes = [
            'name' => 'Material Name',
        ];

        $messages = [
            'required' => 'The :attribute field is required.',
            'unique' => 'The :attribute has already been taken.',
        ];

        $validations = [
            'name' => ['required', 'unique:materials,name'],
        ];

        $request->validate($validations, $messages, $attributes);

        $material = Material::findOrFail($id);

        $material->update($request->all());

        if (!$material) {
            Alert::error('Failed', 'Gagal memperbarui ' . $material->name);
            return redirect()->back();
        }

        Alert::success('Success', 'Berhasil memperbarui ' . $material->name);
        return redirect()->back();
    }

    public function delete($id)
    {
        $material = Material::findOrFail($id);
        $checkMaterial = Attendance::where('material_id', $material->id)->first();

        if ($checkMaterial) {
            Alert::error('Failed', 'Gagal menghapus ' . $material->name);
            return redirect()->back();
        } else {
            $material->forceDelete();

            Alert::success('Success', 'Berhasil menghapus ' . $material->name);
            return redirect()->back();
        }
    }
}
