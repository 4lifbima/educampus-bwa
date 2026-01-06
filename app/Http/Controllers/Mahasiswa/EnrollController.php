<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\ClassRoom;
use Illuminate\Http\Request;

class EnrollController extends Controller
{
    public function index()
    {
        $student = auth()->user()->student;
        
        // Get IDs of classes already enrolled (any status)
        $enrolledClassIds = $student->classRooms()->pluck('class_rooms.id')->toArray();
        
        // Get available classes not yet enrolled
        $availableClasses = ClassRoom::where('status', 'active')
            ->whereNotIn('id', $enrolledClassIds)
            ->with('lecturer.user')
            ->withCount('students')
            ->get();

        return view('mahasiswa.enroll.index', compact('availableClasses', 'student'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'class_room_id' => 'required|exists:class_rooms,id',
        ]);

        $student = auth()->user()->student;
        $classRoom = ClassRoom::findOrFail($request->class_room_id);

        // Check if already enrolled
        if ($student->classRooms()->where('class_room_id', $classRoom->id)->exists()) {
            return back()->with('error', 'You are already enrolled in this class.');
        }

        // Check capacity
        $currentCount = $classRoom->students()->count();
        if ($classRoom->capacity && $currentCount >= $classRoom->capacity) {
            return back()->with('error', 'This class is already full.');
        }

        // Enroll with pending status (needs lecturer approval)
        $student->classRooms()->attach($classRoom->id, [
            'status' => 'pending',
            'enrolled_at' => now(),
        ]);

        return redirect()->route('mahasiswa.courses.index')->with('success', 'Enrollment request sent! Waiting for lecturer approval.');
    }

    public function cancel($classRoomId)
    {
        $student = auth()->user()->student;
        
        // Only cancel if pending
        $enrollment = $student->classRooms()
            ->wherePivot('class_room_id', $classRoomId)
            ->wherePivot('status', 'pending')
            ->first();

        if ($enrollment) {
            $student->classRooms()->detach($classRoomId);
            return back()->with('success', 'Enrollment request cancelled.');
        }

        return back()->with('error', 'Cannot cancel this enrollment.');
    }
}
