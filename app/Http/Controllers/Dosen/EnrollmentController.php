<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\ClassRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EnrollmentController extends Controller
{
    public function index()
    {
        $lecturer = auth()->user()->lecturer;
        
        // Get pending enrollment requests for lecturer's classes
        $pendingRequests = DB::table('class_student')
            ->join('class_rooms', 'class_student.class_room_id', '=', 'class_rooms.id')
            ->join('students', 'class_student.student_id', '=', 'students.id')
            ->join('users', 'students.user_id', '=', 'users.id')
            ->where('class_rooms.lecturer_id', $lecturer->id)
            ->where('class_student.status', 'pending')
            ->select(
                'class_student.id as enrollment_id',
                'class_student.student_id',
                'class_student.class_room_id',
                'class_student.enrolled_at',
                'class_rooms.name as class_name',
                'class_rooms.code as class_code',
                'users.name as student_name',
                'users.email as student_email',
                'students.student_id_number'
            )
            ->orderBy('class_student.enrolled_at', 'desc')
            ->get();

        return view('dosen.enrollments.index', compact('pendingRequests', 'lecturer'));
    }

    public function approve(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'class_room_id' => 'required|exists:class_rooms,id',
        ]);

        $lecturer = auth()->user()->lecturer;
        $classRoom = ClassRoom::find($request->class_room_id);

        // Verify ownership
        if ($classRoom->lecturer_id !== $lecturer->id) {
            return back()->with('error', 'Unauthorized action.');
        }

        DB::table('class_student')
            ->where('student_id', $request->student_id)
            ->where('class_room_id', $request->class_room_id)
            ->update(['status' => 'approved', 'updated_at' => now()]);

        return back()->with('success', 'Student enrollment approved!');
    }

    public function reject(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'class_room_id' => 'required|exists:class_rooms,id',
        ]);

        $lecturer = auth()->user()->lecturer;
        $classRoom = ClassRoom::find($request->class_room_id);

        // Verify ownership
        if ($classRoom->lecturer_id !== $lecturer->id) {
            return back()->with('error', 'Unauthorized action.');
        }

        DB::table('class_student')
            ->where('student_id', $request->student_id)
            ->where('class_room_id', $request->class_room_id)
            ->delete();

        return back()->with('success', 'Student enrollment rejected.');
    }
}
