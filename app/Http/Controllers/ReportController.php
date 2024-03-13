<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Report';

        if ($request->start_date && $request->end_date) {
            $start_date = Carbon::parse($request->start_date)->toDateString();
            $end_date = Carbon::parse($request->end_date)->toDateString();
            $attendances = Attendance::with(['class', 'material', 'user', 'code'])
                ->orderBy('created_at', 'desc')
                ->where('end', '!=', null)
                ->whereBetween('date', [$start_date, $end_date])
                ->get();
        } else {
            $attendances = Attendance::latest()
                ->orderBy('created_at', 'desc')
                ->where('end', '!=', null)
                ->get();
        }

        return view('report', compact('attendances', 'title'));
    }
}
