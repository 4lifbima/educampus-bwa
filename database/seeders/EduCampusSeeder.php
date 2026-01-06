<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Faculty;
use App\Models\Major;
use App\Models\Student;
use App\Models\Lecturer;
use App\Models\ClassRoom;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EduCampusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin User
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create Faculties
        $faculties = [
            ['name' => 'Faculty of Engineering', 'code' => 'ENG'],
            ['name' => 'Faculty of Science', 'code' => 'SCI'],
            ['name' => 'Faculty of Arts', 'code' => 'ART'],
            ['name' => 'Faculty of Business', 'code' => 'BUS'],
            ['name' => 'Faculty of Medicine', 'code' => 'MED'],
        ];

        foreach ($faculties as $facultyData) {
            Faculty::create($facultyData);
        }

        // Create Majors
        $majors = [
            ['faculty_id' => 1, 'name' => 'Computer Science', 'code' => 'CS'],
            ['faculty_id' => 1, 'name' => 'Electrical Engineering', 'code' => 'EE'],
            ['faculty_id' => 2, 'name' => 'Mathematics', 'code' => 'MATH'],
            ['faculty_id' => 2, 'name' => 'Physics', 'code' => 'PHY'],
            ['faculty_id' => 2, 'name' => 'Chemistry', 'code' => 'CHEM'],
            ['faculty_id' => 2, 'name' => 'Biology', 'code' => 'BIO'],
            ['faculty_id' => 3, 'name' => 'Psychology', 'code' => 'PSY'],
            ['faculty_id' => 3, 'name' => 'English Literature', 'code' => 'ENG-LIT'],
            ['faculty_id' => 4, 'name' => 'Business Administration', 'code' => 'BA'],
            ['faculty_id' => 5, 'name' => 'Medicine', 'code' => 'MED'],
        ];

        foreach ($majors as $majorData) {
            Major::create($majorData);
        }

        // Create Lecturers
        $lecturersData = [
            ['name' => 'Dr. Sarah Johnson', 'email' => 'lecturer@gmail.com', 'department' => 'Computer Science', 'lecturer_id' => 'LEC-001'],
            ['name' => 'Prof. Michael Chen', 'email' => 'lecturer1@gmail.com', 'department' => 'Mathematics', 'lecturer_id' => 'LEC-002'],
            ['name' => 'Dr. Emily Rodriguez', 'email' => 'lecturer2@gmail.com', 'department' => 'Physics', 'lecturer_id' => 'LEC-003'],
            ['name' => 'Dr. James Wilson', 'email' => 'lecturer3@gmail.com', 'department' => 'Chemistry', 'lecturer_id' => 'LEC-004'],
            ['name' => 'Dr. Lisa Thompson', 'email' => 'lecturer4@gmail.com', 'department' => 'Biology', 'lecturer_id' => 'LEC-005'],
        ];

        foreach ($lecturersData as $lecData) {
            $user = User::create([
                'name' => $lecData['name'],
                'email' => $lecData['email'],
                'password' => Hash::make('password'),
                'role' => 'dosen',
            ]);

            Lecturer::create([
                'user_id' => $user->id,
                'lecturer_id_number' => $lecData['lecturer_id'],
                'department' => $lecData['department'],
                'status' => 'active',
                'experience_years' => rand(5, 15),
            ]);
        }

        // Create Students
        $studentsData = [
            ['name' => 'Sarah Johnson', 'email' => 'student1@gmail.com', 'student_id' => 'STU001', 'major_id' => 1, 'faculty_id' => 1, 'year' => 3],
            ['name' => 'Michael Chen', 'email' => 'student2@gmail.com', 'student_id' => 'STU002', 'major_id' => 9, 'faculty_id' => 4, 'year' => 2],
            ['name' => 'Emma Rodriguez', 'email' => 'student3@gmail.com', 'student_id' => 'STU003', 'major_id' => 10, 'faculty_id' => 5, 'year' => 4],
            ['name' => 'David Kim', 'email' => 'student4@gmail.com', 'student_id' => 'STU004', 'major_id' => 7, 'faculty_id' => 3, 'year' => 1],
            ['name' => 'Lisa Wang', 'email' => 'student5@gmail.com', 'student_id' => 'STU005', 'major_id' => 2, 'faculty_id' => 1, 'year' => 2],
        ];

        foreach ($studentsData as $stuData) {
            $user = User::create([
                'name' => $stuData['name'],
                'email' => $stuData['email'],
                'password' => Hash::make('password'),
                'role' => 'mahasiswa',
            ]);

            Student::create([
                'user_id' => $user->id,
                'student_id_number' => $stuData['student_id'],
                'faculty_id' => $stuData['faculty_id'],
                'major_id' => $stuData['major_id'],
                'year' => $stuData['year'],
                'status' => 'active',
                'enrollment_status' => 'full-time',
                'enrollment_date' => now()->subYears($stuData['year']),
                'gender' => rand(0, 1) ? 'male' : 'female',
            ]);
        }

        // Create Classes
        $classesData = [
            ['code' => 'CS101', 'name' => 'Computer Science Fundamentals', 'lecturer_id' => 1, 'room' => 'Room A1', 'schedule_day' => 'Monday', 'schedule_time' => '08:00'],
            ['code' => 'MATH201', 'name' => 'Advanced Mathematics', 'lecturer_id' => 2, 'room' => 'Room B2', 'schedule_day' => 'Wednesday', 'schedule_time' => '08:00'],
            ['code' => 'PHY301', 'name' => 'Physics Laboratory', 'lecturer_id' => 3, 'room' => 'Lab 1', 'schedule_day' => 'Tuesday', 'schedule_time' => '10:00'],
            ['code' => 'CHEM101', 'name' => 'General Chemistry', 'lecturer_id' => 4, 'room' => 'Room D1', 'schedule_day' => 'Thursday', 'schedule_time' => '10:00'],
            ['code' => 'BIO201', 'name' => 'Biology', 'lecturer_id' => 5, 'room' => 'Room E1', 'schedule_day' => 'Monday', 'schedule_time' => '14:00'],
        ];

        foreach ($classesData as $classData) {
            ClassRoom::create($classData);
        }
    }
}
