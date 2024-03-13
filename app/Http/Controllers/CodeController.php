<?php

namespace App\Http\Controllers;

use App\Models\Code;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class CodeController extends Controller
{
    public function index()
    {
        $title = 'Code';

        $userId = Auth::user()->id;

        $codes = Code::with(['user'])
            ->orderBy('created_at', 'desc')
            ->where('user_id', $userId)
            ->get();

        return view('code', compact('codes', 'title'));
    }

    public function generate(Request $request)
    {
        $codeRandom = Str::random(8);

        $request['user_id'] = Auth::user()->id;
        $request['code'] = $codeRandom;

        $code = Code::Create($request->all());

        if (!$code) {
            // Handle kesalahan jika gagal membuat pengguna baru
            Alert::error('Failed', 'Gagal membuat kode');
            return redirect()->back();
        }

        // Berhasil membuat pengguna baru, tampilkan pesan sukses
        Alert::success('Success', 'Kode berhasil dibuat: ' . $code->code);
        return redirect()->back();
    }
}
