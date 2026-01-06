<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $student = auth()->user()->student;
        
        $enrolledClasses = $student->classRooms()
            ->where('class_rooms.status', 'active')
            ->with('lecturer.user')
            ->get();


        $stats = [
            'total_courses' => $enrolledClasses->count(),
            'attendance_rate' => $this->calculateAttendanceRate($student),
        ];

        return view('mahasiswa.dashboard', compact('student', 'enrolledClasses', 'stats'));
    }

    private function calculateAttendanceRate($student): int
    {
        $totalAttendances = $student->attendances()->count();
        
        if ($totalAttendances === 0) {
            return 0;
        }

        $presentCount = $student->attendances()->where('status', 'present')->count();
        return (int) round(($presentCount / $totalAttendances) * 100);
    }
}
