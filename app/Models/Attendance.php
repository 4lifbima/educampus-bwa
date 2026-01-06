<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_room_id',
        'student_id',
        'date',
        'status',
        'notes',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    /**
     * Get the class room for the attendance.
     */
    public function classRoom(): BelongsTo
    {
        return $this->belongsTo(ClassRoom::class);
    }

    /**
     * Get the student for the attendance.
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * Get status badge class
     */
    public function getStatusBadgeClass(): string
    {
        return match($this->status) {
            'present' => 'bg-success-light text-success-dark',
            'absent' => 'bg-error-light text-error-dark',
            'late' => 'bg-warning-light text-warning-dark',
            'excused' => 'bg-info-light text-info-dark',
            default => 'bg-gray-100 text-gray-600',
        };
    }
}
