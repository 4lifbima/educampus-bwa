<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use App\Models\Faculty;
use App\Models\Major;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::with(['user', 'faculty', 'major']);

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            })->orWhere('student_id_number', 'like', "%{$search}%");
        }

        // Filter by faculty
        if ($request->filled('faculty') && $request->faculty !== 'all') {
            $query->where('faculty_id', $request->faculty);
        }

        // Filter by status
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Filter by year
        if ($request->filled('year') && $request->year !== 'all') {
            $query->where('year', $request->year);
        }

        $students = $query->orderBy('created_at', 'desc')->paginate(10);
        
        $stats = [
            'total' => Student::count(),
            'active' => Student::where('status', 'active')->count(),
            'inactive' => Student::where('status', 'inactive')->count(),
            'new_this_month' => Student::whereMonth('created_at', now()->month)->count(),
        ];

        $faculties = Faculty::all();

        return view('admin.students.index', compact('students', 'stats', 'faculties'));
    }

    public function create()
    {
        $faculties = Faculty::with('majors')->get();
        return view('admin.students.create', compact('faculties'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'student_id_number' => 'required|string|unique:students,student_id_number',
            'faculty_id' => 'required|exists:faculties,id',
            'major_id' => 'required|exists:majors,id',
            'year' => 'required|integer|min:1|max:6',
            'gender' => 'required|in:male,female,other',
            'birth_date' => 'required|date',
        ]);

        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $request->first_name . ' ' . $request->last_name,
                'email' => $request->email,
                'password' => Hash::make('password'),
                'role' => 'mahasiswa',
                'phone' => $request->phone,
            ]);

            Student::create([
                'user_id' => $user->id,
                'student_id_number' => $request->student_id_number,
                'faculty_id' => $request->faculty_id,
                'major_id' => $request->major_id,
                'year' => $request->year,
                'status' => 'active',
                'enrollment_status' => $request->enrollment_status ?? 'full-time',
                'enrollment_date' => $request->enrollment_date ?? now(),
                'gender' => $request->gender,
                'birth_date' => $request->birth_date,
                'nationality' => $request->nationality,
                'address' => $request->address,
                'guardian_name' => $request->guardian_name,
                'guardian_phone' => $request->guardian_phone,
                'guardian_email' => $request->guardian_email,
                'guardian_relationship' => $request->guardian_relationship,
                'emergency_contact_name' => $request->emergency_contact_name,
                'emergency_contact_phone' => $request->emergency_contact_phone,
            ]);

            DB::commit();
            return redirect()->route('admin.students.index')->with('success', 'Student added successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Failed to add student: ' . $e->getMessage());
        }
    }

    public function show(Student $student)
    {
        $student->load(['user', 'faculty', 'major', 'classRooms', 'attendances']);
        return view('admin.students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        $student->load(['user', 'faculty', 'major']);
        $faculties = Faculty::with('majors')->get();
        return view('admin.students.edit', compact('student', 'faculties'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $student->user_id,
            'faculty_id' => 'required|exists:faculties,id',
            'major_id' => 'required|exists:majors,id',
            'year' => 'required|integer|min:1|max:6',
            'status' => 'required|in:active,inactive,graduated,suspended',
        ]);

        DB::beginTransaction();
        try {
            $student->user->update([
                'name' => $request->first_name . ' ' . $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);

            $student->update([
                'faculty_id' => $request->faculty_id,
                'major_id' => $request->major_id,
                'year' => $request->year,
                'status' => $request->status,
                'enrollment_status' => $request->enrollment_status,
                'gender' => $request->gender,
                'birth_date' => $request->birth_date,
                'nationality' => $request->nationality,
                'address' => $request->address,
                'guardian_name' => $request->guardian_name,
                'guardian_phone' => $request->guardian_phone,
                'guardian_email' => $request->guardian_email,
                'guardian_relationship' => $request->guardian_relationship,
            ]);

            DB::commit();
            return redirect()->route('admin.students.index')->with('success', 'Student updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Failed to update student: ' . $e->getMessage());
        }
    }

    public function destroy(Student $student)
    {
        DB::beginTransaction();
        try {
            $student->user->delete();
            DB::commit();
            return redirect()->route('admin.students.index')->with('success', 'Student deleted successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to delete student: ' . $e->getMessage());
        }
    }
}
