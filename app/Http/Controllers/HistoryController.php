<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function index()
    {
        $title = 'History';

        $userId = Auth::user()->id;

        $attendances = Attendance::with(['class', 'material', 'user', 'code.user'])
            ->orderBy('created_at', 'desc')
            ->where('assistant_id', $userId)
            ->where('end', '!=', null)
            ->get();

        return view('history', compact('attendances', 'title'));
    }
}
