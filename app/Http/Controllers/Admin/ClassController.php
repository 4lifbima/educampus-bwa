<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassRoom;
use App\Models\Lecturer;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function index(Request $request)
    {
        $query = ClassRoom::with(['lecturer.user']);

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('code', 'like', "%{$search}%")
                  ->orWhere('name', 'like', "%{$search}%")
                  ->orWhere('room', 'like', "%{$search}%");
        }

        // Filter by status
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        $classes = $query->orderBy('created_at', 'desc')->paginate(10);
        
        $stats = [
            'total' => ClassRoom::count(),
            'active' => ClassRoom::where('status', 'active')->count(),
            'cancelled' => ClassRoom::where('status', 'cancelled')->count(),
            'completed' => ClassRoom::where('status', 'completed')->count(),
        ];

        $lecturers = Lecturer::with('user')->where('status', 'active')->get();

        return view('admin.classes.index', compact('classes', 'stats', 'lecturers'));
    }

    public function create()
    {
        $lecturers = Lecturer::with('user')->where('status', 'active')->get();
        return view('admin.classes.create', compact('lecturers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|unique:class_rooms,code',
            'name' => 'required|string|max:255',
            'lecturer_id' => 'nullable|exists:lecturers,id',
            'room' => 'required|string|max:255',
        ]);

        ClassRoom::create([
            'code' => $request->code,
            'name' => $request->name,
            'lecturer_id' => $request->lecturer_id,
            'room' => $request->room,
            'capacity' => $request->capacity ?? 30,
            'schedule_day' => $request->schedule_day,
            'schedule_time' => $request->schedule_time,
            'status' => $request->status ?? 'active',
            'credits' => $request->credits ?? 3,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.classes.index')->with('success', 'Class created successfully!');
    }

    public function show(ClassRoom $class)
    {
        $class->load(['lecturer.user', 'students.user', 'attendances']);
        return view('admin.classes.show', compact('class'));
    }

    public function edit(ClassRoom $class)
    {
        $lecturers = Lecturer::with('user')->where('status', 'active')->get();
        return view('admin.classes.edit', compact('class', 'lecturers'));
    }

    public function update(Request $request, ClassRoom $class)
    {
        $request->validate([
            'code' => 'required|string|unique:class_rooms,code,' . $class->id,
            'name' => 'required|string|max:255',
            'room' => 'required|string|max:255',
            'status' => 'required|in:active,cancelled,completed',
        ]);

        $class->update([
            'code' => $request->code,
            'name' => $request->name,
            'lecturer_id' => $request->lecturer_id,
            'room' => $request->room,
            'capacity' => $request->capacity,
            'schedule_day' => $request->schedule_day,
            'schedule_time' => $request->schedule_time,
            'status' => $request->status,
            'credits' => $request->credits,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.classes.index')->with('success', 'Class updated successfully!');
    }

    public function destroy(ClassRoom $class)
    {
        $class->delete();
        return redirect()->route('admin.classes.index')->with('success', 'Class deleted successfully!');
    }
}
