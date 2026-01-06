<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lecturer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class LecturerController extends Controller
{
    public function index(Request $request)
    {
        $query = Lecturer::with('user');

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            })->orWhere('lecturer_id_number', 'like', "%{$search}%")
              ->orWhere('department', 'like', "%{$search}%");
        }

        // Filter by department
        if ($request->filled('department') && $request->department !== 'all') {
            $query->where('department', $request->department);
        }

        // Filter by status
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        $lecturers = $query->orderBy('created_at', 'desc')->paginate(10);
        
        $stats = [
            'total' => Lecturer::count(),
            'active' => Lecturer::where('status', 'active')->count(),
            'on_leave' => Lecturer::where('status', 'on_leave')->count(),
            'new_this_month' => Lecturer::whereMonth('created_at', now()->month)->count(),
        ];

        $departments = Lecturer::distinct()->pluck('department');

        return view('admin.lecturers.index', compact('lecturers', 'stats', 'departments'));
    }

    public function create()
    {
        return view('admin.lecturers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'lecturer_id_number' => 'required|string|unique:lecturers,lecturer_id_number',
            'department' => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make('password'),
                'role' => 'dosen',
                'phone' => $request->phone,
            ]);

            Lecturer::create([
                'user_id' => $user->id,
                'lecturer_id_number' => $request->lecturer_id_number,
                'department' => $request->department,
                'status' => $request->status ?? 'active',
                'experience_years' => $request->experience_years ?? 0,
                'specialization' => $request->specialization,
                'bio' => $request->bio,
            ]);

            DB::commit();
            return redirect()->route('admin.lecturers.index')->with('success', 'Lecturer added successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Failed to add lecturer: ' . $e->getMessage());
        }
    }

    public function show(Lecturer $lecturer)
    {
        $lecturer->load(['user', 'classRooms']);
        return view('admin.lecturers.show', compact('lecturer'));
    }

    public function edit(Lecturer $lecturer)
    {
        $lecturer->load('user');
        return view('admin.lecturers.edit', compact('lecturer'));
    }

    public function update(Request $request, Lecturer $lecturer)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $lecturer->user_id,
            'department' => 'required|string|max:255',
            'status' => 'required|in:active,on_leave,inactive',
        ]);

        DB::beginTransaction();
        try {
            $lecturer->user->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);

            $lecturer->update([
                'department' => $request->department,
                'status' => $request->status,
                'experience_years' => $request->experience_years,
                'specialization' => $request->specialization,
                'bio' => $request->bio,
            ]);

            DB::commit();
            return redirect()->route('admin.lecturers.index')->with('success', 'Lecturer updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Failed to update lecturer: ' . $e->getMessage());
        }
    }

    public function destroy(Lecturer $lecturer)
    {
        DB::beginTransaction();
        try {
            $lecturer->user->delete();
            DB::commit();
            return redirect()->route('admin.lecturers.index')->with('success', 'Lecturer deleted successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to delete lecturer: ' . $e->getMessage());
        }
    }
}
