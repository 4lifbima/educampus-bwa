<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Lecturer;
use App\Models\ClassRoom;
use App\Models\Attendance;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_students' => Student::count(),
            'active_students' => Student::where('status', 'active')->count(),
            'inactive_students' => Student::where('status', 'inactive')->count(),
            'new_students_this_month' => Student::whereMonth('created_at', now()->month)->count(),
            'total_lecturers' => Lecturer::count(),
            'active_classes' => ClassRoom::where('status', 'active')->count(),
            'today_attendance_percentage' => $this->getTodayAttendancePercentage(),
        ];

        $recentActivities = $this->getRecentActivities();
        $upcomingSchedules = ClassRoom::where('status', 'active')
            ->with('lecturer.user')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentActivities', 'upcomingSchedules'));
    }

    private function getTodayAttendancePercentage(): int
    {
        $today = now()->toDateString();
        $totalRecords = Attendance::whereDate('date', $today)->count();
        
        if ($totalRecords === 0) {
            return 0;
        }

        $presentCount = Attendance::whereDate('date', $today)
            ->where('status', 'present')
            ->count();

        return (int) round(($presentCount / $totalRecords) * 100);
    }

    private function getRecentActivities(): array
    {
        $activities = [];

        // Get recent student enrollments
        $recentStudents = Student::with('user')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        foreach ($recentStudents as $student) {
            $activities[] = [
                'type' => 'enrollment',
                'title' => $student->user->name . ' enrolled',
                'description' => 'New student registration',
                'time' => $student->created_at->diffForHumans(),
                'status' => 'Enrolled',
                'status_class' => 'bg-success-light text-success-dark',
            ];
        }

        return array_slice($activities, 0, 5);
    }
}
