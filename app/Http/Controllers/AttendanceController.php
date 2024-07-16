<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TimeTracker;

class AttendanceController extends Controller
{
    public function index()
    {
        // $attendances = TimeTracker::all();

        return view('backend.attendance.list', compact('attendances'));
    }
}
