<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'student_id_number',
        'faculty_id',
        'major_id',
        'year',
        'status',
        'enrollment_status',
        'enrollment_date',
        'gender',
        'birth_date',
        'nationality',
        'address',
        'guardian_name',
        'guardian_phone',
        'guardian_email',
        'guardian_relationship',
        'emergency_contact_name',
        'emergency_contact_phone',
    ];

    protected $casts = [
        'enrollment_date' => 'date',
        'birth_date' => 'date',
    ];

    /**
     * Get the user that owns the student profile.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the faculty of the student.
     */
    public function faculty(): BelongsTo
    {
        return $this->belongsTo(Faculty::class);
    }

    /**
     * Get the major of the student.
     */
    public function major(): BelongsTo
    {
        return $this->belongsTo(Major::class);
    }

    /**
     * Get the classes the student is enrolled in.
     */
    public function classRooms(): BelongsToMany
    {
        return $this->belongsToMany(ClassRoom::class, 'class_student')
            ->withPivot('enrolled_at', 'grade', 'status')
            ->withTimestamps();
    }

    /**
     * Get the attendances for the student.
     */
    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }

    /**
     * Get status badge class
     */
    public function getStatusBadgeClass(): string
    {
        return match($this->status) {
            'active' => 'bg-success-light text-success-dark',
            'inactive' => 'bg-warning-light text-warning-dark',
            'graduated' => 'bg-info-light text-info-dark',
            'suspended' => 'bg-error-light text-error-dark',
            default => 'bg-gray-100 text-gray-600',
        };
    }
}
