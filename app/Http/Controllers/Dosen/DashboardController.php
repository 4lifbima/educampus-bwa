<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\ClassRoom;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $lecturer = auth()->user()->lecturer;
        
        $classes = ClassRoom::where('lecturer_id', $lecturer->id)
            ->where('status', 'active')
            ->withCount('students')
            ->get();

        $stats = [
            'total_classes' => $classes->count(),
            'total_students' => $classes->sum('students_count'),
        ];

        return view('dosen.dashboard', compact('classes', 'stats', 'lecturer'));
    }
}
