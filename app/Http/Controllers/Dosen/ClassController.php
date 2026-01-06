<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\ClassRoom;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function index()
    {
        $lecturer = auth()->user()->lecturer;
        
        $classes = ClassRoom::where('lecturer_id', $lecturer->id)
            ->withCount('students')
            ->with(['students' => function($query) {
                $query->wherePivot('status', 'approved')->with('user');
            }])
            ->get();

        return view('dosen.classes.index', compact('classes', 'lecturer'));
    }

    public function create()
    {
        $lecturer = auth()->user()->lecturer;
        return view('dosen.classes.create', compact('lecturer'));
    }

    public function store(Request $request)
    {
        $lecturer = auth()->user()->lecturer;

        $validated = $request->validate([
            'code' => 'required|string|max:20|unique:class_rooms,code',
            'name' => 'required|string|max:255',
            'room' => 'required|string|max:100',
            'schedule_day' => 'nullable|string',
            'schedule_time' => 'nullable',
            'credits' => 'nullable|integer|min:1|max:6',
            'capacity' => 'nullable|integer|min:1',
            'description' => 'nullable|string',
        ]);

        $validated['lecturer_id'] = $lecturer->id;
        $validated['status'] = 'active';

        ClassRoom::create($validated);

        return redirect()->route('dosen.classes.index')->with('success', 'Class created successfully!');
    }

    public function show(ClassRoom $class)
    {
        $lecturer = auth()->user()->lecturer;
        
        if ($class->lecturer_id !== $lecturer->id) {
            abort(403);
        }

        $class->load(['students.user', 'attendances']);

        return view('dosen.classes.show', compact('class', 'lecturer'));
    }

    public function edit(ClassRoom $class)
    {
        $lecturer = auth()->user()->lecturer;
        
        if ($class->lecturer_id !== $lecturer->id) {
            abort(403);
        }

        return view('dosen.classes.edit', compact('class', 'lecturer'));
    }

    public function update(Request $request, ClassRoom $class)
    {
        $lecturer = auth()->user()->lecturer;
        
        if ($class->lecturer_id !== $lecturer->id) {
            abort(403);
        }

        $validated = $request->validate([
            'code' => 'required|string|max:20|unique:class_rooms,code,' . $class->id,
            'name' => 'required|string|max:255',
            'room' => 'required|string|max:100',
            'schedule_day' => 'nullable|string',
            'schedule_time' => 'nullable',
            'credits' => 'nullable|integer|min:1|max:6',
            'capacity' => 'nullable|integer|min:1',
            'status' => 'nullable|in:active,cancelled,completed',
            'description' => 'nullable|string',
        ]);

        $class->update($validated);

        return redirect()->route('dosen.classes.index')->with('success', 'Class updated successfully!');
    }

    public function destroy(ClassRoom $class)
    {
        $lecturer = auth()->user()->lecturer;
        
        if ($class->lecturer_id !== $lecturer->id) {
            abort(403);
        }

        $class->delete();

        return redirect()->route('dosen.classes.index')->with('success', 'Class deleted successfully!');
    }
}
