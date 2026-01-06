<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;

class ScheduleController extends Controller
{
    public function index()
    {
        $student = auth()->user()->student;
        
        // Get approved classes with lecturer info
        $allClasses = $student->classRooms()
            ->where('class_rooms.status', 'active')
            ->wherePivot('status', 'approved')
            ->with('lecturer.user')
            ->get();

        // Group by day for timetable
        $scheduleByDayTime = $allClasses->groupBy('schedule_day');

        // Calculate stats
        $totalClasses = $allClasses->count();
        $totalCredits = $allClasses->sum('credits');

        return view('mahasiswa.schedule', compact(
            'student',
            'allClasses',
            'scheduleByDayTime',
            'totalClasses',
            'totalCredits'
        ));
    }
}
