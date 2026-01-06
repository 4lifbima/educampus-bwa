<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\ClassRoom;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $student = auth()->user()->student;
        
        $enrolledCourses = $student->classRooms()
            ->where('class_rooms.status', 'active')
            ->withPivot('status', 'grade', 'enrolled_at')
            ->with('lecturer.user')
            ->get();

        return view('mahasiswa.courses.index', compact('enrolledCourses', 'student'));
    }
}
